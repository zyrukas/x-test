FROM php:7.4.16-fpm
RUN apt-get update
RUN yes | apt-get upgrade

RUN apt-get install -y zlib1g-dev libxml2-dev libzip-dev librabbitmq-dev git zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pcntl zip mysqli pdo_mysql

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

RUN pecl install -o -f amqp \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable amqp

RUN apt-get update && apt-get install -y supervisor
RUN mkdir -p /var/log/supervisor
COPY docker/supervisor/conf.d/message-worker.conf /etc/supervisor/conf.d/message-worker.conf

COPY . /var/www/html
RUN mkdir -p /var/www/html/var
RUN chown www-data -R /var/www/html

USER www-data

WORKDIR /var/www/html
