FROM php:8.1-apache
RUN docker-php-ext-install mysqli
COPY php-conf.d/*.ini /usr/local/etc/php/conf.d/
COPY httpd.conf /usr/local/apache2/conf/httpd.conf
COPY . /srv/httpd/autoparts
RUN chown -R www-data:www-data /srv/httpd/autoparts
EXPOSE 80
CMD ["apache2-foreground"]