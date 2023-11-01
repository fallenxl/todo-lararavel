<template>
  <!-- Contenedor principal de la aplicación -->
  <div class="mx-auto">
    <!-- Barra de navegación de la aplicación -->
    <navbar/>
    <!-- Contenedor principal de contenido de la aplicación -->
    <main class="mx-auto w-full p-1 md:w-3/4 relative">
      <!-- Vista de lista de tareas -->
      <list-view/>
    </main>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import ListView from "./TaskList.vue";
export default {
  components: {
    // Componentes utilizados en la vista principal
    Navbar,   // Barra de navegación
    ListView  // Vista de lista de tareas
  }
}
</script>
