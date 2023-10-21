# Base Image
FROM alpine:latest

# Set Working Directory
WORKDIR /var/www/html/

# Set timezone
RUN echo "UTC" > /etc/timezone

# Essentials
RUN apk add --no-cache zip unzip curl sqlite

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP 8.1
RUN apk add --no-cache php8.1 \
    php8.1-common \
    php8.1-fpm \
    php8.1-pdo \
    php8.1-opcache \
    php8.1-zip \
    php8.1-phar \
    php8.1-iconv \
    php8.1-cli \
    php8.1-curl \
    php8.1-openssl \
    php8.1-mbstring \
    php8.1-tokenizer \
    php8.1-fileinfo \
    php8.1-json \
    php8.1-xml \
    php8.1-xmlwriter \
    php8.1-simplexml \
    php8.1-dom \
    php8.1-pdo_mysql \
    php8.1-pdo_sqlite \
    php8.1-tokenizer \
    php8.1-pecl-redis

# Link PHP binary
RUN ln -s /usr/bin/php8.1 /usr/bin/php

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Set the environment variable for CLI server workers
ARG CLI_WORKERS=16
ENV PHP_CLI_SERVER_WORKERS=$CLI_WORKERS

# Set the entry point to start Laravel server
ENTRYPOINT ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
