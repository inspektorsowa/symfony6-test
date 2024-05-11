#!/bin/bash

# Install Symfony if not exists
if [[ ! -f "./composer.json" ]]; then
  symfony new app --version=6.4 --no-git --php=8.1 --docker
  mv app/* ./
  rm app -Rf
fi

# Create .env file if not exists
if [[ ! -f ".env" ]]; then
  cp .env.dist .env
fi

composer install

bin/console cache:clear
bin/console doctrine:schema:update --force --complete

symfony server:ca:install
symfony server:stop
symfony server:start -d

symfony server:log
