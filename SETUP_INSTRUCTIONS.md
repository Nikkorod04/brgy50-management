# Barangay 50 Mulopyo Management System

A professional web-based management system for Barangay 50 to manage citizen records, categories, and generate reports.

## Features

- ✅ **Citizen Management**: Add, edit, view, and manage citizen records
- ✅ **Category Management**: Organize citizens by categories (PWD, Senior Citizens, Solo Parents, LGBTQ+, etc.)
- ✅ **PDF Export**: Generate customizable PDF reports of citizen data
- ✅ **Professional Dashboard**: View statistics and citizen breakdown at a glance
- ✅ **SQLite Database**: Lightweight database perfect for single-user operations
- ✅ **Responsive Design**: Works on desktop and tablets
- ✅ **Authentication**: Secure login system

## System Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version (for dependency management)
- **Node.js & NPM**: For building frontend assets
- **Windows 7 or higher** (or any OS with PHP support)

## Quick Start - Easy Installation

### Step 1: Copy to USB Drive

Copy the entire project folder to your USB drive.

### Step 2: Run Installation on Barangay PC

1. Connect USB drive to the Barangay PC
2. Copy the entire project folder to the PC (e.g., `C:\Barangay50Management\`)
3. Open Command Prompt and navigate to the project folder:
   ```
   cd C:\Barangay50Management
   ```
4. Double-click **INSTALL.bat** to automatically install everything

   OR run manually:
   ```
   INSTALL.bat
   ```

### Step 3: Start the Application

Once installation completes, you can start the server:

**Option 1 (Easy)**: Double-click **START.bat**

**Option 2 (Manual)**: Open Command Prompt in the project folder and run:
```
php artisan serve
```

### Step 4: Access the Application

Open your web browser and go to:
```
http://localhost:8000
```

### Login Credentials

```
Username: brgy50
Password: brgy50
```

## Manual Installation (If Scripts Don't Work)

If the batch scripts don't work, follow these steps manually:

### 1. Install PHP Dependencies
```
composer install
```

### 2. Install NPM Dependencies
```
npm install
```

### 3. Copy Environment File
```
copy .env.example .env
```

### 4. Generate Application Key
```
php artisan key:generate
```

### 5. Build Frontend Assets
```
npm run build
```

### 6. Run Database Setup
```
php artisan migrate:fresh --seed
```

### 7. Start the Development Server
```
php artisan serve
```

## Project Structure

```
brgy50-management-system/
├── app/                 # Application code (Models, Controllers)
├── database/            # Migrations, seeders, factories
├── resources/           # Views, CSS, JavaScript
├── routes/              # URL routes
├── config/              # Configuration files
├── public/              # Public assets (images, logos)
├── storage/             # Application storage
├── vendor/              # Composer dependencies
├── node_modules/        # NPM dependencies
├── INSTALL.bat          # Automated installation script
├── START.bat            # Quick start server script
├── composer.json        # PHP dependencies
├── package.json         # JavaScript dependencies
└── artisan              # Laravel CLI
```

## Database

The application uses **SQLite** for data storage. The database file is automatically created at:
```
database/database.sqlite
```

This is a file-based database, so no separate database server is needed!

## Features Guide

### Dashboard
- View total citizens count
- Gender distribution breakdown
- Active categories count
- System status

### Citizens Management
- Add new citizen records with detailed information
- Upload profile pictures and ID photos
- Assign citizens to categories
- Export citizen data to PDF
- Search and filter citizens

### Categories
- Manage citizen categories
- Assign icons and colors to categories
- View citizen breakdown by category

### PDF Export
- Generate professional PDF reports
- Select which columns to include
- Customizable report format

## Troubleshooting

### Issue: "PHP command not found"
**Solution**: Make sure PHP is installed and added to your system PATH

### Issue: "composer command not found"
**Solution**: Download and install Composer from https://getcomposer.org

### Issue: "npm command not found"
**Solution**: Download and install Node.js from https://nodejs.org

### Issue: Database errors
**Solution**: Delete `database/database.sqlite` and run:
```
php artisan migrate:fresh --seed
```

### Issue: Port 8000 already in use
**Solution**: Use a different port:
```
php artisan serve --port=8080
```

## Support

For issues or questions, check the following:
1. Make sure all prerequisites are installed (PHP, Composer, Node.js)
2. Run the installation script again
3. Check error messages in the command prompt for details

## License

This project is for Barangay 50 use only.

---

**Version**: 1.0  
**Last Updated**: October 18, 2025  
**Created by**: Nikkorod04
