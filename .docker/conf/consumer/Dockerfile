FROM php:7.3-fpm
LABEL maintainer="galihabdullah471@gmail.com"

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql

CMD sh -c 'php /var/www/html/worker.php'