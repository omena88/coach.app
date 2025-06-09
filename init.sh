#!/bin/bash

# Generar key de aplicación si no existe
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
    php artisan key:generate --no-interaction
fi

# Esperar a que MySQL esté disponible
echo "Esperando a que MySQL esté disponible..."
while ! mysqladmin ping -h"${DB_HOST:-mysql}" -u"${DB_USERNAME:-root}" -p"${DB_PASSWORD}" --silent; do
    sleep 1
done
echo "MySQL está disponible!"

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Optimizar la aplicación para producción
echo "Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlaces simbólicos para storage
php artisan storage:link

echo "Laravel application initialized successfully with MySQL!" 