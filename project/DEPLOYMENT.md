# Live Deployment Guide

## Deployment Status

### ✅ Completed:
1. **React Frontend** - Built and uploaded to `/public_html/build/`
2. **Laravel Backend Files** - Uploaded to `/public_html/`
   - App directory (Controllers, Models, etc.)
   - Config files
   - Routes
   - Database migrations
   - Resources
   - Public assets
3. **Configuration**
   - `.env` with live database credentials
   - `composer.json` uploaded

### ⚠️ Required Manual Steps (via SSH/Shell Access):

#### 1. Install PHP Dependencies
```bash
cd /home/u962734684/public_html
php composer.phar install --no-dev --optimize-autoloader
```

#### 2. Verify Database Connection
Visit: https://greenwebproject.com/db-setup.php

This will:
- Test database connectivity
- Show existing tables
- Display database size

#### 3. Run Migrations
```bash
php artisan migrate --force
```

#### 4. Clear Caches
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 5. Set File Permissions
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache
chmod 777 public
```

### 🔧 Configuration Details

**Database Connection:**
- Host: 127.0.0.1
- Database: u962734684_uk
- Username: u962734684_uk
- Password: Rv/p4RDCd=j0

**File Paths:**
- App Root: `/home/u962734684/public_html`
- Frontend Assets: `/home/u962734684/public_html/public/build/`
- Laravel Entry: `/home/u962734684/public_html/public/index.php`

### 📋 Uploaded Files Summary

```
✓ /public_html/index.php
✓ /public_html/.env
✓ /public_html/artisan
✓ /public_html/composer.json
✓ /public_html/db-setup.php
✓ /public_html/setup-live.sh
✓ /public_html/app/**/*.php
✓ /public_html/bootstrap/**/*.php
✓ /public_html/config/**/*.php
✓ /public_html/database/**/*.php
✓ /public_html/routes/**/*.php
✓ /public_html/resources/**/*
✓ /public_html/build/** (React frontend)
```

### 🚀 Testing the Deployment

1. **Frontend**: https://greenwebproject.com/react or https://greenwebproject.com/
2. **Database Setup**: https://greenwebproject.com/db-setup.php
3. **Admin Panel**: https://greenwebproject.com/admin (after migrations)

### 📝 Notes

- The `vendor/` directory (92MB) should be installed via Composer on the live server
- Ensure PHP >= 8.0 is installed on the server
- MySQL/MariaDB is required for database
- Enable mod_rewrite for Laravel routing to work
