FROM alpine:3.12 as prod

ADD https://php.hernandev.com/key/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub

RUN apk --update-cache add ca-certificates && \
    echo "https://php.hernandev.com/v3.12/php-8.0" >> /etc/apk/repositories

RUN apk add --update-cache \
    php \
    php-json

#
# development layer for composer
#
FROM prod as dev-composer
ADD https://getcomposer.org/composer-2.phar /usr/local/bin/composer
RUN chmod 777 /usr/local/bin/composer
