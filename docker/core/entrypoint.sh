#!/bin/bash

if [[ ! -f "./composer.json" ]]; then
  symfony new app --version=6.1 --no-git --php=8.1 --docker
  mv app/* ./
  rm app -Rf
  touch .env
fi

composer install

bin/console cache:clear
bin/console doctrine:schema:update --force

symfony server:ca:install
symfony server:stop
symfony server:start -d

symfony server:log
