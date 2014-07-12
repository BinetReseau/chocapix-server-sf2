#!/bin/sh
#app/console doctrine:generate:entities --no-backup BR

app/console doctrine:schema:drop --force
#app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:query:sql "$(cat init.sql)"


# sudo rm -R app/cache
# mkdir app/cache
# sudo chmod -R 777 app/cache/

# openssl genrsa -out app/var/jwt/private.pem -aes256 4096
# openssl rsa -pubout -in app/var/jwt/private.pem -out app/var/jwt/public.pem

# Get token
# curl --data "login=admin&password=admin" http://localhost/bars-symfony/web/natationjone/auth/login
# curl --data "item=1&qty=2" http://localhost/bars-symfony/web/natationjone/buy?bearer=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MDUxODg2MTIsInVzZXJuYW1lIjoiYWRtaW4iLCJpYXQiOiIxNDA1MTAyMjEyIn0%3D.QBatsAvWl%2FMbGrJchLIGtNqytKlHO%2Fz8bWS4XnPPKPBdzRH8%2Fc3lTlSzOXhWDiVjVbzYlN16PUM2%2F0DBPHT6DiRv%2FGSuWjCnnWD%2BHLRH6RmflCNnkA3KcLyG9jSwJmak5dG7jQ6HOwBEjRw6wRaeDgwp%2FnazzyJCMxP155upxYrhSPZdSe1QNSjOy6I0nj%2BTDfJtUrDRzzrq5Lf1P4MpTKX%2BVC5lEKwpfLP9sj5bj4TtAO6VeBYj1Rjn2g742v0rFG2DX2RGLEoNQ10yQOLX6fpKptIn53HI3PG1srEx4hp2xSFZJsoqb6MqfXtanxGP%2BCMagVhuvcYnuFikWN0CUHv9y1wWWdFEwSArG2boAeATzqZUyNw8TBzqKrBQIbvVEucqq%2FJSpAppwwMQlAS56hw%2B3Zz%2F3wxYoiKg4Xe3LoSFTUNYLAGIeTaPfjOoui8cY5ZtBEBq1R9mHYZe%2BT4D98BkC6J%2FuuHfEat2CvR268PR1KmlgCLMNhDRcyDa12WT5zzIzFERlLKRTPFM%2FN6R9B9rvFQF0vaAG9icv12Ol7A%2BqGAdkEbrFqT6o6uUed5WtJv4faYxTFcidtBbR%2BkDI9P%2F6lIcbhBWsAumHeDok%2FAmpu0KI%2FbXSShGi1FvwPHTh%2BiaOVu%2BPpC0WM0j9989cFnEKMuLctGKhgsc%2FRDSJiQ%3D

