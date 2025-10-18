# Barangay 50 Management System - Setup Guide

## 🚀 Project Setup Complete!

Your Laravel Barangay 50 Management System has been configured with the following:

### ✅ Completed Tasks:

1. **Environment Configuration (.env)**
   - App Name: "Barangay 50 Management System"
   - Database: MySQL (XAMPP) with database name `brgy50_management`
   - Debug mode: Enabled for development

2. **Authentication System**
   - Laravel Breeze installed with Blade + Tailwind CSS
   - User registration and login pages
   - Password reset functionality
   - Session management

3. **Database Schema**
   - Users table with `role` field (set to 'barangay_official' by default)
   - Password reset tokens table
   - Sessions table

4. **Welcome Page**
   - Custom Barangay 50 branded welcome page
   - Feature overview
   - Login/Register links
   - Responsive Tailwind CSS design

---

## 📋 Next Steps:

### 1. Start XAMPP Services
- Open XAMPP Control Panel
- Start **Apache** and **MySQL** services
- Verify both are running (green indicators)

### 2. Create Database
Since the database doesn't exist yet, you have two options:

**Option A: Using phpMyAdmin (Recommended for beginners)**
1. Open http://localhost/phpmyadmin in your browser
2. Click on "Databases" tab
3. Create a new database named: `brgy50_management`
4. Set collation to: `utf8mb4_unicode_ci`

**Option B: Using Command Line**
```bash
mysql -u root -p -e "CREATE DATABASE brgy50_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 3. Run Database Migrations
```bash
cd c:\Users\Nikko\Desktop\nikko\brgy50-management-system
php artisan migrate
```

### 4. Start Development Server
```bash
php artisan serve
```
The application will be available at: http://localhost:8000

### 5. Test Authentication
- Visit http://localhost:8000
- Click "Register" to create a new Barangay Official account
- Login with your credentials
- You'll be redirected to the dashboard

---

## 🗂️ Project Structure:

```
app/
├── Http/Controllers/
│   └── Auth/                    # Authentication controllers
├── Models/
│   └── User.php                 # User model (with 'role' field)
└── Providers/

resources/
├── css/app.css                  # Tailwind CSS
├── js/app.js                    # Frontend JavaScript
└── views/
    ├── welcome-brgy50.blade.php # Custom welcome page
    ├── dashboard.blade.php      # Dashboard (protected)
    ├── auth/
    │   ├── login.blade.php
    │   ├── register.blade.php
    │   ├── forgot-password.blade.php
    │   └── reset-password.blade.php
    └── layouts/
        └── app.blade.php        # Main layout template

database/
├── migrations/
│   └── 0001_01_01_000000_create_users_table.php
└── seeders/

routes/
├── web.php                      # Web routes
└── auth.php                     # Authentication routes
```

---

## 🔑 User Role:

All registered users are automatically assigned the role: **`barangay_official`**

This ensures only authorized Barangay Officials can access the system.

---

## 📦 Installed Packages:

- **laravel/breeze** - Authentication scaffolding
- **tailwindcss** - Utility-first CSS framework
- **laravel/framework** - Laravel core

---

## 🔧 Configuration Files:

- `.env` - Environment variables (MySQL connection)
- `config/app.php` - App configuration
- `config/database.php` - Database configuration

---

## 📝 Running Commands:

### Artisan Commands (from project directory):

```bash
# Create a new migration
php artisan make:migration create_citizens_table

# Create a new model
php artisan make:model Citizen

# Create a new controller
php artisan make:controller CitizenController --resource

# Run migrations
php artisan migrate

# Reset database (warning: deletes all data)
php artisan migrate:refresh

# Seed database with dummy data
php artisan db:seed
```

---

## 🚨 Troubleshooting:

**Problem: "Connection refused" when running migrations**
- Ensure XAMPP MySQL is running
- Check `.env` database credentials:
  - DB_HOST: 127.0.0.1
  - DB_PORT: 3306
  - DB_DATABASE: brgy50_management
  - DB_USERNAME: root
  - DB_PASSWORD: (empty for default XAMPP)

**Problem: Port 8000 already in use**
```bash
# Use a different port
php artisan serve --port=8001
```

**Problem: Node modules not installed**
```bash
npm install
npm run build
```

---

## 📞 Next Development Phase:

Once authentication is working, we will:
1. ✅ Create Citizen CRUD (Create, Read, Update, Delete)
2. ✅ Build filtering and search functionality
3. ✅ Add CSV/Excel export with Laravel Excel
4. ✅ Add PDF export with DOMPDF
5. ✅ Create analytics dashboard with Chart.js/ApexCharts
6. ✅ Implement optional features (households, certificates, audit trail)

---

**System Ready for Development!** 🎉
