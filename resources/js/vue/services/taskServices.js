import axios from "axios";
import {Endpoints} from "@/vue/constants/Endpoints.js";

export const TaskServices = {
    getAllTasks: async () => {
        try {
            return  await axios.get(Endpoints.ALL_TASKS);
        }catch (error){
            console.log(error);
        }
    },
    createTask: async (task, cb) => {
        try {
            axios.post(Endpoints.CREATE_TASK, task).then(response => {
                swal.fire({
                    title: 'Tarea creada',
                    text: 'La tarea se ha creado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    background: '#161b22',
                    color: '#ffff',
                });
                cb(response)
            })
        }catch (error){
            console.log(error);
        }
    },
    updateTask: async (id, payload, cb) => {
        try {
            axios.put(`http://localhost:8000/api/task/${id}`, payload).then(response => {
                swal.fire({
                    title: 'Tarea actualizada',
                    text: 'La tarea se ha actualizado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    background: '#161b22',
                    color: '#ffff',
                }).then(() => {
                    cb()
                })
            })
        }catch (error){
            console.log(error);
        }
    },
    deleteTaskById: async (id, cb) => {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "No podras revertir esta accion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            background: '#161b22',
            color: '#ffff',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`http://localhost:8000/api/task/${id}`).then(response => {
                    Swal.fire(
                        {
                            title: 'Tarea eliminada',
                            text: 'La tarea se ha eliminado correctamente',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#3085d6',
                            background: '#161b22',
                            color: '#ffff',
                        }
                    );
                    cb()
                })
            }
        }
        )
    },
    deleteSelectedTasks: async (ids, cb) => {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "No podras revertir esta accion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            background: '#161b22',
            color: '#ffff',
        }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(Endpoints.DELETE_SELECTED_TASKS, {data: {selectedTasks: ids}}).then(response => {
                        Swal.fire(
                            {
                                title: 'Tareas eliminadas',
                                text: 'Las tareas se han eliminado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Aceptar',
                                confirmButtonColor: '#3085d6',
                                background: '#161b22',
                                color: '#ffff',
                            }
                        );
                        cb()
                    })
                }
            }
        )
    },
    deleteAllTasks: async (cb) => {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "No podras revertir esta accion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            background: '#161b22',
            color: '#ffff',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete("http://localhost:8000/api/tasks/all").then(response => {
                    Swal.fire(
                        {
                            title: 'Tareas eliminadas',
                            text: 'Las tareas se han eliminado correctamente',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#3085d6',
                            background: '#161b22',
                            color: '#ffff',
                        }
                    )
                    cb()
                })
            }
        })
    },
}
