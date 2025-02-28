#!/bin/bash

set -e

if [ ! -f "./vendor/autoload.php" ]; then
	composer install --no-progress --no-interaction
else
	echo "vendor/autoload.php existe"
fi

exec "$@"