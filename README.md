# Base de PHP aplicando DDD y Arquitectura Limpia

API de gestión de usuarios construida con PHP utilizando los principios de Diseño Orientado al Dominio (DDD) y Arquitectura Limpia, sin depender de ningún framework PHP.

- PHP 8.4
- Doctrine ORM


## Iniciar Proyecto

### 1.- Clonar repositorio
```bash
 git clone https://github.com/JRafael91/php-ddd.git
```
### 2.- Iniciar los servicios de Docker del proyecto

#### comando make
```bash
make up
```

### 3.- Validar schemas
```bash
make doctrine-validate
```

### 4.- Generar schemas en la base de datos
```bash
make doctrine-create
```
## API
Las siguientes son las peticiones HTTP que se pueden realizar.

- `POST http://localhost:8081/users` - Crear nuevo usuario.
```json
{
	"name": "",
	"email": "",
	"passsowrd": "",
}
```

- `GET http://localhost:8081/users/{ID}` - Obtener usuario por ID.

- `DELETE http://localhost:8081/users/{ID}` - Eliminar usuario por ID.

## Comandos para crear un usuario válido

- Crear un usuario válido
```bash
make post-user
```

- Obtener usuario por ID
```bash
make get-user ID=colocar id del usuario creado
```

- Eliminar usuario por ID
```bash
make delete-user ID=colocar id del usuario creado
```

## Ejecutar Test

### 1.- Test unitarios
```bash
make unit-test
```

### 2.- Test de integración
```bash
make integration-test
```

## Entrar a contenedores

### 1.- Contenedor app
```bash
make exec-app
```

### 2.- Contenedor db
```bash
make exec-db
```

### 3.- Contenedor server
```bash
make exec-server
```
