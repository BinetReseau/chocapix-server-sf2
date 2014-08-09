#!/bin/sh
. chmod_cache.sh
php app/console cache:clear
. chmod_cache.sh
