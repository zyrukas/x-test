FROM nginx:latest
RUN apt-get update
RUN yes | apt-get upgrade

WORKDIR /var/www/html

COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/sites/default.conf /etc/nginx/sites-available/default.conf
COPY ./public /var/www/html/public
