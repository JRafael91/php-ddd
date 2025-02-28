FROM php:8.4-fpm-alpine

RUN apk update && apk add bash

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN rm -rf /var/cache/apk/*

COPY ./Docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 9000

CMD ["php-fpm"]



