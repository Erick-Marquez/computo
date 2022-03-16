FROM php:7.3-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# da permisos para editar los archivos en esta ruta del container
RUN chown -R www-data:www-data /var/www

RUN chmod 755 /var/www

RUN apk --update add openssl wget nano unzip && rm -rf /var/cache/apk/*

RUN install-php-extensions pdo pdo_mysql gd xdebug imagick zip @composer-2.0.2

# para que de rapido
WORKDIR /var/www/html

COPY . .

RUN COMPOSER_VENDOR_DIR="/var/www/vendor" composer install


