FROM node:16-bullseye

RUN mkdir /docker

EXPOSE 3000
ENV HOST=0.0.0.0
ENV PORT=3000

WORKDIR /var/www

CMD ["/docker/entrypoint.sh"]
