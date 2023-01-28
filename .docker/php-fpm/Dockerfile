# syntax=docker/dockerfile:1.4
ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm-alpine as basic

# Add extension installer
COPY --from=mlocati/php-extension-installer --link /usr/bin/install-php-extensions /usr/local/bin/
# Add composer installer
COPY --from=composer:2 --link /usr/bin/composer /usr/local/bin/


FROM basic as dev
# Add bash to be able to connect in tty
RUN apk add --no-cache bash

# Install and configure xdebug
RUN install-php-extensions xdebug

ARG PHP_XDEBUG_CLIENT_PORT
ARG PHP_XDEBUG_IDE_KEY

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=${PHP_XDEBUG_CLIENT_PORT}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=${PHP_XDEBUG_IDE_KEY}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Assign directories for host user
ARG USER_NAME
ARG USER_GID
ARG USER_ID

RUN addgroup -g ${USER_GID} ${USER_NAME} && \
    adduser -DH -G ${USER_NAME} -u ${USER_ID} ${USER_NAME}

USER $USER_NAME

FROM basic as prod

COPY --link . /var/www/html/
WORKDIR /var/www/html

RUN composer install

RUN chown -R www-data:www-data ./