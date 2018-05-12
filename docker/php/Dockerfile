FROM php:7.2-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev libgmp-dev git zip iproute2 \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        gmp \
        mbstring \
        opcache \
        pdo pdo_pgsql \
        bcmath

RUN yes | pecl install apcu xdebug \
        && echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini \
        && echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/apcu.ini \
        && echo ";zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_host=$(ip route|awk '/default/ { print $3 }')" >> /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /app

RUN curl --silent --show-error https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer && \
    composer global require hirak/prestissimo && \
    composer clear-cache

RUN curl -LsS https://codeception.com/codecept.phar -o /usr/local/bin/codecept \
    && chmod a+x /usr/local/bin/codecept

COPY docker/php/config/www.conf /usr/local/etc/php-fpm.d/www.conf
CMD ["php-fpm", "--allow-to-run-as-root"]

ARG COMPOSER_AUTH
ADD composer.json composer.lock symfony.lock ./
RUN composer install --no-scripts --no-autoloader --no-suggest && \
    composer clear-cache
COPY . /app/
RUN composer dump --optimize
RUN bin/console -e=prod cache:warmup
