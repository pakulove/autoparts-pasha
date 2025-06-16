FROM php:8.1-apache

RUN docker-php-ext-install mysqli

COPY php-conf.d/*.ini /usr/local/etc/php/conf.d/

COPY httpd.conf /usr/local/apache2/conf/httpd.conf

COPY . /srv/httpd

RUN chown -R www-data:www-data /srv/httpd

EXPOSE 80

CMD ["apache2-foreground"]
