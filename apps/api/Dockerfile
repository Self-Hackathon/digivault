# apps/api/Dockerfile
FROM php:8.3-fpm

# System deps
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql intl zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Speed up: cache composer
COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-interaction --prefer-dist || true

# Copy source
COPY . .

# Laravel storage permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose php-fpm
EXPOSE 9000

# Default command
CMD ["php-fpm"]
