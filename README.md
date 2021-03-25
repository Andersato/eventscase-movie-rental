# Aplicación para la gestión de un videoclub por correo postal

Proyecto demo implementando DDD y arquitectura hexagonal sobre Symfony 4

## Docker

Para iniciar con docker y construir la imagen hay que lanzar este comando:

     docker-compose up --build
     
Para entrar en la imagen de la aplicación ejecutar:

    docker exec -i -t app bash     

## Instalación

Se instalan las dependencias de componser:

    composer install
    
## Creación de la BBDD

Se ha utilizado Mysql como gestor de BBDD, para crear la BBDD hay que lanzar el siguiente comando:

    php bin/console doctrine:database:create
    
Creación de la estructura de la BBDD:

    php bin/console doctrine:migrations:diff
    php bin/console doctrine:migrations:migrate        
    
## Test 

Para lanzar los test de phpunit:

    composer test

## Creación de usuarios de administración

Se ha creado un comando para crear usuarios con rol de administración. El comando espera dos opciones: email y password

    php bin/console app:create_admin --help
    
    Usage:
      app:create_admin [options]
    
    Options:
          --email=EMAIL        Email del usuario admin
          --password=PASSWORD  Contraseña del usuario admin
      -h, --help               Display this help message
      -q, --quiet              Do not output any message
      -V, --version            Display this application version
          --ansi               Force ANSI output
          --no-ansi            Disable ANSI output
      -n, --no-interaction     Do not ask any interactive question
      -e, --env=ENV            The Environment name. [default: "dev"]
          --no-debug           Switches off debug mode.
      -v|vv|vvv, --verbose     Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Un ejemplo sería:

    php bin/console app:create_admin --email=admin1@gmail.com --password=123456
    
## Ejecutar la aplicación

Para ejecutar la aplicación usando docker, se debe generar la imagen usando los pasos del apartado "Docker", la aplicación correrá en el puerto 8002.

    http://localhost:8002/
    
## Rutas de la aplicación

    http://localhost:8002/ => Home de la aplicación, lista todas las películas que existen
    http://localhost:8002/login => Login de usuarios
    http://localhost:8002/logout => Desconexión de usuarios
    http://localhost:8002/register => Registro de usuarios
    http://localhost:8002/user/rented-movies => Listado de películas alquiladas por el usuario
    http://localhost:8002/admin/show-movies => Listado de todas las películas de la aplicación. Sólo lo verán los administradores
    http://localhost:8002/admin/create-movie => Creación de una película. Sólo accederán los administradores
    http://localhost:8002/admin/rented-movies => Listado de todas las películas alquiladas. Sólo accederán los administradores
    
## Estados de los pedidos (alquileres) de las películas

Los pedidos o alquileres de las películas tienen diferentes estados para su gestión. Estos estados podrán ser manipulados por los propios usuarios o por los administradores.

**rentend**: Estado inicial cuando se alquilan películas. \
**cancelled**: Estado cancelado, que solo podrá manipular el usuario que alquila. \
**sent**: Estado enviado, que solo podrá cambiarlo el administrador, cuando se envían las películas al cliente. \
**received**: Estado recibido, que lo podrá modificar el administrador cuando el cliente reciba las películas. \
**unreceived**: Estado no recibido, solo se podrá modificar por los administradores si un cliente no recibe sus películas. \
**delivered**: Estado devuelto, solo lo podrá cambiar el cliente cuando decida devolver las películas. \
**returned**: Estado entregado, solo se podrá cambiar por los administradores y significa que las películas se han entregado al videoclub.            

    


