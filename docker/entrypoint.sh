#!/bin/sh

echo "🔧 Fixing permissions on /var/www/writable"
chown -R www-data:www-data /var/www/writable
chmod -R 775 /var/www/writable
echo "✅ Permissions fixed"

# Lance PHP-FPM
exec php-fpm
