FROM php:8.0-fpm

# Copy the application code
COPY . /app

RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

# VOLUME ["/app"]