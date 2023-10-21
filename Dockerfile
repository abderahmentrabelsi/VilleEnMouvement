# Use official PHP 8.1 image
FROM php:8.1-cli-alpine

# Install dependencies
RUN apk add --no-cache \
    oniguruma-dev \
    composer

# Install PHP extensions
RUN docker-php-ext-install mbstring pdo_mysql

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
