FROM php:7.1-apache

RUN docker-php-ext-install pdo pdo_mysql

copy ./apache2.conf /etc/apache2/apache2.conf
copy ./000-default.conf /etc/apache2/sites-enabled/000-default.conf
copy ./php.ini /usr/local/etc/php/
RUN a2enmod rewrite
RUN service apache2 restart
# RUN chown -R www-data:www-data /var/www
# RUN chmod 777 -R /var/www
# RUN mkdir /var/www/test
# RUN rm -fr /var/www/html
# RUN mkdir /var/www/html
# RUN usermod -u 1000 www-data
