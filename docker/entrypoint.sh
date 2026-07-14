#!/bin/bash
set -e

# Create directories
mkdir -p \
    /var/www/html/storage/logs \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/bootstrap/cache

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start PostgreSQL service in background
/etc/init.d/postgresql start
sleep 2

# Laravel bootstrapping
if [ -f /var/www/html/artisan ] && [ -n "${APP_KEY:-}" ]; then
    echo "Running Laravel optimizations..."
    su www-data -s /bin/sh -c "php artisan config:cache"  || true
    su www-data -s /bin/sh -c "php artisan route:cache"   || true
    su www-data -s /bin/sh -c "php artisan view:cache"    || true
    
    if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
        echo "Running database migrations..."
        su www-data -s /bin/sh -c "php artisan migrate --force" || true
    fi
fi

echo "Starting Supervisord..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
