# Car Rental

Aplicación Web desarrollada en Laravel 7.25.0, Bootstrap, jquery con panel administrativo para la gestion de vehiculos, y landing de renta de vehiculos. 


### Pre-requisitos 📋

PHP >= 7.2.5

MySQL

Composer

npm o Yarn 

### Instalación 🔧

Instalar las dependencias del proyecto con Composer. 
composer install

Crear o copiar el archivo .env con los  instalar las dependencias del proyecto con Composer.
cp .env.example .env

Generar la llave de cifrado
php artisan key:generate

instalar los paquetes npm
npm run dev o npm run prod

Correr las migraciones 
php artisan migrate

ejecutar los seeders
php artisan db:seed

Crear enlace simbolico de la carpeta Storage
php artisan storage:link

### Usuarios de Prueba en Seeders 🔧

Name:     Admin
Email:    admin@example.com
Password: secret

Name:     User
Email:    user@example.com
Password: secret

## Construido con 🛠️

* [AdminLTE](https://adminlte.io/) - Frondend con Boostrap y jquery
* [Laravel 7](https://laravel.com/) - Backend

## Autor ✒️

* **Engelbertg Jesus Bracho Ramírez** - [Engelb64](https://github.com/Engelb64)
