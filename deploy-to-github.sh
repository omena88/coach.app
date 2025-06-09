#!/bin/bash

echo "🚀 Script para enviar el proyecto coach.app a GitHub"
echo "================================================="

# Verificar si estamos en un repositorio git
if [ ! -d ".git" ]; then
    echo "📁 Inicializando repositorio Git..."
    git init
    echo "✅ Repositorio Git inicializado"
fi

# Agregar el repositorio remoto
echo "🔗 Configurando repositorio remoto..."
git remote remove origin 2>/dev/null || true
git remote add origin https://github.com/omena88/coach.app.git
echo "✅ Repositorio remoto configurado"

# Crear o actualizar .gitignore
echo "📝 Actualizando .gitignore..."
cat > .gitignore << 'EOF'
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
/.env
/.env.backup
/.env.production
/.phpunit.result.cache
/bootstrap/cache/*
/storage/logs/*
npm-debug.log*
yarn-debug.log*
yarn-error.log*
/.idea
/.vscode
EOF
echo "✅ .gitignore actualizado"

# Eliminar archivos innecesarios antes del commit
echo "🧹 Limpiando archivos innecesarios..."
rm -f public/hot
rm -f logo.coaching.png
rm -f resources/views/welcome.blade.php
echo "✅ Archivos innecesarios eliminados"

# Limpiar cache de Laravel
echo "🔄 Limpiando cache de Laravel..."
php artisan cache:clear 2>/dev/null || echo "⚠️ No se pudo limpiar cache (normal si no hay .env)"
php artisan config:clear 2>/dev/null || echo "⚠️ No se pudo limpiar config"
php artisan view:clear 2>/dev/null || echo "⚠️ No se pudo limpiar vistas"
echo "✅ Cache limpiado"

# Agregar todos los archivos
echo "📋 Agregando archivos al staging..."
git add .
echo "✅ Archivos agregados"

# Hacer commit
echo "💾 Creando commit..."
git commit -m "feat: Sistema completo de gestión de sesiones de coaching

- Implementado sistema de autenticación con Laravel Breeze
- CRUD completo para sesiones de coaching
- Gestión de compromisos con seguimiento de estado
- Sistema de roles (Admin, Coach, Coachee) con permisos
- Interfaz moderna con Tailwind CSS
- Configuración para despliegue en Easypanel
- Base de datos SQLite con seeders de datos de prueba
- Dashboard personalizado según rol de usuario
- Políticas de acceso granular
- Documentación completa incluida"

echo "✅ Commit creado"

# Configurar rama principal
echo "🌿 Configurando rama principal..."
git branch -M main
echo "✅ Rama main configurada"

echo ""
echo "🎯 SIGUIENTE PASO:"
echo "Ejecuta el siguiente comando para enviar al repositorio:"
echo ""
echo "git push -u origin main"
echo ""
echo "Si es la primera vez, es posible que necesites autenticarte con GitHub."
echo "Usa un Personal Access Token en lugar de tu contraseña."
echo ""
echo "📋 RESUMEN DE LO QUE SE ENVIARÁ:"
echo "- ✅ Aplicación Laravel completa"
echo "- ✅ Sistema de gestión de coaching"
echo "- ✅ Configuración de despliegue"
echo "- ✅ Documentación"
echo "- ✅ Archivos optimizados (sin node_modules/vendor)"
echo ""
echo "🚀 ¡Listo para enviar a GitHub!" 