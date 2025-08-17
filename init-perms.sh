#!/bin/sh

echo "🔧 Fixing permissions on writable/"
chown -R www-data:www-data writable
chmod -R 775 writable
echo "✅ Permissions fixed"
