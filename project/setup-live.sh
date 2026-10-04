#!/bin/bash

# Setup script for live deployment
echo "Setting up live environment..."

# Create necessary directories
mkdir -p storage/logs
mkdir -p storage/app
mkdir -p bootstrap/cache
mkdir -p public/uploads

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod 777 public

# Run composer install if needed
if [ ! -d "vendor" ]; then
  echo "Installing dependencies..."
  composer install --no-dev --optimize-autoloader
fi

# Generate app key if needed
if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
  echo "Generating app key..."
  php artisan key:generate
fi

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Clear caches
echo "Clearing caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Setup complete!"
