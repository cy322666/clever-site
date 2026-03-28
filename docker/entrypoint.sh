#!/usr/bin/env sh
set -eu

cd /var/www/html

if [ ! -f .env ] && [ -f .env.example ]; then
  cp .env.example .env
fi

if [ ! -f .env ]; then
  touch .env
fi

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
  DB_PATH="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
  mkdir -p "$(dirname "$DB_PATH")"
  touch "$DB_PATH"
fi

if [ "${DB_CONNECTION:-sqlite}" = "pgsql" ]; then
  DB_HOST="${DB_HOST:-db}"
  DB_PORT="${DB_PORT:-5432}"
  DB_USERNAME="${DB_USERNAME:-postgres}"
  DB_DATABASE="${DB_DATABASE:-laravel}"

  echo "Waiting for PostgreSQL at ${DB_HOST}:${DB_PORT}..."
  until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" -d "$DB_DATABASE" >/dev/null 2>&1; do
    sleep 2
  done
fi

chown -R www-data:www-data storage bootstrap/cache database

if [ -z "${APP_KEY:-}" ]; then
  if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    APP_KEY="$(php -r 'echo "base64:".base64_encode(random_bytes(32));')"
  fi
fi

if [ -n "${APP_KEY:-}" ]; then
  if grep -q '^APP_KEY=' .env 2>/dev/null; then
    sed -i "s#^APP_KEY=.*#APP_KEY=${APP_KEY}#" .env
  else
    printf '\nAPP_KEY=%s\n' "${APP_KEY}" >> .env
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
