FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# ✅ Copy everything including vendor folder
COPY . .

# ✅ Clear bootstrap cache
RUN rm -f bootstrap/cache/services.php
RUN rm -f bootstrap/cache/packages.php

RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# ✅ Set Apache document root to Laravel public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80
