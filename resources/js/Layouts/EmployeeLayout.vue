<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'

</script>

<template>
  <div
    class="relative min-h-screen bg-gray-200"
  >
    <div class="bg-sky-300 min-w-screen">
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
        as="button"
        class=""
        :href="'/logout'"
      >
        LogOut
      </Link>
    </div>
    <div class="px-6 2xl:container">
      <slot />
    </div>
  </div>
</template>
