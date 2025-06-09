# Gestión de Coaches - Documentación

## Descripción General

Se ha implementado un sistema completo de gestión de coaches para administradores, que permite crear, editar, ver y eliminar coaches desde el panel de administración.

## Características Implementadas

### 1. **Controlador de Coaches** (`CoachController`)
- ✅ CRUD completo para coaches
- ✅ Restricción de acceso solo para administradores
- ✅ Validación de datos
- ✅ Protección contra eliminación de coaches con coachees asignados

### 2. **Vistas de Gestión**
- ✅ **Lista de coaches** (`coaches/index.blade.php`)
  - Tabla con información de coaches
  - Contadores de coachees y sesiones
  - Acciones: Ver, Editar, Eliminar
- ✅ **Crear coach** (`coaches/create.blade.php`)
  - Formulario de creación con validación
- ✅ **Editar coach** (`coaches/edit.blade.php`)
  - Formulario de edición con datos pre-cargados
- ✅ **Ver detalles** (`coaches/show.blade.php`)
  - Información completa del coach
  - Estadísticas detalladas
  - Lista de coachees asignados
  - Historial de sesiones

### 3. **Navegación**
- ✅ Enlace "Gestionar Coaches" en el menú principal (solo para admins)
- ✅ Enlace en versión móvil/responsive

### 4. **Dashboard de Administración**
- ✅ Panel especial para administradores
- ✅ Estadísticas generales del sistema:
  - Total de coaches
  - Total de coachees
  - Total de sesiones
  - Coaches activos (con coachees asignados)
- ✅ Acceso directo a gestión de coaches

### 5. **Seeders y Comandos**
- ✅ **CoachSeeder**: Crea coaches de ejemplo
- ✅ **Comando Artisan**: `php artisan coach:create "Nombre" "email@ejemplo.com" "password"`

## Rutas Implementadas

```php
// Rutas para coaches (solo para administradores)
Route::resource('coaches', CoachController::class);
```

### Rutas específicas:
- `GET /coaches` - Lista de coaches
- `GET /coaches/create` - Formulario de creación
- `POST /coaches` - Guardar nuevo coach
- `GET /coaches/{coach}` - Ver detalles del coach
- `GET /coaches/{coach}/edit` - Formulario de edición
- `PUT /coaches/{coach}` - Actualizar coach
- `DELETE /coaches/{coach}` - Eliminar coach

## Permisos y Seguridad

### Restricciones de Acceso
- ✅ Solo usuarios con rol `ADMIN` pueden acceder
- ✅ Middleware de verificación en el constructor del controlador
- ✅ Verificación adicional en las vistas

### Validaciones
- ✅ Nombre requerido (máximo 255 caracteres)
- ✅ Email único y válido
- ✅ Contraseña con confirmación (mínimo según reglas de Laravel)
- ✅ Protección contra eliminación de coaches con coachees

## Funcionalidades del Administrador como Coach

### El administrador puede:
- ✅ Funcionar como coach regular
- ✅ Tener coachees asignados
- ✅ Crear y gestionar sesiones
- ✅ Ver estadísticas propias como coach
- ✅ Acceder a funciones administrativas adicionales

## Comandos Útiles

### Crear un coach desde línea de comandos:
```bash
php artisan coach:create "Nombre del Coach" "email@ejemplo.com" "password123"
```

### Ejecutar seeders:
```bash
php artisan db:seed --class=CoachSeeder
```

### Ejecutar todos los seeders:
```bash
php artisan db:seed
```

## Estructura de Archivos Creados/Modificados

```
app/
├── Http/Controllers/
│   └── CoachController.php          # Controlador principal
├── Console/Commands/
│   └── CreateCoachCommand.php       # Comando Artisan
└── Models/
    └── User.php                     # Ya existía (sin cambios)

database/seeders/
├── CoachSeeder.php                  # Seeder para coaches
└── DatabaseSeeder.php               # Actualizado

resources/views/
├── coaches/
│   ├── index.blade.php              # Lista de coaches
│   ├── create.blade.php             # Crear coach
│   ├── edit.blade.php               # Editar coach
│   └── show.blade.php               # Ver coach
├── dashboard/
│   └── index.blade.php              # Dashboard actualizado
└── layouts/
    └── navigation.blade.php         # Navegación actualizada

routes/
└── web.php                          # Rutas actualizadas
```

## Próximos Pasos Sugeridos

1. **Notificaciones**: Implementar notificaciones cuando se crea/edita un coach
2. **Exportación**: Añadir funcionalidad para exportar lista de coaches
3. **Filtros**: Implementar filtros y búsqueda en la lista de coaches
4. **Estadísticas avanzadas**: Gráficos de rendimiento por coach
5. **Asignación masiva**: Herramienta para asignar coachees a coaches

## Notas Importantes

- El primer usuario administrador automáticamente puede funcionar como coach
- Los coaches no pueden ser eliminados si tienen coachees asignados
- Todas las vistas están optimizadas para dispositivos móviles
- Se mantiene la consistencia visual con el resto de la aplicación 