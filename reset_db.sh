#!/bin/sh
#app/console doctrine:generate:entities --no-backup BR

app/console doctrine:schema:drop --force
#app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:query:sql "$(cat init.sql)"

# openssl genrsa -out app/var/jwt/private.pem -aes256 4096
# openssl rsa -pubout -in app/var/jwt/private.pem -out app/var/jwt/public.pem

# Get token
# curl --data "login=admin&password=admin" http://localhost/bars-symfony/web/nobar/auth/login
# curl --data "item=3&qty=2" http://localhost/bars-symfony/web/avironjone/buy?bearer=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MDU4NzI1MTUsInVzZXJuYW1lIjoiYWRtaW4iLCJpYXQiOiIxNDA1Nzg2MTE1In0%3D.SWMa2X9QOfmJOQSCIos6hgYXGDpMJatvocOG7gQSbOE%2BbrSue8xJnsiayqt6gSXZR3K60eQdzbRfkW9XOLwMX54S4%2BlYEAwd0MNsWX%2FFWG7lgJGFcGOosQdRGSV7f4v58pr9%2BiSE8PKF0iBpRPmHLs%2FTi4%2BQg%2FmybthfCIbR5RwEZsBio5YIBETa7bPMcNoR51Zgr%2FXrNZqQg6GoNcUBrZPR3KuSVe%2BxqpsaCqs7vY2Qas%2BecrwkjEatayzCNEwkQd%2F%2BVjKwVGwVzVaQI6RIo5z9g%2BgBOcpPOAfV48SNMRYtGWqj7wVq0%2B7DMpZqgcIZUa4LZK1UcVkPzMTrt7DpNf5WRjUg4Gn4Q3sn%2FablXrtbvLnkx9KZAIdSLcjvx0wZCZ2nE%2BhbXhUiY%2B5IygI1NwBv6V9qDRuYzY1achvGaCeare4glUIHtGQ9Vr9ZRRgtNMUV6ydny9vzery692tQzd%2FR32%2F7wnYM4zpyOEOuwazaDP17h6w9cI%2BsJZy%2B%2Bl1lmdz5ybISEU%2Bj6XmFA3RKL6DaAgE4cTdBwJyZkmYRoQNemiLAK%2FpK5yX4qoj9TEeE4AQ5olGmR8KCzvPqqVO%2Be5IbW8e09B%2FFeTHRDIrG1cxMs7oBy2inOP%2FntS3hYeEKVR6TAK43eemmia9734CKBcyCM470rn5VWWb1f8Or8HA%3D
