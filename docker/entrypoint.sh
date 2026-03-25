#!/usr/bin/env sh
set -eu

cd /var/www/html

if [ ! -f .env ] && [ -f .env.example ]; then
  cp .env.example .env
fi

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
  DB_PATH="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
  mkdir -p "$(dirname "$DB_PATH")"
  touch "$DB_PATH"
fi

chown -R www-data:www-data storage bootstrap/cache database

if [ -z "${APP_KEY:-}" ]; then
  if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    php artisan key:generate --force --ansi
  fi
fi

php artisan package:discover --ansi

if [ "${APP_RUN_MIGRATIONS:-true}" = "true" ]; then
  php artisan migrate --force
fi

if [ "${APP_RUN_SEEDER:-false}" = "true" ]; then
  php artisan db:seed --force
fi

if [ "${APP_STORAGE_LINK:-true}" = "true" ]; then
  php artisan storage:link || true
fi

exec "$@"
