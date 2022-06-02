FROM php:8.1-alpine3.15 as prod

#
# development layer for composer
#
FROM prod as dev-composer
ADD https://getcomposer.org/composer-2.phar /usr/local/bin/composer
RUN chmod 777 /usr/local/bin/composer
