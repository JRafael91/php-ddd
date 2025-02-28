# Comando para arrancar la aplicación
up:
	docker compose up -d

# Comando para parar y destruir la aplicación
down:
	docker compose down

# Comando para validar schemas
doctrine-validate:
	docker compose exec app vendor/bin/doctrine orm:validate-schema

# Comando para crear schemas en la base de datos
doctrine-create:
	docker compose exec app vendor/bin/doctrine orm:schema-tool:create

# Comando para eliminar schemas y datos
doctrine-drop:
	docker compose exec app vendor/bin/doctrine orm:schema-tool:drop --force

# Test unitarios de la aplicación(app)
unit-test:
	docker compose exec app vendor/bin/phpunit --testsuite Unit

# Test integración de la aplicación(app)
integration-test:
	docker compose exec app vendor/bin/phpunit --testsuite Integration