# 🚀 **How to Run Your Biodata Management System**

## **Method 1: Using XAMPP (Recommended)**

### **Step 1: Install XAMPP**
1. Download XAMPP from: https://www.apachefriends.org/
2. Install XAMPP (default location: `C:\xampp`)
3. Run XAMPP Control Panel as Administrator

### **Step 2: Start Services**
1. In XAMPP Control Panel, click **"Start"** for:
   - ✅ **Apache** (Web Server)
   - ✅ **MySQL** (Database)
2. Wait for both to show "Running" status

### **Step 3: Copy Project Files**
```
Copy your entire "lab 5" folder to:
C:\xampp\htdocs\

Final path should be: C:\xampp\htdocs\lab 5\
```

### **Step 4: Create Database**
1. Open your browser and go to: http://localhost/phpmyadmin
2. Click **"New"** on the left sidebar
3. Database name: `biodata_system`
4. Click **"Create"**
5. Click on the new database `biodata_system`
6. Go to **"Import"** tab
7. Choose file: `setup_database.sql` from your lab 5 folder
8. Click **"Go"**

### **Step 5: Test Your Application**
1. Open browser and go to: **http://localhost/lab%205/**
2. You should see the login page
3. Click **"Register here"** to create an account
4. After registration, login and start using the system!

---

## **Method 2: Using Built-in PHP Server (Alternative)**

### **Step 1: Install MySQL Separately**
- Download and install MySQL from: https://dev.mysql.com/downloads/mysql/
- Or use MySQL Workbench

### **Step 2: Start PHP Built-in Server**
```powershell
# Navigate to your project folder
cd "D:\Vs Code\Web-Engineering\lab 5"

# Start PHP server
php -S localhost:8000
```

### **Step 3: Access Application**
- Open browser: http://localhost:8000

---

## **Troubleshooting**

### **Issue: Database Connection Error**
**Solution:**
1. Make sure MySQL is running in XAMPP
2. Check `config.php` settings:
```php
$host = 'localhost';
$username = 'root';
$password = '';  // Usually empty for XAMPP
$database = 'biodata_system';
```

### **Issue: 404 Not Found**
**Solution:**
1. Check if files are in correct location: `C:\xampp\htdocs\lab 5\`
2. Make sure Apache is running
3. Try: http://localhost/lab%205/ (with %20 for spaces)

### **Issue: Permission Denied**
**Solution:**
1. Run XAMPP as Administrator
2. Check file permissions

---

## **Quick Start Commands**

### **Copy Files (Run in PowerShell as Admin):**
```powershell
# Create htdocs directory if it doesn't exist
New-Item -ItemType Directory -Force -Path "C:\xampp\htdocs"

# Copy your project
Copy-Item -Path "D:\Vs Code\Web-Engineering\lab 5" -Destination "C:\xampp\htdocs\" -Recurse -Force
```

### **Test if everything is working:**
```powershell
# Check if Apache is running
curl http://localhost

# Check if your project is accessible  
curl "http://localhost/lab%205/"
```

---

## **Default Test Account (After Setup)**
- **Username:** admin
- **Password:** password
- (Or create your own account via registration)

---

## **Project URLs After Setup**
- 🏠 **Home:** http://localhost/lab%205/
- 🔐 **Login:** http://localhost/lab%205/login.php
- 📝 **Register:** http://localhost/lab%205/register.php
- 📊 **Dashboard:** http://localhost/lab%205/dashboard.php (after login)
- 🗄️ **phpMyAdmin:** http://localhost/phpmyadmin

---

## **File Structure Check**
Your `C:\xampp\htdocs\lab 5\` should contain:
```
lab 5/
├── index.php
├── config.php
├── login.php
├── register.php
├── dashboard.php
├── biodata_form.php
├── view_biodata.php
├── edit_biodata.php
├── delete_biodata.php
├── logout.php
├── auth_styles.css
├── biodata_styles.css
├── setup_database.sql
└── README.md
```

**🎉 Ready to go! Your biodata management system should now be running!**
