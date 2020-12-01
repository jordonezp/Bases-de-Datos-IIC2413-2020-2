# README de la Entrega 4

Este es el README de la entrega 4.

## Links relevantes

Acceso a la página principal:

([Principal (http://codd.ing.puc.cl/~grupo81/index.php)](http://codd.ing.puc.cl/~grupo81/index.php))

## Correr la App

### Ingresar al entorno virtual

Para ingresar al entorno virtual

``` bash
pipenv shell
```

### Instalación de dependencias

Para instalar las dependencias...

``` bash
pipenv install
```

### Iniciar el servidor

Para ejecutar en modo debuger:

``` bash
export FLASK_APP=main.py
export FLASK_ENV=development
flask run
```

O sin modo debuger:

``` bash
export FLASK_APP=main.py
flask run
```

### Funcionamiento

Para probar las consultas, se recomienda utilizar Postman.

#### Caso de error

En el caso de que el entorno virtual no funcione, las librerías utilizadas son:

| lib             | version    |
|-----------------|------------|
| click           | 7.1.2      |
| Flask           | 1.1.2      |
| itsdangerous    | 1.1.0      |
| Jinja2          | 2.11.2     |
| MarkupSafe      | 1.1.1      |
| pandas          | 1.1.4      |
| pip             | 20.2.4     |
| pipenv          | 2020.11.15 |
| pymongo         | 3.11.0     |
| python-dateutil | 2.8.1      |
| pytz            | 2020.4     |
| six             | 1.15.0     |
| Werkzeug        | 1.0.1      |


## Consideraciones y explicaciones

**GET**

Al inicio del documento ``` main.py``` se encuentran las rutas básicas que se solicitan en el enunciado.
Para la ruta '/messages', se definen:
*   ```show_messages()``` es una función que busca mensajes según ids con la función ```show_messages_with_args(id1, id2)``` , si es uqe estos son entregados, sino muestra todos los mensajes.
*   ```show_messages_with_args(id1, id2)``` filtra los mensajes que se hayan enviado entre los usuarios de los ids entregados. 

Para la ruta '/messages/<int:mid>', se definen:
*   ```show_messages_by_id(mid)``` que encuentra todos los mensajes que tengan como identificador el valor de 'mid'.

Para la ruta '/users', se definen:
*   ```show_users()``` que retorna todos los usuarios.

Para la ruta '/users/<int:uid>':
*   ```show_messages_from_user``` donde se muestran los datos del usuario que envía el mensaje y luego, todos los mensajes que ha enviado.

Para la sección de '/text-search', se define una gran función ```text_search``` que filtra las búsquedas según condiciones de búsqueda. Para ello, se analizan las llaves del ```request.json``` para armar la ```query```.


**POST**

Para la ruta '/messages', se define la función ```add_message()```. Esta función recibe los atributos y crea una nueva entrada en la base de datos.


**DELETE**

Para eliminar mensajes en la ruta '/message/<int:mid>' se define la función ```delete_message(mid)```. Esta función busca el mensaje que coincide con el 'mid' entregado y lo elimina de la base de datos con el método ```.remove(mid)```


