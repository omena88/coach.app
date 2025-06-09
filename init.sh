#!/bin/bash

# Generar key de aplicación si no existe
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
    php artisan key:generate --no-interaction
fi

# Crear directorio de base de datos SQLite si no existe
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite

# Ejecutar migraciones
php artisan migrate --force

# Optimizar la aplicación para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlaces simbólicos para storage
php artisan storage:link

echo "Laravel application initialized successfully!" 