# ------------------------------
# ✅ PHP-FPM cho Laravel (Tối ưu cho Railway)
# ------------------------------
FROM php:8.2-fpm

# Cài các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev curl libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Sao chép mã nguồn
WORKDIR /var/www/html
COPY . .

# Cài composer (bản mới nhất)
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Cài dependencies PHP
RUN composer install --no-dev --optimize-autoloader

# Phân quyền cho storage
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Mở port cho Railway
EXPOSE 8000

# Dùng start.sh làm entrypoint
CMD ["sh", "start.sh"]
