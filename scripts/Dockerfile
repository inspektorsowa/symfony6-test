FROM php:8.1-fpm-alpine

RUN apk add --no-cache bash sudo && \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | sudo -E bash && \
    sudo apk add symfony-cli

RUN symfony new core --dir=. --version=5.4 --no-git --php=8.1 --docker

RUN symfony server:ca:install

EXPOSE 8000

CMD symfony server:start
