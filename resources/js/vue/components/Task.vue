<template>
  <!-- Elemento de lista de tarea -->
  <li :class="{'line-through opacity-40': task.completed, 'bg-gray-700 opacity-100': isSelected(task)}"
      class="bg-[#161b22] rounded-lg p-4 ">
    <div class="flex items-center justify-between">
      <div class="flex items-center flex-grow gap-4">
        <!-- Componente de casilla de verificación para el estado de la tarea -->
        <checkbox @click="toggleStatus(task.id)" :value="task.completed"/>
        <div @click="handleSelected(task)" class="flex flex-col flex-grow gap-2 cursor-pointer">
          <!-- Título de la tarea -->
          <h4 class="text-lg font-bold">{{ task.title }}</h4>
          <!-- Descripción de la tarea -->
          <small class="text-xs text-[#b8bbbf]">({{ task.description }})</small>
        </div>
      </div>
      <!-- Botón para eliminar la tarea -->
      <button @click="deleteTask(task.id)" class=" text-white font-bold py-2 px-4 rounded ml-2">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-6 h-6 fill-red-500 hover:fill-red-700"
             viewBox="0 0 48 48">
          <path
              d="M 24 4 C 20.491685 4 17.570396 6.6214322 17.080078 10 L 10.238281 10 A 1.50015 1.50015 0 0 0 9.9804688 9.9785156 A 1.50015 1.50015 0 0 0 9.7578125 10 L 6.5 10 A 1.50015 1.50015 0 1 0 6.5 13 L 8.6386719 13 L 11.15625 39.029297 C 11.427329 41.835926 13.811782 44 16.630859 44 L 31.367188 44 C 34.186411 44 36.570826 41.836168 36.841797 39.029297 L 39.361328 13 L 41.5 13 A 1.50015 1.50015 0 1 0 41.5 10 L 38.244141 10 A 1.50015 1.50015 0 0 0 37.763672 10 L 30.919922 10 C 30.429604 6.6214322 27.508315 4 24 4 z M 24 7 C 25.879156 7 27.420767 8.2681608 27.861328 10 L 20.138672 10 C 20.579233 8.2681608 22.120844 7 24 7 z M 11.650391 13 L 36.347656 13 L 33.855469 38.740234 C 33.730439 40.035363 32.667963 41 31.367188 41 L 16.630859 41 C 15.331937 41 14.267499 40.033606 14.142578 38.740234 L 11.650391 13 z M 20.476562 17.978516 A 1.50015 1.50015 0 0 0 19 19.5 L 19 34.5 A 1.50015 1.50015 0 1 0 22 34.5 L 22 19.5 A 1.50015 1.50015 0 0 0 20.476562 17.978516 z M 27.476562 17.978516 A 1.50015 1.50015 0 0 0 26 19.5 L 26 34.5 A 1.50015 1.50015 0 1 0 29 34.5 L 29 19.5 A 1.50015 1.50015 0 0 0 27.476562 17.978516 z"></path>
        </svg>
      </button>
    </div>
  </li>
</template>

<script>
import Checkbox from "./Checkbox.vue";

export default {
  components: {
    Checkbox
  },
  props: {
    // Propiedad de la tarea actual
    task: {
      type: Object,
      required: true
    },
    // Función para eliminar la tarea
    deleteTask: {
      type: Function,
      required: true
    },
    // Función para cambiar el estado de la tarea
    toggleStatus: {
      type: Function,
      required: true
    },
    // Función para manejar la selección de la tarea
    handleSelected: {
      type: Function,
      required: true
    },
    // Función para comprobar si la tarea está seleccionada
    isSelected: {
      type: Function,
      required: true
    }
  }
}
</script>
