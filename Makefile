# Variables
ID=

# Comando para arrancar la aplicación
up:
	docker compose up -d

# Comando para construir la aplicación
build:
	docker compose build

# Comando para parar y destruir la aplicación
down:
	docker compose down

# Comando para entrar a contendor app
exec-app:
	docker compose exec -it app /bin/sh

# Comando para entrar a contendor server
exec-server:
	docker compose exec -it server /bin/sh

# Comando para entrar a contendor db
exec-db:
	docker compose exec -it db /bin/sh

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

# Curl POST user
post-user:
	curl -X POST http://localhost:8081/users -H "Content-Type: application/json" -d '{"name": "John Doe", "email": "john@example.com", "password": "Valid1213!"}'

# Curl GET user by id
get-user:
	@echo Obetiendo el usuario con id $(ID)
	curl -X GET http://localhost:8081/users/$(ID)

# Curl DELETE user by id
delete-user:
	@echo Eliminando el usuario con id $(ID)
	curl -X DELETE http://localhost:8081/users/$(ID)

