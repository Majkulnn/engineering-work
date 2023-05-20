<script setup>
import TextInput from '@/Components/TextInput.vue'
import Dialog from '@/Components/Dialog.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  auth: Object,
  holidayRequest: Object,
})
</script>

<template>
  <Dialog>
    <template #title>
      Holiday Request
    </template>
    <div class="grid grid-cols-2 gap-x-6 gap-y-8 mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
      <TextInput
        v-model="holidayRequest.creator"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="holidayRequest.type"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="holidayRequest.start_date"
        readonly="readonly"
        label="First name"
      />
      <TextInput
        v-model="holidayRequest.end_date"
        readonly="readonly"
        label="Last name"
      />
      <TextInput
        v-model="holidayRequest.status"
        readonly="readonly"
        label="Last name"
      />
      <TextInput
        v-model="holidayRequest.reason"
        readonly="readonly"
        label="Last name"
      />
      <div v-if="holidayRequest.status === 'PENDING'">
        <Link
          :href="`/holiday/request/${holidayRequest.id}/accept`"
          method="put"
          as="button"
          class="bg-orange-300 rounded-md"
        >
          &nbsp;Accept&nbsp;
        </Link>
        <Link
          :href="`/holiday/request/${holidayRequest.id}/reject`"
          method="put"
          as="button"
          class="bg-red-400 rounded-md"
        >
          &nbsp;Reject&nbsp;
        </Link>
      </div>
    </div>
  </Dialog>
</template>
