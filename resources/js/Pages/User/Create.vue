<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
  auth: Object,
  employment_forms: Object,
})

const form = useForm({
  email: '',
  first_name: '',
  last_name: '',
  position: '',
  employment_form: '',
  employment_date: '',
})

</script>

<template>
  <Head title="Dashboard" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div>
          Crate USer
          <form
            class="max-w-2xl mx-auto"
            method="post"
            @submit.prevent="form.post('/users')"
          >
            <div class="">
              <InputLabel
                for="email"
                value="Email"
              />

              <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                placeholder="Email"
                required
                autofocus
                autocomplete="email"
              />

              <InputError
                class="mt-2"
                :message="form.errors.email"
              />
            </div>
            <div class="">
              <InputLabel
                for="first_name"
                value="First Name"
              />

              <TextInput
                id="first_name"
                v-model="form.first_name"
                type="text"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                placeholder="First Name"
                required
                autocomplete="first_name"
              />

              <InputError
                class="mt-2"
                :message="form.errors.first_name"
              />
            </div>
            <div class="">
              <InputLabel
                for="last_name"
                value="Last Name"
              />

              <TextInput
                id="last_name"
                v-model="form.last_name"
                type="text"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                placeholder="Last Name"
                required
                autocomplete="last_name"
              />

              <InputError
                class="mt-2"
                :message="form.errors.last_name"
              />
            </div>
            <div class="">
              <InputLabel
                for="position"
                value="Position"
              />

              <TextInput
                id="position"
                v-model="form.position"
                type="text"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                placeholder="Position"
                required
                autocomplete="position"
              />

              <InputError
                class="mt-2"
                :message="form.errors.position"
              />
            </div>
            <div class="">
              <InputLabel
                for="employment_form"
                value="Employment Form"
              />

              <select
                id="employment_form"
                v-model="form.employment_form"
                type="text"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                required
              >
                <option v-for="employmentForm in employment_forms">
                  {{ employmentForm.value }}
                </option>
              </select>

              <InputError
                class="mt-2"
                :message="form.errors.employment_form"
              />
            </div>
            <div class="">
              <InputLabel
                for="employment_date"
                value="Employment Date"
              />

              <TextInput
                id="employment_date"
                v-model="form.employment_date"
                type="date"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                autocomplete="employment_date"
              />

              <InputError
                class="mt-2"
                :message="form.errors.employment_date"
              />
            </div>
            <div>
              <PrimaryButton href="'/users/store'">
                Create
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
