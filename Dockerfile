# =========================
# 1️⃣ Build dependencies
# =========================
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts
COPY . .
RUN composer dump-autoload --optimize

# =========================
# 2️⃣ Runtime (PHP + PostgreSQL)
# =========================
FROM php:8.2-fpm-alpine

# Cài thư viện PostgreSQL và extension
RUN apk add --no-cache postgresql-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Thêm tiện ích cơ bản
RUN apk add --no-cache bash curl

WORKDIR /var/www
COPY --from=vendor /app ./

# =========================
# 3️⃣ Laravel auto setup khi container khởi động
# =========================
CMD php artisan key:generate --force && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link && \
    echo '✅ Laravel khởi động thành công!' && \
    php-fpm
