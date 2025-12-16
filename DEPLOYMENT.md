# VoxCraft Production Deployment Guide

## 🚀 Quick Deployment Steps

### Step 1: Push Code to GitHub
```bash
git add .
git commit -m "VoxCraft updates: VoxChat, Podcasts, Audio Ads, Pricing, About page"
git push origin main
```

### Step 2: After Hostinger Auto-Deploy

Connect to your server via SSH or use Hostinger's terminal, then run:

```bash
# Navigate to your project folder
cd /path/to/your/project

# Run the production seeder
php artisan db:seed --class=VoxcraftProductionSeeder

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📋 What the Seeder Does

### 1. Package Prices
- **Starter Plan (ID 12):** $12.99/month
- **Premium Plan (ID 13):** $34.99/month
- **Platinum Plan (ID 10):** $79.99/month

### 2. New Features Added to Packages

| Feature | Starter | Premium | Platinum |
|---------|---------|---------|----------|
| Podcast | 5 | 20 | 100 |
| Audio Ads | 10 | 50 | 200 |
| VoxChat | 50 | 200 | 1000 |

### 3. Feature Preferences
- Added: Podcast, Audio Ads, VoxChat

### 4. Menu Updates
- Changed "News/الأخبار" → "من نحن" (About Us)

### 5. Pages Activated
- About Us (من نحن)
- Contact Us (اتصل بنا)

---

## ⚠️ Important Notes

1. **Run seeder ONLY ONCE** on production
2. **Backup your database** before running the seeder
3. The seeder is **idempotent** - it won't duplicate data if run multiple times

---

## 🔧 Troubleshooting

### If seeder fails:
```bash
# Check if the seeder class is autoloaded
composer dump-autoload

# Try again
php artisan db:seed --class=VoxcraftProductionSeeder
```

### If you need to rollback:
The seeder only updates existing data, so you would need to manually restore from a backup.

---

## 📁 Files Changed in This Update

### Code Files (Auto-deployed via Git):
- `app/Services/SubscriptionService.php` - Fixed default package assignment
- `Modules/OpenAI/Services/ContentService.php` - Removed Presentation feature
- `Modules/modules.json` - Disabled Presentation module
- `resources/views/site/pages/about-us.blade.php` - New About page design
- `app/Http/Controllers/Site/SiteController.php` - Custom view for about-us
- `public/assets/css/common/tailwind-custom.css` - RTL fixes
- `resources/lang/ar.json` - Arabic translations

### Database Changes (Need Seeder):
- `packages` table - Price updates
- `packages_meta` table - New feature limits
- `feature_preferences` table - New features
- `menu_items` table - Navigation update
- `pages` table - Page activation

---

## ✅ Verification Checklist

After deployment, verify:

- [ ] Pricing page shows correct prices ($12.99, $34.99, $79.99)
- [ ] Package features show Podcast, Audio Ads, VoxChat limits
- [ ] Navigation shows "من نحن" instead of "الأخبار"
- [ ] About Us page loads with new design
- [ ] Contact Us page is accessible
- [ ] VoxChat, Podcast, Audio Ads features work correctly
