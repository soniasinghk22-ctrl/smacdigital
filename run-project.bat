@echo off
title SMAC Digital Server
cd /d "%~dp0"

set "PHP_BIN=C:\Users\Anjali\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.4_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
if not exist "%PHP_BIN%" (
    set "PHP_BIN=php"
)

echo ====================================================
echo             SMAC DIGITAL LARAVEL SERVER             
echo ====================================================
echo.
echo Website URL:  http://127.0.0.1:8000
echo               http://localhost:8000
echo Admin Panel:  http://127.0.0.1:8000/admin/login
echo Login Email:  admin@smacdigital.com
echo Password:     Admin@123456
echo ====================================================
echo.
"%PHP_BIN%" artisan serve --host=0.0.0.0 --port=8000
pause
