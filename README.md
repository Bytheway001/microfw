# MicroFW
## Comandos
`Core\bin\generator generate model [Nombre]`
- Generamos un modelo automaticamente, este comando conectara directamente a la base de datos utilizada y extraera todas las llaves foraneas, generando las debidas asociaciones para el mismo

## Configuracion Inicial
### Base de datos
- Basta con editar el archivo `config/web.php` y colocar las credenciales de la base de datos a utilizar
### Modelos
- Los modelos los podemos generar con el generador mencionado arriba, de igual manera podemos crearlos dentro de la carpeta `App/Models` cumpliendo con las siguientes condiciones:
			 Deben extender a la clase Model
			 Deben contener nombres en SINGULAR con inicial mayuscula
			 Deben corresponder al nombre PLURAL en minuscula con la tabla en la base de datos

### Controladores
Ubicados en la carpeta `App/Controllers`, lo ideal es que estos extiendan del controlador principal (clase Controller), estos deben terminar su nomenclatura con la palabra "Controller" (ej: usersController, clientsController, etc)
Con cada request realizada, el router llamara a un controlador (clase) y una accion (metodo) especifica, enviando los parametros por 3 diferentes formas
#### Mediante argumentos del metodo (que corresponderan con los parametros establecidos en la ruta.
 - por ejemplo si la ruta es /users/:id, el controlador debe recibir un argumento $id que correspondera al valor pasado mediante la url)
 
#### Mediante payload (peticiones PUT y POST)
- Vendra dado por `$this->request->payload`

#### Mediante query params
 - los query params (ej: `/users?name=luis`) se encontraran en la propiedad `$this->request->params`

### Rutas
El archivo de rutas se encuentra en `Config/routes.yaml`, que contendra todas las rutas con las que contaremos en la siguiente forma

    base_path: /
    	routes:
    		home:
    			users: [/users,list,GET]
En este ejemplo, especificamos la ruta base "/" y a continuacion las rutas como tal
agrupadas por controlador, en este caso la ruta `/users` con el metodo `GET` llamara al controlador llamado `homeController`, luego en la siguiente linea viene el nombre de la ruta (debe ser unico, pero de resto es irrelevante), y la ruta que seria ` [/users,list,GET]`
donde el primer argumento es el path con el que se disparara esta ruta (/users), el segundo es la accion a la que llamaremos ('list') y el ultimo es el metodo de peticion que disparara esta ruta (GET)
`
