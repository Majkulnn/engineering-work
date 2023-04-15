<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import EmployeeLayout from '@/Layouts/EmployeeLayout.vue'

</script>

<template>
  <Head title="Dashboard" />

  <EmployeeLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl p-4 font-semibold">
          Welcome employee
        </h1>
      </div>
    </div>
  </EmployeeLayout>
</template>
