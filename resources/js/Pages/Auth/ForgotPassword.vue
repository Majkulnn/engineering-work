<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post('/forgot-password')
}
</script>

<template>
  <Head title="Forgot Password" />

  <div
    class="relative min-h-screen flex justify-center items-center bg-gray-200"
  >
    <div class="p-12 mx-auto rounded-3xl w-96 bg-gradient-to-b from-sky-300 to-white to-25% ">
      <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset
        link that will allow you to choose a new one.
      </div>

      <div
        v-if="status"
        class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
      >
        {{ status }}
      </div>
      <form @submit.prevent="submit">
        <div>
          <InputLabel
            for="email"
            value="Email"
          />

          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="username"
          />

          <InputError
            class="mt-2"
            :message="form.errors.email"
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Email Password Reset Link
          </PrimaryButton>
        </div>
      </form>
    </div>
  </div>
</template>
