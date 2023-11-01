<template>
    <add-task-form v-if="openModal" :set-open-modal="setOpenModal" :tasks="tasks" />
    <div class="text-[#ffff]">
        <div class="w-full flex flex-col lg:flex-row items-center justify-between gap-2 my-10">
            <h3 class="text-2xl font-bold">Lista de tareas</h3>
            <div class="flex items-center gap-2">
                <button @click="deleteAllTasks" v-if="tasks.length > 0" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    Limpiar lista
                </button>
                <button @click="deleteSelectedTask" v-if="selectedTasks.length > 0" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    Eliminar ({{ selectedTasks.length }})
                </button>
                <button @click="setOpenModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Nueva tarea
                </button>
            </div>
        </div>
        <div v-if="isTasksEmpty" class="w-full flex items-center justify-center mt-10">
            <div class="w-full flex items-center justify-center gap-1">
                <small class="text-sm text-[#b8bbbf]">No hay tareas</small>
                <span @click="setOpenModal" class="text-sm text-[#b8bbbf] underline cursor-pointer hover:text-gray-100"> Crea una nueva tarea</span>
            </div>
        </div>
        <ul class="w-full flex flex-col gap-4">
            <task v-for="task in tasks" :key="task.id"  :task="task" :isSelected="isTaskSelected" :handleSelected="handleSelectedTask" :toggleStatus="toggleTaskCompleted" :deleteTask="deleteTaskById"/>
        </ul>
    </div>
</template>

<script>
import Task from "./components/Task.vue";
import axios from "axios";
import AddTaskForm from "./AddTaskForm.vue";
import {TaskServices} from "./services/taskServices.js";

export default {
    components: {
        Task,
        AddTaskForm
    },
    data() {
        return {
            tasks: [],
            isTasksEmpty: false,
            openModal: false,
            selectedTasks: []
        }
    },
    mounted() {
        TaskServices.getAllTasks().then(response => {
            this.tasks = response.data
        })
    },
    methods: {
        async deleteTaskById(id) {
            await TaskServices.deleteTaskById(id, () => {
                this.tasks = this.tasks.filter(task => task.id !== id)
            })

        },
        async deleteSelectedTask(){
            await TaskServices.deleteSelectedTasks(this.selectedTasks, () => {
                this.tasks = this.tasks.filter(task => !this.selectedTasks.includes(task.id))
                this.selectedTasks = []
            })
        },
        async deleteAllTasks(){
        await TaskServices.deleteAllTasks(() => {
                this.tasks = []
                this.isTasksEmpty = true
            })
        },
        async toggleTaskCompleted(id) {

            const payload = {task: {
                completed: !this.tasks.find(task => task.id === id).completed
                }}

            await TaskServices.updateTask(id, payload, () => {
                this.tasks = this.tasks.map(task => {
                    if(task.id === id) {
                        task.completed = !task.completed
                    }
                    return task
                })
            })
        },
        setOpenModal() {
            this.openModal = !this.openModal
        },
        handleSelectedTask(task) {
            if(this.selectedTasks.find(selectedTask => selectedTask === task.id)) {
                this.selectedTasks = this.selectedTasks.filter(selectedTask => selectedTask !== task.id)
            } else {
                this.selectedTasks.push(task.id)
            }
        },
        isTaskSelected(task) {
            return this.selectedTasks.find(selectedTask => selectedTask === task.id)
        }
    },
    watch: {
        tasks: {
            handler() {
                this.isTasksEmpty = this.tasks.length === 0


            },
            deep: true
        }
    }
}
</script>
