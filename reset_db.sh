#!/bin/sh
#app/console doctrine:generate:entities --no-backup BR

# echo "Clearing cache..."
# . clear_cache.sh

app/console doctrine:schema:drop --force
#app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:query:sql "$(cat init.sql)"

# echo "Clearing cache again..."
# . clear_cache.sh

# Generate rsa keys for jwt auth
# openssl genrsa -out app/var/jwt/private.pem -aes256 4096
# openssl rsa -pubout -in app/var/jwt/private.pem -out app/var/jwt/public.pem

# Populate history
# n_entries=500
# echo "Populating history... ($n_entries entries)"
# API_URL="http://localhost/bars-symfony/web"
# TOKEN=$(curl -s --data "login=admin&password=admin" $API_URL/nobar/auth/login | python -c 'import json,sys;print json.load(sys.stdin)["url_safe_token"]')
# for i in $(seq 1 $n_entries); do
# 	curl -s --data "item=3&qty=1" $API_URL/avironjone/action/buy?bearer=$TOKEN > /dev/null
# 	p=$(($i*100/$n_entries))
# 	echo -ne "$p%\r"
# done
# echo ""
