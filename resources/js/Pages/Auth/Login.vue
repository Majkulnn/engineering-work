<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}

</script>

<template>
  <Head title="Logowanie" />

  <GuestLayout
    class="relative min-h-screen flex justify-center items-center bg-gray-200"
  >
    <div class="p-12 mx-auto rounded-3xl w-96 bg-gradient-to-b from-sky-300 to-white to-25% ">
      <div
        v-if="status"
        class="mb-4 font-medium text-md text-green-600"
      >
        {{ status }}
      </div>
      <form @submit.prevent="submit">
        <div class="mb-7">
          <h3 class="font-semibold text-2xl text-gray-800">
            Logowanie
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
              class="w-full text-sm  px-4 py-3 bg-white focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-sky-400"
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
              value="Hasło"
            />
            <TextInput
              id="password"
              v-model="form.password"
              type="password"
              class="w-full text-sm  px-4 py-3 bg-white focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-sky-400"
              placeholder="Password"
              required
              autocomplete="password"
            />
            <InputError
              class="mt-2"
              :message="form.errors.password"
            />
          </div>

          <div class="block mt-4">
            <label class="flex items-center">
              <Checkbox
                v-model:checked="form.remember"
                name="remember"
              />
              <span class="ml-2 text-sm text-gray-600">Zapamiętaj mnie</span>
            </label>
          </div>

          <div class="flex items-center justify-end mt-4">
            <Link
              v-if="canResetPassword"
              :href="'/forgot-password'"
              class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Zapomniałeś hasła?
            </Link>
          </div>
          <div>
            <button
              type="submit"
              class="w-full flex justify-center bg-sky-700 text-white p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500"
            >
              Zaloguj
            </button>
          </div>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
