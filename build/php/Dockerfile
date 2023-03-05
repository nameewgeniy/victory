FROM wodby/php:8.1 as php
COPY . .
RUN composer install

COPY ./build/php/docker-entrypoint.sh /docker-entrypoint-init.d/docker-entrypoint-app.sh

