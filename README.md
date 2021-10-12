![logo](/public/img/logo.png)

# Registro de jornada laboral
 
Aplicacion para el registro de la jornada laboral por parte de los empleados
 

## Pasos para arrancar server

Para arrancar el server y poder testear la app se deben seguir los siguientes pasos:
1. Ejecutar el siguiente comando para crear la base de datos. A tener en cuenta que esta preparada para el uso de POSTGRES en el puerto 5433.
```php
php artisan migrate:fresh --seed
```
2. Ejecutar el comando de artisan para arrancar el server
```php
php artisan serve
```
3. Acceder a POSTGRES para obtener un email valido de la tabla users. La password sera "password.
4. Acceder a la siguiente ruta.
http://localhost:8000
## Tecnologías 
 
* Laravel 
* Tailwind 
* PostgreSQL 
* Laravel Breeze 
* Git 
   
## Laravel 
 
### Modelos 
 
* [User](/app/Models/User.php)
  * Equivale a una empresa. Una empresa tiene muchos empleados. 
* [Empleado](app/Models/Empleado.php)
  * Un empleado pertenece a una empresa y tiene muchos registros.
* [RegistroEmpleado](app/Models/registroEmpleados.php)
 
### [Migraciones](/database/migrations/)
 
#### users 
| Campo       | Tipo    | Restricciones  | Descripción                         |
| ----------- | ------- | -------------- | ----------------------------------- |
| id          | serial  | Clave primaria | identificación de la empresa        |
| name        | string  | NOT NULL       | Nombre de la empresa                |
| email       | string  | NOT NULL       | Email de la empresa (login)         |
| password    | string  | NOT NULL       | Password (login)                    |
| descripcion | string  | NOT NULL       | Descripcion de la empresa           |
| anyo        | integer | NOT NULL       | Anyo de creacion de la empresa      |
| admin       | boolean | NOT NULL       | Indica si es cuenta admin, solo quien gestiona la app |

 
#### empleados 
 
| Campo          | Tipo    | Restricciones  | Descripción                      |
| -----------    | ------- | -------------- | -------------------------------- |
| id             | serial  | Clave primaria | identificación de la empresa     |
| user_id        | string  | clave foránea  | Referencia a empresa             |
| nombre         | string  | NOT NULL       | Nombre del empleado              |
| apellidos      | string  | NOT NULL       | Apellidos del empleado           |
| identificacion | string  | NOT NULL       | DNI/NIE del empleado             |
| horasDia       | integer | NOT NULL       | Jornada laboral del empleado     |
| pin            | boolean | NOT NULL       | Pass para el registro            |
| imagen         | boolean | NOT NULL       | Ruta donde se encuentra la imagen|


#### registro_empleados 
 
| Campo          | Tipo    | Restricciones | Descripción                 |
| -------------- | ------- | ------------- | --------------------------- |
| dia            | date    | NOT NULL      | Dia del registro laboral    |
| empleado_id    | integer | clave foránea | referencia a un empleado    |
| horaEntrada    | time    | NOT NULL      | Hora de registro de entrada |
| horaSalida     | time    | NOT NULL      | Hora de registro de salida  |
 
 
 
### Rutas 
 
| Ruta                 | método | descripción                                                   |
| -------------------- | ------ | ------------------------------------------------------------- |
| `/`                  | GET    | Pagina de inicio con el listado de empleados (vista empleado) |
| `/dashboard`         | GET    | Pagina de inicio con el listado de empleados (vista empleado) |
| `/listado`           | GET    | Pagina con el listado de empleados (vista empresa)            |
| `/listado`           | POST   | Ruta para la password y devolver listado de empleados         |
| `/nueva_empresa`     | GET    | Pagina con formulario para nueva empresa                      |
| `/nueva_empresa`     | POST   | Página con la ruta que procesa el formulario de nueva empresa |
| `/borrar_empleado`   | POST   | Pagina que procesa el borrado de un empleado                  |
| `/nuevo_empleado`    | GET    | Pagina con formulario para nuevo empleado                     |
| `/nuevo_empleado`    | POST   | Página con la ruta que procesa el formulario de nuevo empleado|
| `/empleado/{id}`     | GET    | Pagina de acceso a datos de empleado                          |
| `/empleado`          | POST   | Página con la ruta que procesa el acceso a datos del empleado |
| `/changepin/{id}`    | GET    | Pagina de acceso a cambio de PIN                              |
| `/changepin`         | POST   | Página con la ruta que procesa el cambio de PIN               |
| `/registroEntrada`   | POST   | Página con la ruta que procesa un registro de entrada         |
| `/registroSalida`    | POST   | Página con la ruta que procesa un registro de salida          |
 
### Vistas 
 
| Vista                            | Información que recibe | Ruta               |
| -------------------------------- | ---------------------- | ------------------ |
| dashboard.blade.php              | Listado de empleados   | /                  |
| dashboard.blade.php              | Listado de empleados   | /dashboard         |
| empleado.blade.php               | Datos de empleado      | /empleado/{id}     |
| formulario-empleado.blade.php    | Empresa                | /nuevo_empleado    |
| formulario-empresa-blade.php     |                        | /nueva_empresa     |
| listado-empleados.blade.php      | Listado de empleados   | /listado           |
| pin.blade.php                    | Datos del empleado     | /changepin/{id}    |
 

### Controladores 
  
* UserController.php
  * add -> Acceso a vista con formulario para nueva empresa.
  * save -> Creacion y guardado de nueva empresa;
* EmpleadoController.php 
  * getEmpleados -> devuelve listado de empleados para una empresa (vista empleados).
  * accesoListaEmpleados -> Acceso a vista listado de empleados (vista empresa).
  * getListaEmpleados -> devuelve listado de empleados para una empresa (vista empresa).
  * getEmpleado -> acceso a vista de empleado.
  * acceder -> Acceso a datos de empleado.
  * accessChangePin -> Acceso a vista para el cambio de PIN.
  * changePin -> Gestiona el cambio de PIN de un empleado.
  * delete -> Borrado de un empleado.
  * add -> Acceso a la vista para la creacion de un nuevo empleado.
  * save -> Gestiona la creacion y guardado de un nuevo empleado.
* RegistroEmpleadoController.php 
  * getRegistroEmpleados -> Devuelve los registros para un empleado.
  * registroEntrada -> Gestiona la creacion de un registro de entrada.
  * registroSalida -> Gestiona la creacion de un registro de salida.
 
