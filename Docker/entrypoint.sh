#!/bin/bash

set -e

if [ ! -f "./vendor/autoload.php" ]; then
	composer install --no-progress --no-ineraction
else
	echo "vendor/autoload.php existe"
fi

exec "$@"