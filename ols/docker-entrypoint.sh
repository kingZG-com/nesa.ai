#!/bin/bash
# ═══════════════════════════════════════════════════════════════════
#  Docker Entrypoint
#  Container: OpenLiteSpeed 1.8.5 + lsphp83 + FrankenPHP + Laravel
# ═══════════════════════════════════════════════════════════════════
set -euo pipefail

log() { echo "[entrypoint] $(date '+%Y-%m-%d %H:%M:%S') — $*"; }

# ── 1. Create runtime directories ───────────────────────────────
log "Setting up runtime directories..."
mkdir -p \
    /tmp/lshttpd/swapping \
    /usr/local/lsws/logs \
    /var/www/html/storage/logs \
    /var/www/html/storage/framework/{cache,sessions,views} \
    /var/www/html/bootstrap/cache

chown -R nobody:nogroup \
    /tmp/lshttpd \
    /usr/local/lsws/logs

chmod -R 775 \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# ── 2. Laravel bootstrap (only when APP_KEY is present) ─────────
if [ -f /var/www/html/artisan ]; then
    log "Laravel detected. Running bootstrap optimizations..."
    cd /var/www/html

    if [ -n "${APP_KEY:-}" ]; then
        su nobody -s /bin/bash -c "php artisan config:cache"  2>/dev/null || log "WARN: config:cache skipped"
        su nobody -s /bin/bash -c "php artisan route:cache"   2>/dev/null || log "WARN: route:cache skipped"
        su nobody -s /bin/bash -c "php artisan view:cache"    2>/dev/null || log "WARN: view:cache skipped"
        log "Laravel caches built successfully."
    else
        log "WARN: APP_KEY not set — skipping Laravel cache optimizations."
        log "      Set APP_KEY in your environment or .env file."
    fi

    # Run migrations if env flag is set (opt-in for safety)
    if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
        log "Running database migrations..."
        su nobody -s /bin/bash -c "php artisan migrate --force" \
            || log "WARN: migrations failed (DB might not be ready yet)"
    fi
fi

# ── 3. Show version info ─────────────────────────────────────────
log "=== Stack Info ==="
log "OpenLiteSpeed : $(/usr/local/lsws/bin/lshttpd -v 2>&1 | head -1)"
log "PHP (lsphp83) : $(php --version | head -1)"
log "FrankenPHP    : $(frankenphp version 2>&1 | head -1 || echo 'available at /usr/local/bin/frankenphp')"
log "Port          : 8088 (OLS default)"
log "=================="

# ── 4. Start OpenLiteSpeed ──────────────────────────────────────
log "Starting OpenLiteSpeed 1.8.5..."
/usr/local/lsws/bin/lshttpd start

if [ $? -ne 0 ]; then
    log "ERROR: Failed to start OpenLiteSpeed!"
    log "Check OLS config: /usr/local/lsws/conf/httpd_config.conf"
    cat /usr/local/lsws/logs/error.log 2>/dev/null || true
    exit 1
fi

log "OpenLiteSpeed started successfully on port 8088"

# ── 4b. Start Laravel Reverb WebSocket Server ───────────────────
if [ -f /var/www/html/artisan ] && [ -n "${APP_KEY:-}" ]; then
    log "Starting Laravel Reverb WebSocket on port ${REVERB_PORT:-8080}..."
    su nobody -s /bin/bash -c \
        "cd /var/www/html && php artisan reverb:start \
         --host=0.0.0.0 \
         --port=${REVERB_PORT:-8080} \
         --no-interaction" &
    REVERB_PID=$!
    log "Reverb started (PID: $REVERB_PID)"
fi

# ── 5. Graceful shutdown handler ────────────────────────────────────
_shutdown() {
    log "SIGTERM received — stopping services gracefully..."
    # Stop Reverb if running
    if [ -n "${REVERB_PID:-}" ] && kill -0 "$REVERB_PID" 2>/dev/null; then
        log "Stopping Reverb (PID: $REVERB_PID)..."
        kill "$REVERB_PID" 2>/dev/null || true
    fi
    /usr/local/lsws/bin/lshttpd stop
    log "Shutdown complete."
    exit 0
}
trap '_shutdown' SIGTERM SIGINT SIGQUIT

# ── 6. Keep container alive, stream logs ────────────────────────
# Touch log files to ensure they exist before tailing
touch \
    /usr/local/lsws/logs/error.log \
    /usr/local/lsws/logs/access.log

log "Container ready. Streaming OLS logs..."
tail -f /usr/local/lsws/logs/error.log /usr/local/lsws/logs/access.log &
TAIL_PID=$!

# Wait loop — exits on SIGTERM via trap
while kill -0 $TAIL_PID 2>/dev/null; do
    wait $TAIL_PID 2>/dev/null || true
    sleep 5 &
    wait $!
done
