# API REST

Enlace a la introducción a API REST  
[https://docs.google.com/document/d/1RzCP687k5kT6xHnRmzJ7050-aXBIsNzyb2UYfSRtST4/edit?usp=sharing](https://docs.google.com/document/d/1RzCP687k5kT6xHnRmzJ7050-aXBIsNzyb2UYfSRtST4/edit?usp=sharing)

Para trabajar con APIs en Laravel, ejecutamos `php artisan install:api`

Esto hace:

1.  Crea el fichero de rutas de API en routes/api.php
2.  Instala la librería Sanctum para la autenticación
3.  Crea una nueva migración para guardar los tokens creados de cada usuario

Una vez haya finalizado la instalación, ya podemos empezar a crear los endpoints de nuestra API en el fichero **api.php**.

Tenemos que instalar la aplicación Postman para poder probar los endpoints en local:  
[https://www.postman.com/](https://www.postman.com/)

Una vez instalada, siguiendo el fichero de routes/api.php podremos ejecutar este endopoint:

`GET => http://localhost:8001/api/test`

Si queremos crear un controlador con todos los métodos necesarios para crear nuestros endpoints:
`php artisan make:controller NombreDelController --api`

Si queremos crear un modelo y controlador para usarlo como Recurso con sus endpoints:
`php artisan make:model NombreDelModelo --api`