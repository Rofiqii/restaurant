#!/bin/bash

# Copy .env jika belum ada
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Generate app key jika APP_KEY kosong
if ! grep -q "APP_KEY=base64" .env; then
  php artisan key:generate
fi

# Tunggu database siap
until php artisan migrate --force; do
  echo "Waiting for DB..."
  sleep 5
done

# Jalankan PHP-FPM
php-fpm
