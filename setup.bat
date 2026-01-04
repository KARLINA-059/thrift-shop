@echo off
echo ===========================================
echo    THRIFT SHOP - AUTO SETUP SCRIPT
echo ===========================================
echo.

echo [1/8] Installing PHP dependencies...
composer install
if %errorlevel% neq 0 (
    echo Error: Composer install failed
    pause
    exit /b 1
)

echo.
echo [2/8] Installing Node.js dependencies...
npm install
if %errorlevel% neq 0 (
    echo Error: NPM install failed
    pause
    exit /b 1
)

echo.
echo [3/8] Building assets...
npm run build
if %errorlevel% neq 0 (
    echo Error: NPM build failed
    pause
    exit /b 1
)

echo.
echo [4/8] Copying environment file...
if not exist .env (
    copy .env.example .env
    echo .env file created. Please edit database configuration in .env file
    notepad .env
)

echo.
echo [5/8] Generating application key...
php artisan key:generate

echo.
echo [6/8] Setting up storage link...
php artisan storage:link

echo.
echo [7/8] Clearing caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo [8/8] Setup completed!
echo.
echo Next steps:
echo 1. Create database 'thrift_shop' in MySQL
echo 2. Import database_backup.sql if available, or run: php artisan migrate --seed
echo 3. Run: php artisan serve
echo.
echo Admin login: admin@thriftshop.com / admin123
echo.
pause