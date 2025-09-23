# Social Media App Project Documentation

**Developer:** Thaw Zin Soe  
**Development Time:** 23 September 2025, 12 PM – 10 PM  
**Technology Stack:** Laravel, MySQL, Bootstrap  

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

### 📡 API
- API documentation is available at:  
  [http://domain/api/documentation#/](http://domain/api/documentation#/)

---

## ⚙️ Installation Guide

Follow these steps to set up the project on your local machine:

1. **Clone the repository**
```bash
git clone https://github.com/WebDeveloperThawZinSoe/social_media_test.git
cd laravel-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve