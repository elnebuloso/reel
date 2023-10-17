# https://github.com/docker-library/docs/blob/master/php/README.md#supported-tags-and-respective-dockerfile-links
FROM php:8.2.11-alpine3.18 as prod

# As of Alpine Linux 3.3 there exists a new --no-cache option for apk.
# It allows users to install packages with an index that is updated and used on-the-fly and not cached locally.
# This avoids the need to use --update-cache and remove /var/cache/apk/* when done installing packages.
RUN apk add --no-cache \
    git \
    curl \
    ca-certificates \
    bash \
    bash-completion \
    docker \
    docker-compose

COPY main /reel
COPY VERSION /VERSION
COPY docker/bin /usr/local/bin

RUN find /usr/local/bin -type f -name '*.sh' | while read f; do mv "$f" "${f%.sh}"; done \
 && chmod +x /usr/local/bin/* \
 && echo 'source /etc/profile' > /root/.bashrc \
 && echo 'eval "$(/reel/reel completion bash)"' >> /root/.bashrc \
 && echo "alias reel='/reel/reel'" >> /root/.bashrc \
 && ln -s /reel/reel /usr/local/bin/reel

ENV REEL_VERBOSE_LEVEL 0
ENV REEL_DOCKERCEPTION_PULL_POLICY IfNotPresent

WORKDIR /app

#
# development layer for composer
#
FROM prod as dev-composer
ADD https://getcomposer.org/composer-2.phar /usr/local/bin/composer
RUN chmod 777 /usr/local/bin/composer

#
# development layer for phpunit
#
FROM prod as dev-phpunit

RUN apk add --no-cache pcre-dev ${PHPIZE_DEPS} \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && apk del pcre-dev ${PHPIZE_DEPS}

ENV XDEBUG_MODE coverage
ADD https://phar.phpunit.de/phpunit-9.phar /usr/local/bin/phpunit
RUN chmod 777 /usr/local/bin/phpunit
