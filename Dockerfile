FROM php:8.2-fpm

# Copiamos los archivos package.json composer.json y composer-lock.json a /var/www/
COPY ./src/composer.json /var/www/html/

# Nos movemos a /var/www/html/
WORKDIR /var/www/html/

# Instalamos las dependencias necesarias
# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl git \
            libmemcached-dev \
            libzip4 \
            libzip-dev \
            zip \
            unzip \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP pdo_mysql extention
    docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Instalamos dependendencias de composer
RUN composer install --no-ansi --no-dev --no-interaction --no-progress --optimize-autoloader --no-scripts

# Copiamos todos los archivos de la carpeta actual de nuestra 
# computadora (los archivos de laravel) a /var/www/html/
COPY ./src/ /var/www/html/

RUN chmod -R 777 /var/www/html/storage/
RUN chmod -R 777 /var/www/html/bootstrap/cache/

# Exponemos el puerto 9000 a la network
EXPOSE 9000

# Corremos el comando php-fpm para ejecutar PHP
CMD ["php-fpm"]