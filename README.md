# Barangay 50 Citizen Management & Demographics System

A comprehensive web-based citizen management system for Barangay 50, Tacloban City, Philippines.

![Laravel](https://img.shields.io/badge/Laravel-11-red) ![PHP](https://img.shields.io/badge/PHP-8.1+-blue) ![MySQL](https://img.shields.io/badge/MySQL-8.0+-blue) ![Status](https://img.shields.io/badge/Status-Production%20Ready-green)

## 📋 Overview

This system is designed to help Barangay 50 officials manage citizen records, organize demographic data, and maintain accurate citizen information with photo documentation and categorization support.

**Demo Credentials:**
- **Username:** `brgy50`
- **Password:** `brgy50`

## ✨ Key Features

### 🔐 Authentication
- Username-based login (no email required)
- Pre-configured admin account
- Password reset functionality
- Secure session management

### 👥 Citizen Management (Full CRUD)
- Add citizens with 25+ demographic fields
- Upload profile pictures (1x1) and national ID photos
- Comprehensive search and filtering
- Soft delete with status tracking
- Edit citizen information anytime

### 📂 Category Management
- Create custom categories (PWD, Senior Citizens, LGBTQ+, etc.)
- Color-coded organization
- Assign multiple categories per citizen
- Dynamic category statistics

### 🔍 Advanced Filtering
- Search by name, email, phone, PCN
- Filter by gender, civil status, age group
- Category-based filtering
- Combine multiple filters

### 📊 Dashboard & Analytics
- Total citizen statistics
- Gender distribution overview
- Category-based statistics
- Quick action buttons

### 📱 Responsive Design
- Mobile-friendly interface
- Tablet optimization
- Desktop-optimized layout
- Dark mode support
- Accessible UI

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+ with extensions (curl, fileinfo, json, mbstring, xml, zip)
- MySQL 8.0+
- Composer
- Node.js & npm (optional)

### Installation

1. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Setup Environment**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

3. **Create Database**
   ```bash
   CREATE DATABASE brgy50_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

4. **Run Migrations & Seeds**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Start Server**
   ```bash
   php artisan serve
   ```
   
   Open: `http://127.0.0.1:8000`

## 📊 Database Schema

| Table | Purpose |
|-------|---------|
| `users` | Admin accounts (username-based login) |
| `citizens` | Citizen records with demographic data |
| `categories` | Custom classification categories |
| `category_citizen` | Many-to-many relationship |

## 📁 Project Structure

```
brgy50-management-system/
├── app/
│   ├── Models/                    # Data models
│   │   ├── User.php
│   │   ├── Citizen.php
│   │   └── Category.php
│   └── Http/Controllers/          # Business logic
│       ├── CitizenController.php
│       └── CategoryController.php
├── database/
│   ├── migrations/                # 11 database schemas
│   └── seeders/                   # Sample data
├── resources/views/               # Blade templates
│   ├── layouts/
│   ├── citizens/
│   └── categories/
├── routes/
│   ├── web.php                    # All routes
│   └── auth.php                   # Auth routes
└── storage/
    └── app/public/                # File uploads
```

## 🎯 Sample Data

- **1 Admin:** username `brgy50`, password `brgy50`
- **50 Citizens:** Pre-populated with realistic Filipino data
- **5 Categories:** PWD, Senior Citizens, LGBTQ+, Solo Parents, Household Heads

## 📖 Usage Guide

### Login
```
Username: brgy50
Password: brgy50
```

### Add Citizen
1. Click "Citizens" → "+ Add New Citizen"
2. Fill required fields (*, marked in red)
3. Upload pictures (optional)
4. Select categories
5. Submit

### View/Edit Citizen
1. Click citizen name in list
2. Review all information
3. Click "Edit" to modify
4. Save changes

### Manage Categories
1. Click "Categories"
2. Create new, edit, or delete
3. Assign to citizens

### Filter Citizens
- Search by name, email, phone, or PCN
- Filter by gender, civil status, age group, category
- Combine multiple filters

## 🔧 Configuration

### Key Files
- `.env` - Environment variables
- `config/database.php` - Database config
- `routes/web.php` - All routes

### Default Settings
- Database: `brgy50_management` (local MySQL)
- Session: 120 minutes (database-stored)
- File Uploads: Max 2MB (JPEG, PNG, GIF)
- File Storage: `storage/app/public/`

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| Database connection error | Ensure MySQL is running, database exists |
| Files not uploading | Run `php artisan storage:link` |
| Class not found | Run `composer dump-autoload` |
| Login fails | Run `php artisan migrate:fresh --seed` |
| Page errors | Clear caches: `php artisan cache:clear` |

## 📝 File Locations

- **Logs:** `storage/logs/laravel.log`
- **Profile Pictures:** `storage/app/public/citizens/profile-pictures/`
- **National IDs:** `storage/app/public/citizens/national-ids/`
- **Uploaded Files:** `public/storage/`

## 🔐 Security

- Passwords hashed with bcrypt (12 rounds)
- Session stored in database (not files)
- File upload validation (type & size)
- CSRF protection on all forms
- Input validation on all endpoints

## 📚 Additional Commands

```bash
# View logs
tail -f storage/logs/laravel.log

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Database backup
php artisan db:dump

# Database restore
php artisan db:dump --load

# Check status
php artisan status

# Create backup
php artisan backup:run
```

## 📄 Testing

See [TESTING.md](./TESTING.md) for comprehensive testing checklist and procedures.

## 🔄 Maintenance

- **Weekly:** Check logs for errors
- **Monthly:** Backup database
- **Quarterly:** Update dependencies
- **Yearly:** Security audit

## 🚀 Deployment

When ready for production:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Generate strong `APP_KEY`
4. Use a production database
5. Configure proper backups
6. Set up logging/monitoring

## 📞 Support

For issues:
1. Check `storage/logs/laravel.log`
2. Review [TESTING.md](./TESTING.md)
3. Verify all prerequisites are installed
4. Check database connectivity

## 📅 Version History

- **v1.0** (Oct 17, 2025) - Initial release
  - Authentication system
  - Citizen CRUD
  - Category management
  - File uploads
  - Advanced filtering
  - Dashboard

## 📄 License

Internal Use - Barangay 50, Tacloban City Only

## 👥 Support Team

For technical issues or feature requests, contact the development team.

---

**Status:** ✅ Production Ready  
**Last Updated:** October 17, 2025  
**Built with:** Laravel 11 + Blade + Tailwind CSS + MySQL

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
