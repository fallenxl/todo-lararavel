import axios from "axios";
import {Endpoints} from "@/vue/constants/Endpoints.js";

// Servicios relacionados con las tareas
export const TaskServices = {
    // Obtener todas las tareas
    getAllTasks: async () => {
        try {
            return await axios.get(Endpoints.ALL_TASKS);
        } catch (error) {
            console.log(error);
        }
    }, // Crear una nueva tarea
    createTask: async (task, cb) => {
        try {
            axios.post(Endpoints.CREATE_TASK, task).then(response => {
                // Mostrar una notificación de éxito
                swal.fire({
                    title: 'Tarea creada',
                    text: 'La tarea se ha creado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    background: '#161b22',
                    color: '#ffff',
                });
                cb(response);
            });
        } catch (error) {
            console.log(error);
        }
    }, // Actualizar una tarea por su ID
    updateTask: async (id, payload, cb) => {
        try {
            axios.put(Endpoints.TASK + id, payload).then(response => {
                // Mostrar una notificación de éxito y llamar a la función de devolución
                swal.fire({
                    title: 'Tarea actualizada',
                    text: 'La tarea se ha actualizado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    background: '#161b22',
                    color: '#ffff',
                }).then(() => {
                    cb();
                });
            });
        } catch (error) {
            console.log(error);
        }
    }, // Eliminar una tarea por su ID
    deleteTaskById: async (id, cb) => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            background: '#161b22',
            color: '#ffff',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(Endpoints.TASK + id).then(response => {
                    Swal.fire({
                        title: 'Tarea eliminada',
                        text: 'La tarea se ha eliminado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6',
                        background: '#161b22',
                        color: '#ffff',
                    });
                    cb();
                });
            }
        });
    }, // Eliminar tareas seleccionadas por sus IDs
    deleteSelectedTasks: async (ids, cb) => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            background: '#161b22',
            color: '#ffff',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(Endpoints.DELETE_SELECTED_TASKS, {data: {selectedTasks: ids}}).then(response => {
                    Swal.fire({
                        title: 'Tareas eliminadas',
                        text: 'Las tareas se han eliminado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6',
                        background: '#161b22',
                        color: '#ffff',
                    });
                    cb();
                });
            }
        });
    }, // Eliminar todas las tareas
    deleteAllTasks: async (cb) => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            background: '#161b22',
            color: '#ffff',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(Endpoints.DELETE_ALL_TASKS).then(response => {
                    Swal.fire({
                        title: 'Tareas eliminadas',
                        text: 'Las tareas se han eliminado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6',
                        background: '#161b22',
                        color: '#ffff',
                    });
                    cb();
                });
            }
        });
    },
}
