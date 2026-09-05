FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock* ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader --no-scripts || composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader
COPY . .
RUN composer dump-autoload --no-dev --optimize

FROM php:8.3-fpm-bookworm
RUN apt-get update && apt-get install -y --no-install-recommends libicu-dev libzip-dev unzip && docker-php-ext-install pdo_mysql intl opcache && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html
COPY --from=vendor /app /var/www/html
RUN chown -R www-data:www-data storage bootstrap/cache
USER www-data
CMD ["php-fpm"]
