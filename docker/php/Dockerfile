FROM php:fpm-alpine

WORKDIR /var/www

RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer