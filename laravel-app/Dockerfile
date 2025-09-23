# Use official PHP with Apache
FROM php:8.2-apache

# Maintainer info
LABEL maintainer="ThawZinSoe"

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    default-mysql-server \
    default-mysql-client \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app into container
COPY ./laravel-app /var/www/html

# Configure Apache to use Laravel public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf \
    && echo "<Directory /var/www/html/public>\n\tAllowOverride All\n</Directory>" >> /etc/apache2/apache2.conf

# Fix permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure MySQL (simple local dev database)
RUN service mysql start && \
    mysql -e "CREATE DATABASE IF NOT EXISTS social_media_test;" && \
    mysql -e "CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'password';" && \
    mysql -e "GRANT ALL PRIVILEGES ON social_media_test.* TO 'laravel'@'localhost';" && \
    mysql -e "FLUSH PRIVILEGES;"

# Import the bundled SQL file into MySQL
COPY ./laravel-app/social_media_test.sql /docker-entrypoint-initdb.d/social_media_test.sql
RUN service mysql start && \
    mysql -u root social_media_test < /docker-entrypoint-initdb.d/social_media_test.sql

# Install PHP dependencies with Composer
RUN composer install --no-dev --optimize-autoloader

# Expose Apache port
EXPOSE 80

# Start Apache + MySQL together
CMD service mysql start && apache2-foreground
