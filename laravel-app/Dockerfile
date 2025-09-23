FROM bitnami/laravel:latest

WORKDIR /app

COPY . /app

RUN chown -R 1001:1001 /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

RUN composer install --no-interaction --optimize-autoloader

RUN php artisan key:generate --ansi

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
