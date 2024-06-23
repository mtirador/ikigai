# Usa una imagen base de PHP 7.2 con Apache
FROM php:7.2-apache

# Instala extensiones necesarias para Yii2
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd pdo pdo_mysql

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia los archivos de la aplicación al contenedor
COPY . /var/www/html/

# Establece permisos adecuados
RUN chown -R www-data:www-data /var/www/html/

# Exponer el puerto 80
EXPOSE 80
