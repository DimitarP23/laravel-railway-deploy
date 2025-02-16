#!/bin/bash
echo "=== Starting Database Setup ==="
php artisan config:clear
php artisan cache:clear
echo "=== Running Migrations ==="
php artisan migrate:fresh --force --verbose
echo "=== Migration Complete ==="
echo "=== Starting Apache ==="
apache2-foreground
