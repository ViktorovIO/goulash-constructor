FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev libsodium-dev librabbitmq-dev \
    && docker-php-ext-install intl opcache sodium \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && curl -L -o /usr/local/bin/pickle https://github.com/FriendsOfPHP/pickle/releases/download/v0.6.0/pickle.phar \
    && chmod +x /usr/local/bin/pickle \
    && pecl install amqp \
    && docker-php-ext-enable amqp

WORKDIR /var/www/goulash-test

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN git config --global user.name "ViktorovIO" \
    && git config --global user.email "viktorovio@yahoo.com" \