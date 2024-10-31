FROM php:8.2-apache

RUN apt-get update -qq \
    && apt-get install -qy --no-install-recommends \
        git \
        zip \
        unzip \
        libicu-dev




RUN docker-php-ext-install pdo_mysql \
    intl


# Install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

WORKDIR /var/www/app
