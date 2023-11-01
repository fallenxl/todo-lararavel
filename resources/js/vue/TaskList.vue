<template>
  <!-- Componente del formulario modal para tareas -->
  <modal-task-form v-if="openModal" :set-open-modal="setOpenModal" :tasks="tasks"/>
  <div class="text-[#ffff]">
    <!-- Encabezado de la página -->
    <div class="w-full flex flex-col lg:flex-row items-center justify-between gap-2 my-10">
      <h3 class="text-2xl font-bold">Lista de tareas</h3>
      <!-- Botones de acción -->
      <div class="flex items-center gap-2">
        <!-- Botón para limpiar la lista de tareas -->
        <button @click="deleteAllTasks" v-if="tasks.length > 0"
                class="bg-gray-700 hover-bg-gray-800 text-white font-bold py-2 px-4 rounded">
          Limpiar lista
        </button>
        <!-- Botón para eliminar tareas seleccionadas -->
        <button @click="deleteSelectedTask" v-if="selectedTasks.length > 0"
                class="bg-gray-700 hover-bg-gray-800 text-white font-bold py-2 px-4 rounded">
          Eliminar ({{ selectedTasks.length }})
        </button>
        <!-- Botón para abrir el formulario modal de nueva tarea -->
        <button @click="setOpenModal()" class="bg-blue-500 hover-bg-blue-600 text-white font-bold py-2 px-4 rounded">
          Nueva tarea
        </button>
      </div>
    </div>
    <div class="w-full flex items-center justify-center mt-10">
      <!-- Mensaje si no hay tareas -->
      <div v-if="isTasksEmpty" class="w-full flex items-center justify-center gap-1">
        <small class="text-sm text-[#b8bbbf]">No hay tareas</small>
        <span @click="setOpenModal" class="text-sm text-[#b8bbbf] underline cursor-pointer hover:text-gray-100"> Crea una nueva tarea</span>
      </div>
      <!-- Mensaje de selección de tareas -->
      <div v-else class="w-full flex items-center justify-center gap-1">
        <small class="text-sm mb-5 text-gray-300">Presiona una tarea para seleccionarla</small>
      </div>
    </div>
    <!-- Lista de tareas -->
    <ul class="w-full flex flex-col gap-4">
      <!-- Componente de esqueleto para cada tarea en la lista -->
      <tasks-skeleton v-if="isLoading"/>
      <!-- Componente de tarea para cada tarea en la lista -->
      <task v-for="task in tasks" :key="task.id" :task="task" :isSelected="isTaskSelected"
            :handleSelected="handleSelectedTask" :toggleStatus="toggleTaskCompleted" :deleteTask="deleteTaskById"/>
    </ul>
  </div>
</template>

<script>
import Task from "./components/Task.vue";
import ModalTaskForm from "./ModalTaskForm.vue";
import {TaskServices} from "./services/taskServices.js";
import TasksSkeleton from "./components/TasksSkeleton.vue";

export default {
  components: {
    Task,
    ModalTaskForm,
    TasksSkeleton
  },
  data() {
    return {
      // Datos iniciales
      tasks: [],
      isTasksEmpty: false,
      openModal: false,
      selectedTasks: [],
      isLoading: false
    }
  },
  mounted() {
    this.isLoading = true
    // Cargar tareas al montar el componente
    TaskServices.getAllTasks().then(response => {
      this.isLoading = false
      this.tasks = response.data
    })
  },
  methods: {
    // Eliminar una tarea por su ID
    async deleteTaskById(id) {
      await TaskServices.deleteTaskById(id, () => {
        this.tasks = this.tasks.filter(task => task.id !== id)
      })

    },
    // Eliminar tareas seleccionadas
    async deleteSelectedTask() {
      await TaskServices.deleteSelectedTasks(this.selectedTasks, () => {
        this.tasks = this.tasks.filter(task => !this.selectedTasks.includes(task.id))
        this
        selectedTasks = []
      })
    },
    // Eliminar todas las tareas
    async deleteAllTasks() {
      await TaskServices.deleteAllTasks(() => {
        this.tasks = []
        this.isTasksEmpty = true
      })
    },
    // Cambiar el estado de una tarea (completada/no completada)
    async toggleTaskCompleted(id) {

      const payload = {
        task: {
          completed: !this.tasks.find(task => task.id === id).completed
        }
      }

      await TaskServices.updateTask(id, payload, () => {
        this.tasks = this.tasks.map(task => {
          if (task.id === id) {
            task.completed = !task.completed
          }
          return task
        })
      })
    },
    // Abrir o cerrar el modal de nueva tarea
    setOpenModal() {
      this.openModal = !this.openModal
    },
    // Manejar la selección de una tarea
    handleSelectedTask(task) {
      if (this.selectedTasks.find(selectedTask => selectedTask === task.id)) {
        this.selectedTasks = this.selectedTasks.filter(selectedTask => selectedTask !== task.id)
      } else {
        this.selectedTasks.push(task.id)
      }
    },
    // Verificar si una tarea está seleccionada
    isTaskSelected(task) {
      return this.selectedTasks.find(selectedTask => selectedTask === task.id)
    }
  },
  watch: {
    // Observar cambios en la lista de tareas y actualizar el estado "isTasksEmpty"
    tasks: {
      handler() {
        this.isTasksEmpty = this.tasks.length === 0
      },
      deep: true
    }
  }
}
</script>
