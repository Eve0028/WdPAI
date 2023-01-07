FROM php:8.0-fpm

# Copy the application code
COPY . /app

RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# VOLUME ["/app"]