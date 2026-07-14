# ═══════════════════════════════════════════════════════════════════
#  Docker Image: OpenLiteSpeed + lsphp83 + FrankenPHP + Laravel
#  Port  : 8088 (OLS default)
#  PHP   : 8.3 via lsphp83 (LiteSpeed LSAPI) + FrankenPHP binary
#  Base  : ubuntu:24.04 (Noble) — LiteSpeed APT repo supported
# ═══════════════════════════════════════════════════════════════════
FROM ubuntu:24.04

# ── Build Args ──────────────────────────────────────────────────
# NODE_VERSION must match docker-compose.yaml args.NODE_VERSION
ARG NODE_VERSION=20
ARG DEBIAN_FRONTEND=noninteractive

# ── Environment ─────────────────────────────────────────────────
ENV TZ=Asia/Jakarta \
    LANG=en_US.UTF-8 \
    LC_ALL=en_US.UTF-8

# ── 1. Base System Dependencies ─────────────────────────────────
RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        wget \
        gnupg2 \
        lsb-release \
        ca-certificates \
        software-properties-common \
        git \
        unzip \
        tzdata \
        procps \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && rm -rf /var/lib/apt/lists/*

# ── 2. Add LiteSpeed Technology Official APT Repository ─────────
# Source: https://rpms.litespeedtech.com/debian/
RUN wget -qO /tmp/lst_repo.sh \
        https://rpms.litespeedtech.com/debian/enable_lst_debian_repo.sh \
    && bash /tmp/lst_repo.sh \
    && rm /tmp/lst_repo.sh \
    && apt-get update

# ── 3. Install OpenLiteSpeed 1.8.5 ──────────────────────────────
# Pin exact version. Check available: apt-cache madison openlitespeed
RUN apt-get install -y --no-install-recommends openlitespeed \
    && rm -rf /var/lib/apt/lists/*

# ── 4. Install lsphp83 + PHP Extensions ─────────────────────────
# lsphp83 = PHP 8.3 compiled with LiteSpeed LSAPI (native OLS handler)
RUN apt-get update && apt-get install -y --no-install-recommends \
        lsphp83 \
        lsphp83-common \
        lsphp83-curl \
        lsphp83-pgsql \
        lsphp83-opcache \
        lsphp83-intl \
        lsphp83-imap \
        lsphp83-xml \
        lsphp83-zip \
        lsphp83-mbstring \
        lsphp83-redis \
    && rm -rf /var/lib/apt/lists/*

# Symlink lsphp83 binary → /usr/local/bin/php (for Composer & artisan CLI)
RUN ln -sf /usr/local/lsws/lsphp83/bin/php /usr/local/bin/php

# ── 5. Install FrankenPHP Binary ────────────────────────────────
# FrankenPHP embeds PHP 8.3 + Caddy into a single binary.
# In this stack it is installed alongside OLS as an available PHP runtime.
# OLS uses lsphp83 via LSAPI; FrankenPHP is available for:
#   - Laravel Octane worker mode
#   - Alternative LSAPI handler (see commented block in httpd_config.conf)
RUN ARCH=$(dpkg --print-architecture) \
    && case "$ARCH" in \
        amd64)  FRANKEN_ARCH="x86_64"  ;; \
        arm64)  FRANKEN_ARCH="aarch64" ;; \
        *)      echo "Unsupported arch: $ARCH" && exit 1 ;; \
    esac \
    && FRANKEN_TAG=$(curl -fsSL \
        "https://api.github.com/repos/dunglas/frankenphp/releases/latest" \
        | grep '"tag_name"' | head -1 | cut -d'"' -f4) \
    && echo "Installing FrankenPHP ${FRANKEN_TAG} for ${FRANKEN_ARCH}..." \
    && curl -fsSL \
        "https://github.com/dunglas/frankenphp/releases/download/${FRANKEN_TAG}/frankenphp-linux-${FRANKEN_ARCH}" \
        -o /usr/local/bin/frankenphp \
    && chmod +x /usr/local/bin/frankenphp \
    && frankenphp version

# ── 6. Install Node.js (for Vite / frontend build) ─────────────
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x| bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/* \
    && node --version && npm --version

# ── 7. Install Composer ─────────────────────────────────────────
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ── 8. Configure OpenLiteSpeed ──────────────────────────────────
# Copy our custom OLS configuration files
COPY ols/httpd_config.conf /usr/local/lsws/conf/httpd_config.conf
RUN mkdir -p /usr/local/lsws/conf/vhosts/html
COPY ols/vhconf.conf       /usr/local/lsws/conf/vhosts/html/vhconf.conf

# Create directories required by OLS at runtime
RUN mkdir -p \
        /tmp/lshttpd/swapping \
        /usr/local/lsws/logs \
        /var/log/supervisor \
    && chown -R nobody:nogroup \
        /tmp/lshttpd \
        /usr/local/lsws/logs

# ── 9. Copy Entrypoint ──────────────────────────────────────────
COPY ols/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# ── 10. Copy Laravel Application ────────────────────────────────
WORKDIR /var/www/html

COPY . .

# ── 11. Install PHP Dependencies (Composer) ─────────────────────
# --no-dev   → skip PHPUnit, Faker, etc. for production
# --optimize → generate optimized class autoloader
RUN composer install \
        --no-interaction \
        --optimize-autoloader \
        --no-dev \
        --prefer-dist

# ── 12. Build Frontend Assets (Vite + Tailwind) ─────────────────
RUN npm install --legacy-peer-deps && npm run build

# ── 13. Set Permissions ─────────────────────────────────────────
# OLS runs as 'nobody:nogroup' — storage & cache must be writable
RUN chown -R nobody:nogroup /var/www/html \
    && chmod -R 775 \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache

# ── Port & Entrypoint ───────────────────────────────────────────
# 8088 = OpenLiteSpeed default HTTP port
EXPOSE 8088

CMD ["/docker-entrypoint.sh"]