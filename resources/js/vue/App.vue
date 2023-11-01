<template>
    <div class="mx-auto">
        <navbar/>
        <main class="mx-auto w-full p-1 md:w-3/4 relative">
            <list-view/>
        </main>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import ListView from "./TaskList.vue";
export default {
    components: {
        Navbar,
        ListView
    }
}
</script>
