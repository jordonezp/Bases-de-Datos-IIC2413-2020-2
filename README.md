# Bases-de-Datos-IIC2413-2020-2

Repositorio para el ramo de bases de datos

## Links Útiles

[Repositorio del curso](https://github.com/IIC2413/Syllabus-2020-2)

[Wiki del curso](https://github.com/IIC2413/Syllabus-2020-2/wiki)

[Link a esquema](https://app.diagrams.net/#G1e58pdGvJdMgvwCmyVqOr9i1E7js0U08Z)

[Link a diagrama E/R](https://app.diagrams.net/#G1vcTFUGnLlvgxuxi5TzU2fql6e1thKh_8)

[Link a la pagina (http://codd.ing.puc.cl/~grupo81/index.php)](http://codd.ing.puc.cl/~grupo81/index.php)

[Link a la API (https://api-bdd-g-94-81.herokuapp.com/)](https://api-bdd-g-94-81.herokuapp.com/)

## Notas Entrega1

Dirección del servidor:

``` bash
grupo81@codd.ing.puc.cl
```

Clave para ingresar al servidor:

``` bash
clave81
```

Clave para ingresar a psql:

``` bash
clave81
```

Para ver las bases de datos:

``` sql
\l
```

Para seleccionar la base de datos:

``` sql
\c <nombre base>
```

Para la entrega2: nombre base=grupo81e2

Para ver las tablas hay que ejecutar (en psql)

``` sql
\dt
```

Agregué una entrada en la tabla también.

Para verla hay que ejecutar (en psql)

``` sql
SELECT * FROM boats;
```

Para entrar al shell:

``` bash
pipenv shell
```

Para ejecutar en modo debuger:

``` bash
export FLASK_APP=main.py
export FLASK_ENV=development
flask run
```

Para conectarse a la mongodb:

``` bash
mongo -u grupo81 -p grupo81 gray.ing.puc.cl/grupo81 --authenticationDatabase admin
```

Para subir archivos a mongodb:

``` bash
mongoimport --collection <nombre_coleccion> --drop --file <archivo>.json --jsonArray --uri "mongodb://grupo81:grupo81@gray.ing.puc.cl:27017/grupo81?authSource=admin"
```

## Deploy a Heroku

### Dirección a la repo

``` bash
https://git.heroku.com/api-bdd-g-94-81.git
```

### Conexión a la repo

``` bash
git remote add heroku https://git.heroku.com/api-bdd-g-94-81.git
```

Para verificar que se haya añadido

``` bash
git remote -v
```

### Deploy de la app

Desde la carpate principal del proyecto, se debe ejecutar el comando

``` bash
git subtree push --prefix Entrega5 heroku master
```
