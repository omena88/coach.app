# Guía de Despliegue en Easypanel

## Pasos para desplegar la aplicación Laravel en Easypanel

### 1. Preparar el repositorio
- Asegúrate de que todos los archivos estén en tu repositorio Git
- Sube los archivos creados: `Dockerfile`, `apache-config.conf`, `easypanel.yml`, `init.sh`, etc.

### 2. Configurar variables de entorno
Antes de desplegar, edita el archivo `easypanel.yml` y cambia:
- `tudominio.com` por tu dominio real
- `tu_password_mysql` por una contraseña segura para MySQL
- `tu_email@gmail.com` por tu email real
- `tu_app_password` por tu contraseña de aplicación de Gmail

### 3. Subir a Easypanel
1. Ve a tu panel de Easypanel
2. Crea un nuevo proyecto
3. Conecta tu repositorio Git
4. Selecciona el archivo `easypanel.yml` como configuración
5. Inicia el despliegue

### 4. Configurar dominio
1. En Easypanel, ve a la sección de dominios
2. Añade tu dominio personalizado
3. Configura los DNS para que apunten a tu VPS

### 5. Configurar SSL
1. En Easypanel, habilita SSL automático (Let's Encrypt)
2. Esto se configurará automáticamente para tu dominio

### 6. Verificar el despliegue
1. Accede a tu dominio
2. Verifica que la aplicación Laravel esté funcionando
3. Prueba las funcionalidades principales

## Estructura de archivos creados:
- `Dockerfile` - Configuración de contenedor Docker
- `apache-config.conf` - Configuración de Apache
- `easypanel.yml` - Configuración de Easypanel
- `init.sh` - Script de inicialización de Laravel
- `.dockerignore` - Archivos a excluir del build de Docker

## Servicios incluidos:
- **app**: Aplicación Laravel con PHP 8.2 y Apache
- **mysql**: Base de datos MySQL 8.0

## Puertos expuestos:
- **80**: Aplicación web
- **3306**: Base de datos MySQL (solo interno)

## Volúmenes persistentes:
- `app_storage`: Archivos de storage de Laravel
- `mysql_data`: Datos de la base de datos MySQL

## Solución de problemas:
1. Si la aplicación no inicia, revisa los logs en Easypanel
2. Verifica que las variables de entorno estén configuradas correctamente
3. Asegúrate de que el dominio apunte correctamente a tu VPS
4. Si hay errores de permisos, verifica que los directorios de storage tengan los permisos correctos 