Write-Host "🚀 Script para enviar el proyecto coach.app a GitHub" -ForegroundColor Green
Write-Host "=================================================" -ForegroundColor Green

# Verificar si estamos en un repositorio git
if (-not (Test-Path ".git")) {
    Write-Host "📁 Inicializando repositorio Git..." -ForegroundColor Yellow
    git init
    Write-Host "✅ Repositorio Git inicializado" -ForegroundColor Green
}

# Agregar el repositorio remoto
Write-Host "🔗 Configurando repositorio remoto..." -ForegroundColor Yellow
git remote remove origin 2>$null
git remote add origin https://github.com/omena88/coach.app.git
Write-Host "✅ Repositorio remoto configurado" -ForegroundColor Green

# Crear o actualizar .gitignore
Write-Host "📝 Actualizando .gitignore..." -ForegroundColor Yellow
@"
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
"@ | Out-File -FilePath ".gitignore" -Encoding UTF8
Write-Host "✅ .gitignore actualizado" -ForegroundColor Green

# Eliminar archivos innecesarios antes del commit
Write-Host "🧹 Limpiando archivos innecesarios..." -ForegroundColor Yellow
if (Test-Path "public/hot") { Remove-Item "public/hot" -Force }
if (Test-Path "logo.coaching.png") { Remove-Item "logo.coaching.png" -Force }
if (Test-Path "resources/views/welcome.blade.php") { Remove-Item "resources/views/welcome.blade.php" -Force }
Write-Host "✅ Archivos innecesarios eliminados" -ForegroundColor Green

# Limpiar cache de Laravel
Write-Host "🔄 Limpiando cache de Laravel..." -ForegroundColor Yellow
try {
    php artisan cache:clear 2>$null
    php artisan config:clear 2>$null
    php artisan view:clear 2>$null
    Write-Host "✅ Cache limpiado" -ForegroundColor Green
} catch {
    Write-Host "⚠️ No se pudo limpiar cache (normal si no hay .env)" -ForegroundColor Yellow
}

# Reemplazar README actual con el optimizado para GitHub
Write-Host "📄 Actualizando README para GitHub..." -ForegroundColor Yellow
if (Test-Path "README-GITHUB.md") {
    Copy-Item "README-GITHUB.md" "README.md" -Force
    Remove-Item "README-GITHUB.md" -Force
    Write-Host "✅ README actualizado" -ForegroundColor Green
}

# Agregar todos los archivos
Write-Host "📋 Agregando archivos al staging..." -ForegroundColor Yellow
git add .
Write-Host "✅ Archivos agregados" -ForegroundColor Green

# Hacer commit
Write-Host "💾 Creando commit..." -ForegroundColor Yellow
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

Write-Host "✅ Commit creado" -ForegroundColor Green

# Configurar rama principal
Write-Host "🌿 Configurando rama principal..." -ForegroundColor Yellow
git branch -M main
Write-Host "✅ Rama main configurada" -ForegroundColor Green

Write-Host ""
Write-Host "🎯 SIGUIENTE PASO:" -ForegroundColor Cyan
Write-Host "Ejecuta el siguiente comando para enviar al repositorio:" -ForegroundColor White
Write-Host ""
Write-Host "git push -u origin main" -ForegroundColor Yellow
Write-Host ""
Write-Host "Si es la primera vez, es posible que necesites autenticarte con GitHub." -ForegroundColor White
Write-Host "Usa un Personal Access Token en lugar de tu contraseña." -ForegroundColor White
Write-Host ""
Write-Host "📋 RESUMEN DE LO QUE SE ENVIARÁ:" -ForegroundColor Cyan
Write-Host "- ✅ Aplicación Laravel completa" -ForegroundColor Green
Write-Host "- ✅ Sistema de gestión de coaching" -ForegroundColor Green
Write-Host "- ✅ Configuración de despliegue" -ForegroundColor Green
Write-Host "- ✅ Documentación optimizada" -ForegroundColor Green
Write-Host "- ✅ Archivos optimizados (sin node_modules/vendor)" -ForegroundColor Green
Write-Host ""
Write-Host "🚀 ¡Listo para enviar a GitHub!" -ForegroundColor Green 