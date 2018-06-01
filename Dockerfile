FROM php:7.0-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite

RUN apt update && apt install -y git

# TODO: Not this.
RUN touch /var/www/msihdp.log
RUN chmod 777 /var/www/msihdp.log

#ADD config/php.ini /usr/local/etc/php/
ADD ./src /var/www/html/
