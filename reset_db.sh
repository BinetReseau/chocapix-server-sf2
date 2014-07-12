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
# curl --data "item=3&qty=2" http://localhost/bars-symfony/web/avironjone/buy?bearer=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MDUyNzE3NDUsInVzZXJuYW1lIjoiYWRtaW4yIiwiaWF0IjoiMTQwNTE4NTM0NSJ9.NskzRXrQdE8nHEmZYuXifn7bS89wtoi6oHqQY0l3ycs9hW7Linxu0Feq8Nm9F%2BFvCqGRbN0tI7Jp%2BXHckxrqBq%2By%2Bd3rcGyzdWGraVbvACd8BAzzs3WlcWaVBf2OwuuIyklFiPk3BtN6rNhR31uUKDDdzRrhUQP1WVDoh%2B4fe2iIirc%2BAVU88v52m3L99Pal%2FdixE2XHe%2FTbONKqr6kQeSgeUqj2Hk3m7EHM0%2BqmBojdodp79Lx8U7RbK4fGQ9MxgdcKxHqywL1g%2BdVsdq%2B%2FiNhF0YjumMyDJdAYi0TAvf2VtJ2n82aQqwqJzVqxIuKoUhxmnE6YJYuUxNL1bPRWHpORHsfJN1Rh3A7thGJSAkSTSuxbqB27%2B2mz44%2BkV63WwXTr9k%2BZBcI0kDXbF7OAtbSZUtfq4ASa2qzqPqGQE7LQAjMpuTE8tYppbEw6CAn7Y4gNwcyZokwyjPHTelHXU2vhgv%2FuNo3hv6pKy8YgYdf%2F0SrXBfRyw2M5phKIFI1GTRr%2BOzPR%2FW6ysZpeDYClgViTTvuMMomcNF6AZL%2BqArpR3l4R1quLMru2tLmR%2Fa0ACHKDoKcEJKbrEEr3PaXOdWXRpSITSDw2cNGQFZliD6MEvRCpIZay3FmSJHKHIFTHR6vLijAlGhAfD3AInaUMaOWbQvS6W2sHsHYzzrIlDPs%3D

