@echo off
setlocal enabledelayedexpansion

echo.
echo ======================================================
echo   Barangay 50 Management System - Installation
echo ======================================================
echo.

REM Check if we're in the right directory
if not exist "composer.json" (
    echo Error: composer.json not found!
    echo Please run this script from the project root directory.
    pause
    exit /b 1
)

echo Step 1: Installing dependencies...
call composer install
if errorlevel 1 (
    echo Error: Failed to install composer dependencies
    pause
    exit /b 1
)

echo.
echo Step 2: Installing NPM dependencies...
call npm install
if errorlevel 1 (
    echo Error: Failed to install npm dependencies
    pause
    exit /b 1
)

echo.
echo Step 3: Setting up environment configuration...
if not exist ".env" (
    copy .env.example .env
    echo Generated .env file
)

echo.
echo Step 4: Generating application key...
call php artisan key:generate

echo.
echo Step 5: Building assets...
call npm run build
if errorlevel 1 (
    echo Error: Failed to build assets
    pause
    exit /b 1
)

echo.
echo Step 6: Running database migrations...
call php artisan migrate:fresh --seed
if errorlevel 1 (
    echo Error: Failed to run migrations
    pause
    exit /b 1
)

echo.
echo ======================================================
echo   Installation Complete!
echo ======================================================
echo.
echo Login Credentials:
echo   Username: brgy50
echo   Password: brgy50
echo.
echo To start the development server:
echo   php artisan serve
echo.
echo The application will be available at:
echo   http://localhost:8000
echo.
pause
