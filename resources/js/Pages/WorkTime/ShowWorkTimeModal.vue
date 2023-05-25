<script setup>
import TextInput from '@/Components/TextInput.vue'
import Dialog from '@/Components/Dialog.vue'
import { Link } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
defineProps({
  auth: Object,
  workTime: Object,
})
</script>

<template>
  <Dialog>
    <div class="grid grid-cols-2 gap-x-6 gap-y-8 mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
      <div>
        <InputLabel value="Nazwisko" />
        <TextInput
          v-model="workTime.user"
          readonly="readonly"
          label="First name"
        />
      </div>
      <div>
        <InputLabel value="Od" />
        <TextInput
          v-model="workTime.start"
          readonly="readonly"
          label="First name"
        />
      </div>
      <div>
        <InputLabel value="Do" />
        <TextInput
          v-model="workTime.end"
          readonly="readonly"
          label="First name"
        />
      </div>
      <div>
        <InputLabel value="Liczba godzin" />
        <TextInput
          v-model="workTime.hour_count"
          readonly="readonly"
          label="Last name"
        />
      </div>
      <div>
        <InputLabel value="Stanowisko" />
        <TextInput
          v-model="workTime.position"
          readonly="readonly"
          label="Last name"
        />
      </div>

      <Link
        :href="`/workTime/${workTime.id}`"
        as="button"
        class="bg-red-400 rounded-md"
        method="delete"
      >
        &nbsp;Usuń&nbsp;
      </Link>
    </div>
    <template #title>
      Czas Pracy
    </template>
  </Dialog>
</template>
