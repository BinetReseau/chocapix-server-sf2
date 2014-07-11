#!/bin/sh
#app/console doctrine:generate:entities --no-backup BR

app/console doctrine:database:drop --force
app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:query:sql "$(cat init.sql)"


# sudo rm -R app/cache
# mkdir app/cache
# sudo chmod -R 777 app/cache/

# openssl genrsa -out app/var/jwt/private.pem -aes256 4096
# openssl rsa -pubout -in app/var/jwt/private.pem -out app/var/jwt/public.pem

# Get token
# curl --data "login=admin&password=admin" http://localhost/bars-symfony/web/natationjone/auth/login

