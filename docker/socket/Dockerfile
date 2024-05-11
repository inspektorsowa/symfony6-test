FROM node:20.13-alpine3.19

RUN mkdir /docker

EXPOSE 3000
ENV HOST=0.0.0.0
ENV PORT=3000

WORKDIR /var/www

ENTRYPOINT ["sh", "/docker/entrypoint.sh"]
