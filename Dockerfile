FROM php:8.2-fpm-alpine

RUN apk --no-cache add \
        $PHPIZE_DEPS \
        && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .
RUN composer install --verbose


CMD php artisan serve --host=0.0.0.0
