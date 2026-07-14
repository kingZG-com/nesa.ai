# ═══════════════════════════════════════════════════════════════════
#  Docker Image: Nginx + PHP 8.3 FPM + Laravel
#  Port  : 8088
#  Base  : ubuntu:22.04 (Jammy)
# ═══════════════════════════════════════════════════════════════════
FROM ubuntu:22.04

# ── Build Args ──────────────────────────────────────────────────
ARG NODE_VERSION=24
ARG DEBIAN_FRONTEND=noninteractive

# ── Environment ─────────────────────────────────────────────────
ENV TZ=Asia/Jakarta \
    LANG=C.UTF-8 \
    LC_ALL=C.UTF-8

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
        supervisor \
        sqlite3 \
        postgresql \
        postgresql-contrib \
        dos2unix \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone

# ── 2. Add PHP Ondrej PPA & Install PHP + Nginx ─────────────────
RUN add-apt-repository ppa:ondrej/php -y \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        nginx \
        php8.4-fpm \
        php8.4-cli \
        php8.4-common \
        php8.4-curl \
        php8.4-pgsql \
        php8.4-sqlite3 \
        php8.4-opcache \
        php8.4-intl \
        php8.4-redis \
        php8.4-xml \
        php8.4-mbstring \
        php8.4-zip \
    && rm -rf /var/lib/apt/lists/*

# Symlink php8.4 to php
RUN update-alternatives --set php /usr/bin/php8.4

# ── 3. Install Node.js (for Vite / frontend build) ─────────────
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/* \
    && node --version && npm --version

# ── 4. Install Composer ─────────────────────────────────────────
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ── 5. Configure Nginx and PHP-FPM ──────────────────────────────
# Disable default nginx site
RUN rm /etc/nginx/sites-enabled/default
# Copy our custom Nginx server block
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create PHP-FPM run directory
RUN mkdir -p /run/php

# ── 6. Copy & Fix Entrypoint ────────────────────────────────────
COPY docker/entrypoint.sh /docker-entrypoint.sh
RUN dos2unix /docker-entrypoint.sh \
    && chmod +x /docker-entrypoint.sh

# ── 7. Copy Laravel Application ─────────────────────────────────
WORKDIR /var/www/html

COPY . .

# ── 8. Install PHP Dependencies (Composer) ──────────────────────
RUN composer install \
        --no-interaction \
        --optimize-autoloader \
        --no-dev \
        --prefer-dist

# ── 9. Build Frontend Assets (Vite + Tailwind) ──────────────────
RUN npm install --legacy-peer-deps
RUN NODE_OPTIONS="--max-old-space-size=1536" npm run build

# ── 10. Set Permissions ─────────────────────────────────────────
RUN chown -R www-data:www-data /var/www/html

# ── Port & Entrypoint ───────────────────────────────────────────
EXPOSE 8088
EXPOSE 8080

CMD ["/docker-entrypoint.sh"]