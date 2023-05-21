<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import Checkbox from '@/Components/Checkbox.vue'

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
})

const form = useForm({
  email: props.email,
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post('/newLogin', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}

</script>

<template>
  <Head title="Create Password" />

  <div
    class="relative min-h-screen flex justify-center items-center bg-gray-200"
  >
    <div class="p-12 mx-auto rounded-3xl w-96 bg-gradient-to-b from-sky-300 to-white to-25% ">
      <form @submit.prevent="submit">
        <div class="mb-7">
          <h3 class="font-semibold text-2xl text-gray-800">
            Sign In
          </h3>
        </div>
        <div class="space-y-6">
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

          <div class="mt-4">
            <InputLabel
              for="password"
              value="Password"
            />

            <TextInput
              id="password"
              v-model="form.password"
              type="password"
              class="mt-1 block w-full"
              required
              autocomplete="new-password"
            />

            <InputError
              class="mt-2"
              :message="form.errors.password"
            />
          </div>

          <div class="mt-4">
            <InputLabel
              for="password_confirmation"
              value="Confirm Password"
            />

            <TextInput
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              class="mt-1 block w-full"
              required
              autocomplete="new-password"
            />

            <InputError
              class="mt-2"
              :message="form.errors.password_confirmation"
            />
          </div>
          <div>
            <button
              type="submit"
              class="w-full flex justify-center bg-sky-800 text-white p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500"
            >
              Create Password
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
