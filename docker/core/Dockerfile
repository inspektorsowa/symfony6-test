FROM composer:2.7

WORKDIR /var/www

# Install system tools
RUN apk add --no-cache \
    bash \
    ca-certificates \
    curl \
    wget \
    postgresql-client \
    sudo \
    yaml \
    $PHPIZE_DEPS

# xdebug
RUN apk add --update linux-headers
RUN pecl install xdebug-3.3.2 && docker-php-ext-enable xdebug

# other php tools
RUN pecl install apcu && docker-php-ext-enable apcu
RUN pecl install redis && docker-php-ext-enable redis
RUN set -ex && apk --no-cache add postgresql-dev && docker-php-ext-install pdo pdo_pgsql
# RUN docker-php-ext-install -j$(nproc) intl
# RUN docker-php-ext-install -j$(nproc) pdo_pgsql
# RUN docker-php-ext-install -j$(nproc) pgsql
# RUN pecl install yaml && docker-php-ext-enable yaml
# RUN docker-php-ext-install -j$(nproc) zip

# RabbitMQ
RUN docker-php-ext-install sockets && \
    apk add --no-cache --update rabbitmq-c-dev && \
    apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS && \
    pecl install -o -f amqp && \
    docker-php-ext-enable amqp && \
    apk del .phpize-deps

# Add Symfony alpine repository
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | sudo -E bash

# Install symfony-cli
RUN sudo apk add symfony-cli

EXPOSE 8000

ENTRYPOINT ["sh", "/docker/entrypoint.sh"]
