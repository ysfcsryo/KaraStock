@echo off
echo ========================================
echo  KaraStock - Sync CSS ke Public
echo ========================================
echo.

echo [1/3] Copying CSS files...
copy /Y "resources\css\app.css" "public\css\app.css"

echo.
echo [2/3] Clearing Laravel cache...
php artisan cache:clear
php artisan view:clear
php artisan config:clear

echo.
echo [3/3] Done!
echo ========================================
echo  CSS berhasil di-sync!
echo  Refresh browser dengan Ctrl+F5
echo ========================================
pause
