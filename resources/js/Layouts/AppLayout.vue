<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'

defineProps({
  auth: Object,
})

</script>

<template>
  <div
    class="relative min-h-screen bg-gray-200"
  >
    <div class="bg-sky-300 w-10/12 mx-auto">
      <Link
        method="POST"
        as="button"
        class=""
        :href="'/logout'"
      >
        LogOut
      </Link>
    </div>
    <div class="px-6 2xl:container mx-auto">
      <slot />
    </div>
  </div>
</template>
