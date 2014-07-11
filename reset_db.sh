#!/bin/sh
#app/console doctrine:generate:entities --no-backup BR

app/console doctrine:database:drop --force
app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:query:sql "$(cat init.sql)"

# sudo rm -R app/cache
# mkdir app/cache
# sudo chmod -R 777 app/cache/
