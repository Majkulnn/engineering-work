<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
  auth: Object,
})

const form = useForm({
  date: '',
  from: '',
  to: '',
})

</script>

<template>
  <Head title="Work Request" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div>
          Crate Request
          <form
            class="max-w-2xl mx-auto"
            method="post"
            @submit.prevent="form.post('/work/request')"
          >
            <div class="">
              <InputLabel
                for="date"
                value="Date"
              />

              <TextInput
                id="date"
                v-model="form.date"
                type="date"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                required
                autofocus
                autocomplete="date"
              />

              <InputError
                class="mt-2"
                :message="form.errors.date"
              />
            </div>
            <div class="">
              <InputLabel
                for="from"
                value="From"
              />

              <TextInput
                id="from"
                v-model="form.from"
                type="time"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                required
                autocomplete="from"
              />

              <InputError
                class="mt-2"
                :message="form.errors.from"
              />
            </div>
            <div class="">
              <InputLabel
                for="to"
                value="To"
              />

              <TextInput
                id="to"
                v-model="form.to"
                type="time"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                required
                autocomplete="to"
              />

              <InputError
                class="mt-2"
                :message="form.errors.to"
              />
            </div>
            <div>
              <PrimaryButton>
                Create
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
