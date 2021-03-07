FROM php:7.4-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl-dev \
        libtool \
        libxml2-dev \
        postgresql-dev \
        sqlite-dev \
    && apk add --no-cache \
        curl \
        git \
        mysql-client \
        postgresql-libs \
        libintl \
        icu \
        icu-dev \
        libzip-dev \
    && docker-php-ext-install \
        bcmath \
        curl \
        iconv \
        pdo \
        pdo_mysql \
        pcntl \
        tokenizer \
        xml \
        zip \
        intl \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

RUN composer install --no-interaction;
RUN php artisan config:cache;
