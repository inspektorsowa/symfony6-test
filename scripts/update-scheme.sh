#!/bin/bash

docker exec -it symfony-test-core bin/console doctrine:schema:update --force
