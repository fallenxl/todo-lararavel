<template>
  <li v-for="index in count" :key="index" class="py-4 px-6 bg-gray-700 rounded shadow animate-pulse duration-300">
    <div class="flex items-center justify-between">
      <div class="flex items-center flex-grow gap-4">
        <div  class="flex flex-col flex-grow gap-2 cursor-pointer">
          <div class="h-4 bg-gray-600 rounded w-1/2"></div>
          <div class="h-4 bg-gray-600 rounded w-1/4"></div>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <div class="h-4 bg-gray-600 rounded w-1/4 animate-pulse"></div>
        <div class="h-4 bg-gray-600 rounded w-1/4"></div>
      </div>
    </div>
  </li>
</template>

<script>
import Checkbox from "@/vue/components/Checkbox.vue";

export default {
  components: {Checkbox},
  props: {
    count: {
      type: Number,
      default: 5
    }
  }
}
</script>