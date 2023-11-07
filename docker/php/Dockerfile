FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zlib1g-dev libicu-dev g++

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www