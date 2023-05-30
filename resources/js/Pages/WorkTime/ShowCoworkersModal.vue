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
      Współpracownicy
    </template>
    <div class="grid grid-cols-2 gap-x-6 gap-y-8 mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
      <span v-if="coworkers.length === 0">Brak Współpracwoników</span>
      <ul
        v-for="coworker in coworkers"
        class="shadow-2xl shadow-gray-300 border-2 border-sky-200"
      >
        <li>Nazwisko: {{ coworker.user }}</li>
        <li>Od: {{ coworker.start }}</li>
        <li>Do: {{ coworker.end }}</li>
      </ul>
    </div>
  </Dialog>
</template>
