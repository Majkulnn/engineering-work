<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import ManagerLayout from '@/Layouts/ManagerLayout.vue'

</script>

<template>
  <Head title="Dashboard" />

  <ManagerLayout>
    <div class="max-width-7xl mx-auto py-4">
      <div class="flex justify-between" />
      <div class="mt-6 max-w-6xl mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl p-4 font-semibold">
          Welcome Manager
        </h1>
      </div>
    </div>
  </ManagerLayout>
</template>
