FROM php:8.1-alpine3.15 as prod

RUN apk add --update-cache bash bash-completion

RUN echo 'source /etc/profile' > /root/.bashrc \
 && echo 'eval "$(/app/redo completion bash)"' >> /root/.bashrc \
 && ln -s /app/redo /usr/local/bin/redo

COPY build/dist /app
COPY VERSION /VERSION

WORKDIR /app

#
# development layer for composer
#
FROM prod as dev-composer
ADD https://getcomposer.org/composer-2.phar /usr/local/bin/composer
RUN chmod 777 /usr/local/bin/composer
