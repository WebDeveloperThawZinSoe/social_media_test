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
  [http://domain/api/documentation/](http://socialtest.thawzinsoe.com/api/documentation)

---

## ⚙️ Installation Guide

You can set up the project either **locally** or using **Docker**.

---

### 1️⃣ Docker Setup

Follow these steps to set up the project on your machine:

```bash
# Build the Docker image
docker build -t social_media_app .

# Start MySQL container
docker run -d \
  --name social_media_db \
  -e MYSQL_ROOT_PASSWORD=secret \
  -e MYSQL_DATABASE=laravel \
  -p 3306:3306 \
  mysql:8.0

# Start Laravel container
docker run -it --rm \
  --name social_media_app \
  -p 8080:8080 \
  -e DB_CONNECTION=mysql \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3306 \
  -e DB_DATABASE=laravel \
  -e DB_USERNAME=root \
  -e DB_PASSWORD=secret \
  social_media_app

# Run migrations and seed the database
docker exec -it social_media_app php artisan migrate --force
docker exec -it social_media_app php artisan db:seed --force
```

> This keeps your **README fully self-contained** with both **local** and **Docker setup instructions**.  
> You can also create a **docker-compose version** for a cleaner, single-command setup.

---

### 2️⃣ Local Setup

Follow these steps to set up the project **without Docker**:

```bash
# Clone the repository
git clone https://github.com/WebDeveloperThawZinSoe/social_media_test.git
cd social_media_test

# Install dependencies
composer install

# Set up environment variables
cp .env.example .env
php artisan key:generate

# Run migrations and seed the database
php artisan migrate
php artisan db:seed

# Start the Laravel development server
php artisan serve
```

> After this, the app will be accessible at `http://127.0.0.1:8000`.

---

