FROM composer as build

COPY database/ /app/database/
COPY composer.json composer.lock /app/

RUN cd /app \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
    && composer install \
        --ignore-platform-reqs \
        --no-interaction \
        --no-plugins \
        --no-scripts \
        --prefer-dist

FROM php:7.4-apache-buster

ARG LARAVEL_PATH=/var/www/html
WORKDIR ${LARAVEL_PATH}

COPY . ${LARAVEL_PATH}
COPY --from=build /app/vendor/ ${LARAVEL_PATH}/vendor/

RUN cd ${LARAVEL_PATH} \
    && docker-php-ext-install mysqli pdo_mysql \
    && chmod -R 777 storage \
    && php artisan package:discover

COPY default.conf /etc/apache2/sites-available/000-default.conf

# Enable apache modules
RUN a2enmod rewrite

EXPOSE 80
COPY entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint"]
