
# Todo Lister App con Laravel y Vue.js

[Live Demo](https://tu-aplicacion-de-demo-en-vivo.com)

Este es un proyecto de una aplicación web de lista de tareas (ToDo List) desarrollada con Laravel y Vue.js. La aplicación utiliza una base de datos MySQL para almacenar las tareas. Puedes usar esta aplicación para crear, editar, eliminar y gestionar tus tareas diarias.

## Requisitos

Asegúrate de tener instalados los siguientes requisitos antes de comenzar:

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 18
- [npm](https://www.npmjs.com/)
- [Laravel](https://laravel.com/docs/8.x/installation) >= 10
- [MySQL](https://dev.mysql.com/downloads/mysql/) (o cualquier otro sistema de gestión de bases de datos compatible)


# Documentacion

## Listar tareas
**Endpoint:** /tasks

**Descripción**: Este endpoint muestra una lista de todas las tareas ordenadas por la fecha de creación descendente.

## Crear tarea

**Endpoint**: /task/store

**Descripción**: Este endpoint permite crear una nueva tarea en el almacenamiento.

**Parámetros de entrada:**

task[title] (cadena): Título de la tarea.
task[description] (cadena): Descripción de la tarea.
**Respuesta exitosa (código de estado 200):**

La tarea recién creada.
Respuesta de error (código de estado 403):

Mensaje de error en caso de problemas.

## Actualizar tarea

**Endpoint:** /task/{id}

**Descripción:** Este endpoint permite actualizar una tarea específica en el almacenamiento.

**Parámetros de entrada:**

id (cadena): Identificador único de la tarea que se va a actualizar.
task[completed] (booleano): Indica si la tarea está marcada como completada.
**Respuesta exitosa (código de estado 200):**

La tarea actualizada.
Respuesta de error (código de estado 403 o 404):

Mensaje de error en caso de problemas o si la tarea no se encuentra.

## Eliminar todas las tareas

**Endpoint:** /tasks/all

**Descripción:** Este endpoint permite eliminar todas las tareas almacenadas.

**Respuesta exitosa (código de estado 200):**

Mensaje de éxito.
Respuesta de error (código de estado 403):

Mensaje de error en caso de problemas.

## Eliminar tareas seleccionadas

**Endpoint:** /tasks/selected

Descripción: Este endpoint permite eliminar tareas seleccionadas del almacenamiento.

**Parámetros de entrada:**

selectedTasks (array): Lista de IDs de tareas seleccionadas.
**Respuesta exitosa (código de estado 200):**

Mensaje de éxito.
Respuesta de error (código de estado 403):

Mensaje de error en caso de problemas o si no se han seleccionado tareas.

## Eliminar tarea específica

**Endpoint:** /task/{id}

**Descripción:** Este endpoint permite eliminar una tarea específica del almacenamiento.

**Parámetros de entrada:**

id (cadena): Identificador único de la tarea que se va a eliminar.
**Respuesta exitosa (código de estado 200):**

Mensaje de éxito.
Respuesta de error (código de estado 403 o 404):

Mensaje de error en caso de problemas o si la tarea no se encuentra.

## Uso

La aplicación de lista de tareas es simple y fácil de usar:

- Puedes agregar nuevas tareas especificando un título y una descripción.
- Marca las tareas como completadas o pendientes.
- Edita las tareas existentes si es necesario.
- Elimina una tarea a la vez o todas las tareas completadas a la vez.
- Administra tus tareas de manera eficiente.

¡Disfruta organizando tus tareas diarias con nuestra aplicación!

## Contribución

Si deseas contribuir a este proyecto, sigue estos pasos:

1. Crea un fork del repositorio en GitHub.
2. Clona tu fork en tu máquina local.
3. Crea una nueva rama para tu contribución: `git checkout -b mi-contribucion`.
4. Realiza tus cambios y commitea: `git commit -m 'Añadí una nueva característica'`.
5. Sube los cambios a tu fork: `git push origin mi-contribucion`.
6. Crea una solicitud de extracción (Pull Request) en el repositorio original.

Desarrollado por Axl Santos.

