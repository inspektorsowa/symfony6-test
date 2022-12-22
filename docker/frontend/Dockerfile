FROM node:16-bullseye

RUN mkdir /docker

EXPOSE 8080
ENV HOST=0.0.0.0
ENV PORT=8080

WORKDIR /var/www

CMD ["/docker/entrypoint.sh"]
