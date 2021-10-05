FROM php:8.0-fpm-alpine

COPY /.docker/config/php/php.ini /usr/local/etc/php/conf.d/php.ini

# Work Directory
WORKDIR /home/code

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.1.8

ADD . /home/code
RUN chown -R www-data:www-data /home/code
