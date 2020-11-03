# Readme de la Entrega 3

## Links relevantes

([Principal (http://codd.ing.puc.cl/~grupo81/index.php)](http://codd.ing.puc.cl/~grupo81/index.php))

## Cómo logearse en la aplicación

Acceder a la página principal ([Principal (http://codd.ing.puc.cl/~grupo81/index.php)](http://codd.ing.puc.cl/~grupo81/index.php))

### Para crear una cuenta

Ir a la pestaña Crear Cuenta ([crear Cuenta](http://codd.ing.puc.cl/~grupo81/crear_cuenta.php))

Crear cuenta con valores correspondientes. Notar que la contraseña debe tener un largo de 6 caracteres.

### Para acceder a una cuenta existente

Si quiere iniciar sesión con una cuenta ya existente, puede ver toda la información de las cuentas ya creadas en la pestaña ([Cargar Cuentas Capitanes/Jefes](http://codd.ing.puc.cl/~grupo81/consultas/load_accounts.php)).

## Cómo corregir la funcionalidad adicional

La funcionalidad adicional introducida consiste en una herramienta para buscar más eficientemente las navieras y los puertos. Se ha introducido una barra de búsqueda en las vistas que despliegan la lista de navieras y puertos, donde al introducir un caracter se filtran los valores de la lista para que permanezcan solamente las que coincidan con los caracteres introducidos.

Para corregir esta funcionalidad, acceda a la página principal ([Principal](http://codd.ing.puc.cl/~grupo81/index.php))

Escoja si quiere buscar una Naviera o Puerto.

En esta vista, se presentará una barra de búsqueda que filtrará la lista mostrada.

## Procedimientos almacenados

Para todas las consultas de la página de puertos se utilizaron procedimientos almacenados. Algunos de estos llaman a otros procedimientos almacenados, por lo tanto se han incluido todas junto a este README.md.

A continuación se da una breve explicación del funcionamiento de cada uno.

### Días disponibles para cada instalación del puerto

``` sql
get_available_days_for_facility_for_port_for_day_range(
    '$pid', '$fecha_inicio', '$fecha_termino')
```

Este procedimiento almacenado a su vez llama a

``` sql
get_permits_for_facility_for_date
```

### Porcentaje de ocupación promedio en ese intervalo

``` sql
get_average_occupancy_per_facility_for_port_for_day_range(
    '$pid', '$fecha_inicio', '$fecha_termino')
```

Este procedimiento almacenado a su vez llama a

``` sql
get_permits_for_facility_for_date
```

### Buscar si hay disponibilidad en algún astillero

``` sql
search_shipyard_permit_availability(
    '$pid', '$fecha1', '$fecha2', '$patente')
```

En caso de encontrar disponibilidad, se llama al siguiente procedimiento almacenado para crear un permiso.

``` sql
insert_shipyard_permit
```

### Buscar si hay disponibilidad en algún muelle

``` sql
search_dock_permit_availability(
    '$pid', '$fecha', '$patente');
```

En caso de encontrar disponibilidad, se llama al siguiente procedimiento almacenado para crear un permiso. Notar que la descripción en este caso será '-'.

``` sql
insert_dock_permit
```

## Cómo corregir cada requerimiento

### Cambio de contraseña

Accediendo al perfil del usuario correspondiente se presentará un botón para cambiar la contraseña de la cuenta. Notar que debe saber cuál es la constraseña actual y la constraseña nueva debe tener un largo de 6 caracteres.

### Consulta Navieras y Buques

Para evaluar las consultas de navieras y buques basta con acceder a la página principal ([Principal](http://codd.ing.puc.cl/~grupo81/index.php)).

Seleccionar el botón para buscar las navieras, el cuál lo dirigará a la página ([Consulta Navieras](http://codd.ing.puc.cl/~grupo81/navieras.php)).

Finalmente, haciendo click en alguna naviera ejecutará la consulta y se mostrará el listado de buques asociados.

### Consulta Puertos

Para evaluar las consultas de puertos basta con acceder a la página principal ([Principal](http://codd.ing.puc.cl/~grupo81/index.php)).

Seleccionar el botón para buscar puertos, el cuál lo dirigará a la página ([Consulta Puertos](http://codd.ing.puc.cl/~grupo81/puertos.php)).

Finalmente, haciendo click en algun puerto lo redirigirá a una vista adonde se pueden ejecutar consultas específicas asociadas al puerto escogido.


### Cuentas Capitanes/Jefes

Para ver todos los perfiles (pasaporte/clave/etc.) hay que dirigirse a la pestaña ([Cargar Cuentas Capitanes/Jefes](http://codd.ing.puc.cl/~grupo81/consultas/load_accounts.php)).
Lo que hace esta funcion es cargar todos los perfiles de la base de datos, al mismo tiempo recorre todos los capitanes y jefes existentes y revisa si es que estan marcados como usuarios, en caso de no estarlo, se le creara automaticamente un perfil con clave aleatoria.

### Disclaimer 
Para el inicio de sesión se solicita una clave y contraseña pero no se lograron implementar restricciones para el inicio de sesión. Es decir, se puede ingresar con cualquier contraseña.

Tuvimos problemas con los ultimos commits, por lo que tuvimos que volver a un comit anterior (Datos Personales 19 - 4418881f27bfbbaada6f2cfdbaeb71b4c0709106)