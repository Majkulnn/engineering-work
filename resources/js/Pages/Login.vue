<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

</script>

<template>
  <Head title="Welcome" />

  <div
    class="relative min-h-screen flex justify-center items-center bg-gray-200"
  >
    <div class="p-12 mx-auto rounded-3xl w-96 bg-gradient-to-b from-sky-300 to-white to-25% ">
      <form @submit.prevent="form.post('/login')">
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

          <div
            class=""
          >
            <InputLabel
              for="password"
              value="Password"
            />
            <TextInput
              id="password"
              v-model="form.password"
              type="password"
              class="text-sm px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400"
              placeholder="Password"
              required
              autocomplete="password"
            />
            <InputError
              class="mt-2"
              :message="form.errors.password"
            />
          </div>

          <div class="flex items-center justify-between">
            <div class="text-sm ml-auto">
              <Link
                href="#"
                class="text-purple-700 hover:text-purple-600"
              >
                Forgot your password?
              </Link>
            </div>
          </div>
          <div>
            <button
              type="submit"
              class="w-full flex justify-center bg-sky-800 text-white p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500"
            >
              Sign in
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
