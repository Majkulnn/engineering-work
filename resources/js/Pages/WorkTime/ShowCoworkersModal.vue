<script setup>
import Dialog from '@/Components/Dialog.vue'
defineProps({
  auth: Object,
  coworkers: Object,
})
</script>

<template>
  <Dialog>
    <template #title>
      workTime
    </template>
    <div class="grid grid-cols-2 gap-x-6 gap-y-8 mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
      <ul v-for="coworker in coworkers">
        <li>{{ coworker.user }}</li>
        <li>{{ coworker.start }}</li>
        <li>{{ coworker.end }}</li>
      </ul>
    </div>
  </Dialog>
</template>
