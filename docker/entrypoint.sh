#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

touch database/database.sqlite
chown -R www-data:www-data storage bootstrap/cache database

if [ ! -f .env ]; then
    cp .env.example .env
fi

# A deployed instance must always have a key. Set APP_KEY in the host dashboard;
# this fallback only protects a first boot from a hard failure.
if [ -z "${APP_KEY:-}" ]; then
    php artisan key:generate --force
fi

php artisan migrate --force
php artisan db:seed --force

# The seeder is idempotent: existing case files are left untouched so that
# edits made in the Filament studio are not overwritten on redeploy.
php artisan storage:link || true
php artisan optimize

exec apache2-foreground
