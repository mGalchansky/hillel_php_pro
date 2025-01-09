FROM php:8.3-apache

RUN apt-get update && apt-get upgrade -y && apt-get install -y git && apt-get install zip unzip

RUN apt-get install -y \
    libzip-dev \
    zip \
 && docker-php-ext-install zip


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN /usr/sbin/a2enmod rewrite

COPY default.conf /etc/apache2/sites-available/000-default.conf


