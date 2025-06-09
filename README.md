# 🎯 Coach.App - Sistema de Gestión de Sesiones de Coaching

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=flat-square&logo=tailwind-css)
![SQLite](https://img.shields.io/badge/SQLite-Database-003B57?style=flat-square&logo=sqlite)

Una aplicación web moderna desarrollada en **Laravel 11** para la gestión integral de sesiones de coaching, seguimiento de compromisos y administración de usuarios con diferentes roles.

## ✨ Características Principales

### 👥 **Sistema de Roles**
- **Administrador**: Gestión completa del sistema
- **Coach**: Manejo de sus sesiones y coachees
- **Coachee**: Vista de sus sesiones y compromisos

### 📅 **Gestión de Sesiones**
- CRUD completo para sesiones de coaching
- Múltiples modalidades: Presencial, Virtual, Telefónica
- Estados: Programada, Completada, Reprogramada, Cancelada
- Seguimiento de objetivos y notas

### 📋 **Sistema de Compromisos**
- Creación y seguimiento de compromisos por sesión
- Estados: Pendiente, Cumplido, No Cumplido
- Evaluaciones tanto del coach como del coachee
- Alertas de vencimiento

### 🔐 **Seguridad y Permisos**
- Autenticación completa con Laravel Breeze
- Políticas de acceso granular por rol
- Protección de rutas sensibles
- Validación robusta de datos

## 🛠️ Tecnologías

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Base de Datos**: SQLite (configurable a MySQL/PostgreSQL)
- **Autenticación**: Laravel Breeze
- **Build Tool**: Vite
- **Despliegue**: Docker + Easypanel

## 🚀 Instalación Rápida

```bash
# Clonar el repositorio
git clone https://github.com/omena88/coach.app.git
cd coach.app

# Instalar dependencias
composer install
npm install

# Configuración inicial
cp .env.example .env
php artisan key:generate

# Base de datos y seeders
php artisan migrate --seed

# Compilar assets
npm run build

# Iniciar servidor
php artisan serve
```

## 👤 Usuarios de Prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| **Admin** | oscar.mena@goodlinks.pe | password |
| **Coach** | maria.gonzalez@coaching.com | password |
| **Coach** | carlos.rodriguez@coaching.com | password |
| **Coachee** | ana.lopez@empresa.com | password |

## 📱 Capturas de Pantalla

### Dashboard de Administrador
![Dashboard Admin](https://via.placeholder.com/800x400/4F46E5/FFFFFF?text=Dashboard+Admin)

### Gestión de Sesiones
![Sesiones](https://via.placeholder.com/800x400/059669/FFFFFF?text=Gestión+de+Sesiones)

### Seguimiento de Compromisos
![Compromisos](https://via.placeholder.com/800x400/DC2626/FFFFFF?text=Compromisos)

## 🐳 Despliegue

### Docker + Easypanel
```bash
# El proyecto incluye configuración completa para Easypanel
# Ver archivo: easypanel.yml
```

### Configuración Manual
```bash
# Producción
composer install --no-dev --optimize-autoloader
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📊 Estructura del Proyecto

```
coach.app/
├── app/
│   ├── Http/Controllers/    # Controladores principales
│   ├── Models/             # Modelos Eloquent
│   ├── Policies/           # Políticas de autorización
│   └── *.php              # Enums y tipos
├── database/
│   ├── migrations/         # Esquema de base de datos
│   └── seeders/           # Datos de prueba
├── resources/
│   ├── views/             # Vistas Blade
│   ├── css/               # Estilos CSS
│   └── js/                # JavaScript
└── routes/
    └── web.php            # Rutas de la aplicación
```

## 🎯 Funcionalidades Detalladas

### Para Administradores
- ✅ Dashboard con estadísticas globales
- ✅ Gestión completa de coaches y coachees
- ✅ Vista global de todas las sesiones
- ✅ Administración de compromisos
- ✅ Reportes y métricas

### Para Coaches
- ✅ Dashboard personalizado con sus métricas
- ✅ Gestión de sus propias sesiones
- ✅ Lista de coachees asignados
- ✅ Creación y seguimiento de compromisos
- ✅ Evaluación de compromisos

### Para Coachees
- ✅ Vista de sus sesiones programadas
- ✅ Historial de sesiones completadas
- ✅ Lista de compromisos pendientes
- ✅ Evaluación de compromisos cumplidos

## 📈 Métricas y Reportes

- Total de sesiones por estado
- Tasa de cumplimiento de compromisos
- Estadísticas por coach
- Tendencias temporales
- Reportes de actividad

## 🔧 Comandos Artisan Personalizados

```bash
# Crear un coach desde línea de comandos
php artisan coach:create "Nombre" "email@ejemplo.com" "password"

# Ejecutar seeders específicos
php artisan db:seed --class=CoachSeeder
```

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Añadir nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver `LICENSE` para más detalles.

## 📞 Contacto

**Desarrollador**: Oscar Mena  
**Email**: oscar.mena@goodlinks.pe  
**GitHub**: [@omena88](https://github.com/omena88)

---

⭐ **¡Dale una estrella si te gusta el proyecto!** ⭐ 