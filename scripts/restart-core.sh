#!/bin/bash

echo Restarting...
docker restart symfony-test-core
sleep 10
# docker exec -it symfony-test-core bin/console cache:clear
docker exec -it symfony-test-core bin/console doctrine:schema:update --force --complete
