<script setup>
import TextInput from '@/Components/TextInput.vue'
import Dialog from '@/Components/Dialog.vue'

defineProps({
  auth: Object,
  holiday: Object,
})
</script>

<template>
  <Dialog>
    <template #title>
      Urlop
    </template>
    <div class="grid grid-cols-2 gap-x-6 gap-y-8 mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
      <TextInput
        v-model="holiday.user"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="holiday.type"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="holiday.start_date"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="holiday.end_date"
        readonly="readonly"
        label="Last name"
      />
      <TextInput
        v-model="holiday.days"
        readonly="readonly"
        label="Last name"
      />
      <TextInput
        v-model="holiday.reason"
        readonly="readonly"
        label="Last name"
      />
    </div>
  </Dialog>
</template>
