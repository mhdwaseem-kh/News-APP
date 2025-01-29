FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        && rm -rf /var/lib/apt/lists/* \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

CMD ["php-fpm"]
