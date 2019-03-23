# lexik-jwt-authentication
Proyecto en Symfony 4, usando Autenticacion JWT y Swagger
### Instalación
...
$ composer install
$ php bin/cosole doctrine:schema:create
$ php bin/console doctrine:schema:update --force
...
### Generar .pem
...
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
...
