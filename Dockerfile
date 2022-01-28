FROM php:8.1-alpine3.15 as prod

# As of Alpine Linux 3.3 there exists a new --no-cache option for apk.
# It allows users to install packages with an index that is updated and used on-the-fly and not cached locally.
# This avoids the need to use --update-cache and remove /var/cache/apk/* when done installing packages.
RUN apk add --no-cache \
    bash \
    bash-completion \
    docker \
    docker-compose

COPY main /redo
COPY VERSION /VERSION
COPY docker/bin /usr/local/bin

RUN find /usr/local/bin -type f -name '*.sh' | while read f; do mv "$f" "${f%.sh}"; done \
 && chmod +x /usr/local/bin/* \
 && echo 'source /etc/profile' > /root/.bashrc \
 && echo 'eval "$(/redo/redo completion bash)"' >> /root/.bashrc \
 && echo "alias redo='/redo/redo'" >> /root/.bashrc \
 && ln -s /redo/redo /usr/local/bin/redo

ENV REDO_DOCKERCEPTION_PULL_POLICY IfNotPresent
ENV REDO_VERBOSE_LEVEL 0

WORKDIR /app

#
# development layer for composer
#
FROM prod as dev-composer
ADD https://getcomposer.org/composer-2.phar /usr/local/bin/composer
RUN chmod 777 /usr/local/bin/composer
