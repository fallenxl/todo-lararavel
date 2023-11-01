// URL base de la API
const BASE_URL = process.env.NODE_ENV === 'production' ? '/api' : 'http://localhost:8000/api';

// Definición de puntos finales de la API
export const Endpoints = {
    // Obtener todas las tareas
    ALL_TASKS: `${BASE_URL}/tasks`, // Crear una nueva tarea
    CREATE_TASK: `${BASE_URL}/task/store`, // Obtener una tarea por su ID (puede necesitar un ID adicional)
    TASK: `${BASE_URL}/task/`, // Eliminar todas las tareas
    DELETE_ALL_TASKS: `${BASE_URL}/tasks/all`, // Eliminar tareas seleccionadas (puede requerir un conjunto de IDs)
    DELETE_SELECTED_TASKS: `${BASE_URL}/tasks/selected`,
}
