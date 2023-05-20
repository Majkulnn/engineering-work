<script setup>
import TextInput from '@/Components/TextInput.vue'
import Dialog from '@/Components/Dialog.vue'
import { Link } from '@inertiajs/vue3'
defineProps({
  auth: Object,
  workTime: Object,
})
</script>

<template>
  <Dialog>
    <template #title>
      workTime
    </template>
    <div class="grid grid-cols-2 gap-x-6 gap-y-8 mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
      <TextInput
        v-model="workTime.user"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="workTime.start"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="workTime.end"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="workTime.hour_count"
        readonly="readonly"
        label="Last name"
      />
      <TextInput
        v-model="workTime.position"
        readonly="readonly"
        label="Last name"
      />
      <Link
        :href="`/workTime/${workTime.id}`"
        as="button"
        class="bg-red-400 rounded-md"
        method="delete"
      >
        &nbsp;Delete&nbsp;
      </Link>
    </div>
  </Dialog>
</template>
