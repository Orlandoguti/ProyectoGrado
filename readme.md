# Sistema de F.U.T.E.C.R.A.
## Requerimientos

Si se desea instalar este sistema se tiene los siguientes requisitos:
- PHP 7.2 o mayor
- Mysql 5.6 o mayor
- Composer
- Git
- Nodejs

## Pasos de instalacion

1.- Clonar el proyecto con git

`git clone https://github.com/Orlandoguti/ProyectoGrado.git`

2.- Instalar las dependecias de Laravel con composer

`composer install`

3.-Instalar las dependencias de Vue.js con npm

`npm install`


4.- Renombrar el archivo .env.example a .env y configurar los accesos a la base de datos

	DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=proyecto_grado
    DB_USERNAME=root
    DB_PASSWORD=

5.- Generar la estructura de la base de datos

`php artisan migrate`

7.- Generar la llave de seguridad de laravel

`php artisan key:generate`

8.- Generar la llave JWT

`php artisan jwt:secret`
