# 🔐 Barangay 50 Management System - Quick Start Guide

## ✅ System Status: Ready to Use

Your Barangay 50 Citizen Management and Demographics System is now fully configured and ready for operation!

---

## 🚀 Getting Started

### Step 1: Start the Server

Open PowerShell and run:

```powershell
cd c:\Users\Nikko\Desktop\nikko\brgy50-management-system
php artisan serve
```

You should see:
```
Starting Laravel development server: http://127.0.0.1:8000
```

### Step 2: Open Your Browser

Navigate to: **http://localhost:8000**

You will see the Barangay 50 welcome page.

### Step 3: Login with Pre-Created Account

Click **"Login as Barangay Official"**

**Login Credentials:**
- **Username:** `brgy50`
- **Password:** `brgy50`

**Note:** No email required - username/password login only!

---

## 📋 System Features

### Dashboard
- View total registered citizens
- See gender distribution (Male/Female)
- Check special categories count:
  - Persons with Disability (PWD)
  - Senior Citizens (60+)
  - LGBTQ+ Community
  - Solo Parents
- Quick action buttons to manage citizens

### Citizen Management
1. **View All Citizens** - See list of registered citizens
2. **Add New Citizen** - Create new citizen record with:
   - Personal info (name, birthdate, gender, etc.)
   - Contact information (email, phone, address)
   - Demographics (civil status, occupation, education)
   - Special categories (PWD, Senior, LGBTQ+, Solo Parent)
   - Household assignment (optional)

3. **Search & Filter** - Find citizens by:
   - Name, email, or phone number
   - Gender
   - Civil Status
   - Age Group (Children, Youth, Adult, Senior)
   - Special categories (checkboxes)

4. **View Citizen Details** - See complete information with:
   - Personal and contact details
   - Special category badges
   - Household information (if applicable)
   - Notes and metadata
   - Created/Updated information

5. **Edit Citizen** - Modify any citizen record
6. **Delete Citizen** - Mark citizen as inactive

---

## 💻 User Interface

### Navigation Menu
- **Dashboard** - Home page with statistics
- **Citizens** - Manage all citizen records
- **Logout** - Exit the system

### Responsive Design
- ✅ Works on desktop, tablet, and mobile
- ✅ Touch-friendly mobile interface
- ✅ Dark mode support (automatic)

---

## 📊 Data Entry Example

### Adding a New Citizen:

1. Click **"+ Add New Citizen"** button
2. Fill in the form:
   - **Name:** Juan Dela Cruz
   - **Birthdate:** 01/15/1985
   - **Gender:** Male
   - **Civil Status:** Married
   - **Address:** Purok 1, Barangay 50, Tacloban City, Leyte 6500
   - **Phone:** 09123456789
   - **Occupation:** Farmer
   - **Education:** High School Graduate
3. Check special categories if applicable (PWD, Senior, etc.)
4. Click **"Add Citizen"**
5. Success! Record is saved and you're redirected to the list

---

## 🔒 Security

- ✅ Password-protected login
- ✅ Session management (auto-logout after inactivity)
- ✅ CSRF protection on all forms
- ✅ No registration (controlled access)
- ✅ Data validation on all inputs

---

## 🛠️ System Information

- **Server:** Local XAMPP
- **Database:** MySQL (brgy50_management)
- **Framework:** Laravel 11
- **Frontend:** Blade + Tailwind CSS
- **User Role:** Barangay Official (only one type)

---

## 📱 Keyboard Shortcuts

While in the system:
- **Tab** - Navigate between form fields
- **Enter** - Submit forms
- **Escape** - Cancel dialogs

---

## ⚙️ Important Notes

1. **Database**: All data is stored locally in XAMPP MySQL
2. **Backup**: Regularly backup the `brgy50_management` database
3. **Multiple Citizens**: You can add unlimited citizen records
4. **Filtering**: All filters work together for advanced searches
5. **Dark Mode**: Automatically switches based on system preference

---

## 🆘 Troubleshooting

### Problem: Can't start the server
```
Solution: Make sure XAMPP MySQL is running:
- Open XAMPP Control Panel
- Start Apache and MySQL services
- Wait for green indicators
```

### Problem: Login fails
```
Solution: Check your credentials:
- Username: brgy50 (lowercase)
- Password: brgy50 (case-sensitive)
- Clear browser cache and try again
```

### Problem: 404 error on page
```
Solution: Verify the URL is correct:
- http://localhost:8000 (main page)
- http://localhost:8000/login (login)
- http://localhost:8000/dashboard (dashboard)
- http://localhost:8000/citizens (citizens list)
```

---

## 📞 Support Information

- **System Name:** Barangay 50 Citizen Management and Demographics System
- **Location:** Barangay 50, Tacloban City, Leyte, Philippines
- **Database Name:** brgy50_management
- **Default Account:** brgy50 / brgy50

---

## 📝 Quick Reference

| Action | Steps |
|--------|-------|
| Login | Go to http://localhost:8000 → Click Login → Enter brgy50/brgy50 |
| Add Citizen | Dashboard → Citizens → "+ Add New Citizen" → Fill form → Submit |
| Search Citizen | Citizens → Enter name/email/phone in search box → Click "Apply Filters" |
| View Citizen | Citizens list → Click "View" button |
| Edit Citizen | Citizens list → Click "Edit" button → Modify data → "Update Record" |
| Delete Citizen | Citizens list → Click "Delete" → Confirm |
| Logout | Click profile menu → "Logout" |

---

## 🎯 Next Steps

Once you're comfortable with the system:

1. **Add Sample Data** - Start entering citizen records
2. **Test Filters** - Try different search and filter combinations
3. **Explore Dashboard** - Monitor statistics as you add more citizens
4. **Master CRUD** - Get efficient with Create, Read, Update, Delete operations

---

## 📚 Available Citizen Fields

- ✅ First Name (Required)
- ✅ Middle Name (Optional)
- ✅ Last Name (Required)
- ✅ Suffix (Jr., Sr., III, etc.)
- ✅ Email (Optional)
- ✅ Phone Number (Optional)
- ✅ Full Address (Required)
- ✅ Barangay (Pre-filled: Barangay 50)
- ✅ City (Pre-filled: Tacloban City)
- ✅ Province (Pre-filled: Leyte)
- ✅ Postal Code (Optional)
- ✅ Birthdate (Required - Auto-calculates age & senior status)
- ✅ Gender (Optional)
- ✅ Civil Status (Optional)
- ✅ Is PWD (checkbox)
- ✅ Is Senior Citizen (auto-checked if 60+ years old)
- ✅ Is LGBTQ+ (checkbox)
- ✅ Is Solo Parent (checkbox)
- ✅ Occupation (Optional)
- ✅ Educational Attainment (Optional)
- ✅ Household Assignment (Optional)
- ✅ Notes (Optional)

---

**System Ready! 🎉**

**Created:** October 16, 2025  
**Version:** 1.0 (Beta)  
**Last Updated:** October 16, 2025

Enjoy using the Barangay 50 Management System!
