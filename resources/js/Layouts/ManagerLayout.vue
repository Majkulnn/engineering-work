<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'

</script>

<template>
  <div
    class="relative min-h-screen bg-gray-200"
  >
    <div class="bg-orange-300 min-w-screen">
      <Link
        :href="'/login'"
      >
        Holiday
      </Link>
      <Link :href="'/login'">
        Work Calendar
      </Link>
      <Link
        method="POST"
        class=""
        :href="'/logout'"
      >
        LogOut
      </Link>
    </div>
    <div class="container">
      <slot />
    </div>
  </div>
</template>
