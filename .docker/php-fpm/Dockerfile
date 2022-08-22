FROM php:8.1-fpm-alpine

# Install system packages
RUN apk upgrade --update --no-cache && \
    apk add --no-cache \
        zstd-dev

# Install PHP core extensions
RUN docker-php-ext-install \
        pdo_mysql \
        sockets

# Install PHP PECL extensions
RUN apk add --no-cache --virtual buildDeps ${PHPIZE_DEPS} && \
    pecl install igbinary && docker-php-ext-enable igbinary && \
    yes | pecl install -o -f redis && docker-php-ext-enable redis && \
    apk del buildDeps &&  rm -rf /tmp/pear

# Install Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /app
