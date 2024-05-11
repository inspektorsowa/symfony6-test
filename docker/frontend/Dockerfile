FROM node:20.13-alpine3.19

RUN mkdir /docker

EXPOSE 8080
ENV HOST=0.0.0.0
ENV PORT=8080

WORKDIR /var/www

ENTRYPOINT ["sh", "/docker/entrypoint.sh"]
