# lexik-jwt-authentication
Proyecto en Symfony 4, usando Autenticacion JWT y Swagger
## Instalación
```
$ composer install
$ php bin/cosole doctrine:schema:create
$ php bin/console doctrine:schema:update --force
```
### Generar private and public keys
```
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
## Documentación Api's 📖
Si levantaste la aplicación con el propio server de Symfony, debes ir a esta dirección.
_Tener en cuenta que el puerto puede cambiar_
```
http://localhost:8000/api/doc
```
Si levantaste la aplicación con XAMPP o WAMPP , debes ir a esta dirección física (htdocs) donde se encuentra el proyecto.
_Ejemplo_
```
http://localhost/lexik-jwt-authentication/api/doc
```