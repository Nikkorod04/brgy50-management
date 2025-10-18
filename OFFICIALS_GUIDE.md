# Barangay 50 Management System - Setup Guide for Officials

## 🎯 System Overview

The Barangay 50 Citizen Management System is a simple web application that helps you:
- **Manage citizen records** (add, view, edit, delete)
- **Organize citizens** into categories (PWD, Senior Citizens, etc.)
- **Store documents** (profile pictures, national ID photos)
- **Search and filter** citizens easily
- **View statistics** and citizen data

**No previous computer experience needed!** Just follow the steps below.

---

## 💻 What You Need (One-Time Setup)

### Option A: Already Have Everything Installed
If your computer already has:
- PHP
- MySQL (or XAMPP)
- Composer

**Skip to:** "How to Start Using the System"

### Option B: Need to Install
You need to install 3 programs (in this order):

#### 1. **XAMPP** (Includes MySQL + PHP)
   - Download: https://www.apachefriends.org/
   - Choose Windows Installer (.exe)
   - Just click "Next, Next, Finish"
   - This installs MySQL and PHP automatically

#### 2. **Composer**
   - Download: https://getcomposer.org/download/
   - Click "Download Composer Setup"
   - Click "Next, Next, Finish"

#### 3. **Node.js** (Optional)
   - Download: https://nodejs.org/
   - Choose "LTS" version
   - Click "Next, Next, Finish"

---

## 🚀 How to Start Using the System

### Step 1: Open the Application Folder
1. Find folder: `C:\Users\[YourName]\Desktop\nikko\brgy50-management-system`
2. Open it (double-click on folder)

### Step 2: Run Setup (First Time Only)

Create a file called `setup.bat` with these contents:

```batch
@echo off
echo Starting Barangay 50 Management System setup...
echo.

REM Navigate to project folder
cd /d "%~dp0"

echo Installing dependencies...
composer install

echo Creating database...
echo CREATE DATABASE IF NOT EXISTS brgy50_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; | mysql -u root

echo Running migrations...
php artisan migrate:fresh --seed

echo Creating storage link...
php artisan storage:link

echo Setup complete!
echo.
pause
```

**To use:**
1. Copy the text above
2. Open Notepad
3. Paste the text
4. Save as `setup.bat` in the project folder
5. Double-click `setup.bat` to run

### Step 3: Start the Application

Create a file called `start.bat`:

```batch
@echo off
title Barangay 50 Management System
cd /d "%~dp0"

echo.
echo ================================================
echo   Barangay 50 Citizen Management System
echo ================================================
echo.
echo Server starting... This may take 10 seconds.
echo.
echo When ready, you'll see: "Local: http://127.0.0.1:8000"
echo.
echo Keep this window open while using the application.
echo To stop: Press Ctrl+C
echo.
echo ================================================
echo.

php artisan serve --port=8000

pause
```

**To use:**
1. Copy the text above
2. Open Notepad
3. Paste the text
4. Save as `start.bat` in the project folder
5. Double-click `start.bat` to start the system
6. Open browser to: `http://127.0.0.1:8000`

---

## 🔓 First Login

**Username:** `brgy50`  
**Password:** `brgy50`

(You can change this password after logging in via Profile)

---

## 📖 How to Use the System

### 👥 Adding a New Citizen

1. Log in with brgy50/brgy50
2. Click **"Citizens"** in the menu
3. Click **"+ Add New Citizen"** button
4. Fill in the form:

   **Required fields (marked with *):**
   - First Name
   - Last Name
   - Birthdate
   - Address
   - Barangay
   - City
   - Province

   **Optional fields:**
   - Middle Name
   - Suffix (Jr., Sr., etc.)
   - Email
   - Phone
   - Occupation
   - Education level
   - Notes

5. **Upload Pictures (optional):**
   - **Profile Picture:** Click "Choose File" - select a 1x1 photo (2MB max)
   - **National ID Photo:** Click "Choose File" - select ID photo (2MB max)

6. **Select Categories (optional):**
   - Check boxes for: PWD, Senior Citizens, LGBTQ+, Solo Parents, etc.

7. Click **"Add Citizen"** button

### 👁️ Viewing a Citizen's Information

1. Click **"Citizens"** in menu
2. Find the citizen you want (scroll or search)
3. Click on their name
4. View all their information
5. See uploaded pictures and documents

### ✏️ Editing a Citizen

1. Go to citizen's detail page (see above)
2. Click **"✎ Edit"** button
3. Change any information
4. Upload new pictures if needed
5. Change categories if needed
6. Click **"Update Record"** button

### 🔍 Finding a Citizen

1. Click **"Citizens"** in menu
2. **Search by name:**
   - Type name in search box
   - Results update immediately
3. **Filter by gender:**
   - Select from dropdown
4. **Filter by civil status:**
   - Select: Single, Married, Divorced, etc.
5. **Filter by age group:**
   - Select: Children, Youth, Adult, Senior
6. **Filter by category:**
   - Select: PWD, Senior Citizens, etc.
7. **Combine filters:**
   - Use multiple filters together
   - Click "Clear" to reset

### 📂 Managing Categories

Categories help you organize citizens. Default categories:
- **Persons with Disability (PWD)** - Citizens with disabilities
- **Senior Citizens** - Ages 60+
- **LGBTQ+ Community** - LGBTQ+ members
- **Solo Parents** - Single parents
- **Household Heads** - Head of household

**Add new category:**
1. Click **"Categories"** in menu
2. Click **"+ Add New Category"**
3. Enter name
4. Add description (optional)
5. Choose color
6. Add emoji/icon (optional)
7. Click **"Create Category"**

**Edit category:**
1. Go to Categories
2. Click **"Edit"** on a category
3. Change details
4. Click **"Update"**

**Delete category:**
1. Go to Categories
2. Click **"Delete"** on a category
3. Confirm

### 📊 Dashboard

The dashboard shows:
- Total number of citizens
- Male/Female distribution
- Count in each category
- Quick action buttons

All numbers update automatically as you add citizens.

---

## 🛑 Stopping the System

1. Open command window where `start.bat` is running
2. Press **Ctrl + C**
3. Type **"Y"** and press Enter
4. Window will close

---

## 🔧 Troubleshooting

### Problem: "Server not running"
**Solution:**
- Make sure XAMPP MySQL is started (click "Start" next to MySQL)
- Restart `start.bat` file

### Problem: "Database error"
**Solution:**
- Open XAMPP
- Click "Start" next to MySQL
- Wait 10 seconds
- Restart the application

### Problem: "Pictures don't show"
**Solution:**
- Make sure you uploaded the file correctly
- File must be under 2MB
- Accepted formats: JPG, PNG, GIF

### Problem: "Can't find citizens I added"
**Solution:**
- Make sure filters aren't hiding them
- Click "Filters & Search" section
- Click "Clear" button to reset all filters

### Problem: "Forgot password"
**Solution:**
- Use password reset option on login page
- Or ask system administrator to reset

---

## 📝 Best Practices

### ✅ DO:
- ✅ Add complete information for each citizen
- ✅ Upload profile pictures (helps identify citizens)
- ✅ Upload national ID photos (for verification)
- ✅ Use categories consistently
- ✅ Backup database regularly (see admin guide)
- ✅ Keep username/password secure

### ❌ DON'T:
- ❌ Share password with unauthorized people
- ❌ Delete citizens unless absolutely necessary (mark as inactive instead)
- ❌ Upload files larger than 2MB
- ❌ Close application during important operations
- ❌ Force close without using stop process

---

## 💾 Backing Up Your Data

Once a week:
1. Open command prompt in project folder
2. Type: `php artisan db:dump`
3. File saved as: `dump_Y-m-d_H-i-s.sql`
4. Copy this file to USB drive

---

## 📞 Getting Help

If something doesn't work:
1. Check the **Troubleshooting** section above
2. Look at error messages carefully (they help identify problems)
3. Restart the application
4. Restart your computer
5. Contact system administrator

---

## 🎓 Quick Commands

**If something goes wrong, you can reset the entire system:**

```batch
php artisan migrate:fresh --seed
```

This:
- Removes all data
- Recreates empty database
- Adds 50 sample citizens back
- You'll need to re-login with brgy50/brgy50

**Only do this if nothing else works!**

---

## 📅 Sample Data

When you first start, the system includes:
- **1 Admin account** (brgy50/brgy50)
- **50 sample citizens** (Tácloban residents)
- **5 categories** (PWD, Senior, LGBTQ+, Solo Parent, Household Head)

Feel free to add, edit, or delete these as needed!

---

## 🎉 You're Ready!

Your Barangay 50 Management System is now ready to use.

**Next steps:**
1. Double-click `start.bat` to start the system
2. Open browser: `http://127.0.0.1:8000`
3. Login with `brgy50 / brgy50`
4. Start adding or editing citizen records

**Questions?** Contact your system administrator.

---

**Version:** 1.0  
**Last Updated:** October 17, 2025  
**For:** Barangay 50 Officials, Tacloban City, Philippines

