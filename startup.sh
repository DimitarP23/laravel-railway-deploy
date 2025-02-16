#!/bin/bash

# Print current directory and list files
echo "=== Current Directory ==="
pwd
ls -la

# Clear Laravel caches
echo "=== Clearing Caches ==="
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Show database status
echo "=== Database Status ==="
php artisan db:show

# Run migrations
echo "=== Running Migrations ==="
php artisan migrate:fresh --force --verbose
echo "=== Migration Status ==="
php artisan migrate:status

# Start Apache
echo "=== Starting Apache ==="
apache2-foreground
