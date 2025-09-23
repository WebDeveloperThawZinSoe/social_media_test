# Social Media App Project Documentation

**Developer:** Thaw Zin Soe  
**Development && Deploy Time:** 23 September 2025, 12 PM – 10 PM  
**Technology Stack:** Laravel, MySQL, Bootstrap  
**DemoLink** http://socialtest.thawzinsoe.com/
**DemoUser** [ username : demo , password : demo123 ] 

---

## 📌 Project Description
This project was developed as part of an interview task assignment.  
It is a simple **Social Media Application** built with **Laravel** backend, **MySQL** database, and **Bootstrap** frontend styling.

---

## 🚀 Features

### 🔐 Authentication
- User **Register**
- User **Login**
- User **Logout**

### 📝 Post Management
- User can **create posts**
- User can **delete their own posts**

### 👍 Reaction System
- Users can **react to all posts** (toggle like/unlike)

### 💬 Comment System
- Users can **comment on posts**
- Users can **delete comments** related to their posts

### 👤 Profile Management
- **My Profile View** (personal profile page)
- **Other People’s Profile View**

### 📰 Newsfeed
- **High-performance and fully optimized feed**

### 📡 API
- API documentation is available at:  
  [http://domain/api/documentation/](http://socialtest.thawzinsoe.com/api/documentation)

- POSTMAN Team Invation LINK
  https://apexmmtech.postman.co/workspace/d66429f4-6f71-46c2-814f-c9dd4df5f724
---

## ⚙️ Installation Guide

Follow these steps to set up the project on your local machine:

1. **Clone the repository**
```bash
git clone https://github.com/WebDeveloperThawZinSoe/social_media_test.git
cd social_media_test
cd laravel-app
composer install
npm install && npm run build
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
sudo chown -R www-data:www-data storage bootstrap/cache
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserSeeder
php artisan serve
