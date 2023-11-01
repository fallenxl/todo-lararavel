
<template>
<!--modal-->
    <div class="fixed flex items-center justify-center z-10 top-0 left-0 w-full h-screen bg-[rgba(0,0,0,0.8)] p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="bg-[#161b22] w-full md:w-3/4 lg:w-3/6 xl:w-2/6 flex flex-col px-10 py-8 rounded-md gap-4">
            <div class="border-b p-2">
                <h3 class="text-2xl font-bold text-white">Nueva tarea</h3>
            </div>
            <form @submit="createTask">
                <input  type="text" placeholder="Titulo" class="w-full bg-transparent text-white border rounded-lg p-4 mb-4" v-model="formData.title" required/>
                <textarea placeholder="Descripcion"  class="w-full bg-transparent text-white border rounded-lg p-4 mb-4 resize-none" v-model="formData.description"></textarea>
                <div class="flex flex-grow justify-end items-center gap-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                    <button @click="setOpenModal" class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {TaskServices} from "./services/taskServices.js";

export default {
    props: {
        setOpenModal: {
            type: Function,
            required: true
        },
        tasks: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            formData: {
                title: '',
                description: ''
            }
        }
    },
    methods: {
        async createTask(e) {
            e.preventDefault()
            const payload = {task: this.formData}
            await TaskServices.createTask(payload, (response) => {
                this.tasks.push(response.data)
                this.setOpenModal()
            })
        },
    },

}
</script>
