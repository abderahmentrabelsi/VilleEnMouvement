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
RUN apk add --no-cache php82 \
    php82-common \
    php82-fpm \
    php82-pdo \
    php82-opcache \
    php82-zip \
    php82-phar \
    php82-iconv \
    php82-cli \
    php82-curl \
    php82-openssl \
    php82-mbstring \
    php82-tokenizer \
    php82-fileinfo \
    php82-json \
    php82-xml \
    php82-xmlwriter \
    php82-simplexml \
    php82-dom \
    php82-pdo_mysql \
    php82-pdo_sqlite \
    php82-tokenizer \
    php82-pecl-redis \
    php82-bcmath \
    php82-gd \
    php82-xmlreader

RUN ln -s /usr/bin/php82 /usr/bin/php


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN apk update
RUN apk upgrade
RUN apk add bash
RUN alias composer='php /usr/bin/composer'


RUN chown -R nobody:nobody /var/www/html/storage

COPY . .
RUN composer install

RUN composer dump-autoload --optimize

# Set the environment variable for CLI server workers
ARG CLI_WORKERS=16
ENV PHP_CLI_SERVER_WORKERS=$CLI_WORKERS

# Set the entry point to start Laravel server
ENTRYPOINT ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
