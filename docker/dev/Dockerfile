FROM php:8.4-fpm as server

USER root
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_mysql

RUN php -m | grep mbstring
WORKDIR /app

COPY ../.. .
RUN composer install
RUN php artisan key:generate

FROM oven/bun:latest as vite

WORKDIR /app

COPY ../../docker/dev/vite-entry.sh ./entry.sh
COPY ../../package.json ./
COPY ../../bun.lock ./
COPY ../../resources ./
COPY ../../public ./
COPY ../../vite.config.js ./

EXPOSE 5173/tcp
EXPOSE 80/tcp

RUN bun install

ENTRYPOINT ["bunx", "vite", ".", "--host"]

