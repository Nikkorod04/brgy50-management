@echo off
setlocal enabledelayedexpansion

REM Check if we're in the right directory
if not exist "artisan" (
    echo Error: artisan file not found!
    echo Please run this script from the project root directory.
    pause
    exit /b 1
)

echo.
echo ======================================================
echo   Barangay 50 Management System - Server Starting
echo ======================================================
echo.
echo Starting development server...
echo.
echo The application will be available at:
echo   http://localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo.

php artisan serve

pause
