#!/bin/sh
#app/console doctrine:generate:entities --no-backup BR

app/console doctrine:database:drop --force
app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:query:sql "$(cat init.sql)"

# Creates OAuth client (do this once)
# For now, test client included in init.sql
# app/console br:bar:oauthclient:create --grant-type=password Bars

# Example OAuth token request
# CLIENT_ID="1_66itn4322bggs8wgg0o04wskskc8c4kscwckwos400g4s4ksog"
# curl --data "grant_type=password&username=admin&password=admin&client_id=$CLIENT_ID" http://localhost/bars-symfony/web/oauth/v2/token

# openssl genrsa -out app/var/jwt/private.pem -aes256 4096
# openssl rsa -pubout -in app/var/jwt/private.pem -out app/var/jwt/public.pem
