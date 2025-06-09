# 🚀 Guía de Despliegue en VPS con Docker

## 📋 Variables de Entorno Requeridas

Tu VPS necesita estas variables de entorno configuradas:

### **🔧 Configuración de Aplicación**
```env
APP_NAME=CoachApp
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
```

### **🗄️ Configuración de Base de Datos MySQL**
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=webcoaching
DB_USERNAME=root
DB_PASSWORD=TU_PASSWORD_SEGURO_AQUI
```

### **📧 Configuración de Email (Opcional)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-app-password
MAIL_ENCRYPTION=tls
```

## 🐳 Servicios que se Crearán

### **1. Contenedor de Aplicación (app)**
- **Puerto**: 80
- **Imagen**: Se construye desde tu Dockerfile
- **Incluye**: PHP 8.2, Apache, Laravel, Composer, npm

### **2. Contenedor de Base de Datos (mysql)**
- **Puerto**: 3306
- **Imagen**: mysql:8.0
- **Base de datos**: `webcoaching` (se crea automáticamente)
- **Volumen persistente**: Los datos no se pierden al reiniciar

## 🔄 Proceso Automático de Inicialización

Cuando se despliega, **automáticamente**:

1. ✅ **Instala dependencias** PHP (composer install)
2. ✅ **Compila assets** frontend (npm run build)  
3. ✅ **Crea archivo .env** con variables de entorno
4. ✅ **Genera APP_KEY** de Laravel
5. ✅ **Crea base de datos MySQL** 
6. ✅ **Ejecuta migraciones** (crea todas las tablas)
7. ✅ **Optimiza aplicación** (cache de config, rutas, vistas)
8. ✅ **Configura permisos** de archivos

## 📊 Tablas que se Crean Automáticamente

Al ejecutar las migraciones se crean:

- `users` - Usuarios (Admin, Coach, Coachee)  
- `coaching_sessions` - Sesiones de coaching
- `commitments` - Compromisos de sesiones
- `cache` - Cache de aplicación
- `jobs` - Cola de trabajos
- `migrations` - Control de migraciones

## 👥 Datos de Prueba (Seeders)

**¡IMPORTANTE!** Los seeders NO se ejecutan automáticamente en producción.

Si quieres datos de prueba, después del despliegue ejecuta:
```bash
docker exec -it <container-name> php artisan db:seed
```

### Usuarios de prueba que se crearían:
- **Admin**: oscar.mena@goodlinks.pe (password: password)
- **Coaches**: maria.gonzalez@coaching.com, carlos.rodriguez@coaching.com  
- **Coachees**: ana.lopez@empresa.com, pedro.martinez@empresa.com, etc.

## 🔒 Configuración de Seguridad

### **Variables Críticas a Cambiar:**
1. `DB_PASSWORD` - Usa una contraseña fuerte para MySQL
2. `APP_URL` - Tu dominio real  
3. `MAIL_*` - Configuración real de email

### **Recomendaciones:**
- Usa HTTPS (certificado SSL automático)
- Cambia contraseñas por defecto
- Configura backup de base de datos
- Monitorea logs de aplicación

## 📁 Volúmenes Persistentes

Se crean automáticamente:
- `app_storage` - Archivos subidos por usuarios
- `mysql_data` - Base de datos (¡no se pierde al reiniciar!)

## 🐛 Solución de Problemas

### **Si la aplicación no inicia:**
1. Verifica variables de entorno
2. Revisa logs del contenedor
3. Verifica conectividad con MySQL

### **Si hay errores de base de datos:**
1. Verifica que MySQL esté corriendo
2. Comprueba credenciales de DB_*
3. Verifica que puerto 3306 esté disponible

### **Comandos útiles:**
```bash
# Ver logs de aplicación
docker logs <container-name>

# Acceder al contenedor
docker exec -it <container-name> bash

# Ejecutar comandos Laravel
docker exec -it <container-name> php artisan migrate
docker exec -it <container-name> php artisan cache:clear
```

## 🎯 Plataformas Compatibles

Esta configuración funciona en:
- **Railway** 
- **Render**
- **DigitalOcean App Platform**
- **Heroku** (con Dockerfile)
- **AWS App Runner**
- **Google Cloud Run**
- **Cualquier VPS con Docker**

¡Tu aplicación estará lista en minutos! 🚀 