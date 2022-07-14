FROM php:8.1-fpm

# Install nginx
RUN apt-get update && apt-get install --yes --no-install-recommends \
    gettext \
    nginx \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && service nginx stop \
    && rm \
    /etc/nginx/nginx.conf \
    /etc/nginx/sites-available/* \
    /etc/nginx/sites-enabled/*

# Install php-fpm
RUN rm \
      /usr/local/etc/php-fpm.d/* \
      /usr/local/etc/php/conf.d/* \
&& apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev\
        librabbitmq-dev libssh-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install soap \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-install sockets \
    && pecl install amqp && docker-php-ext-enable amqp \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Config nginx
COPY ./etc/nginx.conf /etc/nginx/nginx.conf

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# FPM-FPM configuration
COPY ./etc/php-fpm.conf /usr/local/etc/php-fpm.d/php-fpm.conf
ENV COMPOSER_ALLOW_SUPERUSER="1"
ENV FPM_WORKERS_COUNT="2"
ENV FPM_ACCESS_LOG="/proc/self/fd/2"
ENV FPM_ERROR_LOG="/proc/self/fd/2"
ENV FPM_LOG_LEVEL="error"

# PHP-INI configuration
COPY ./etc/php.ini /usr/local/etc/php/conf.d/php.ini
ENV PHP_OPCACHE_ENABLE="true"
ENV PHP_ERROR_LOG="/proc/self/fd/2"
ENV PHP_LOG_LEVEL="E_ERROR"

HEALTHCHECK NONE
WORKDIR /app

COPY ./app /app

RUN composer install --no-dev \
&& composer clear-cache \
&& chown www-data:www-data -R var

EXPOSE 8080
CMD ["bash", "-c", "php-fpm --daemonize && nginx"]
