<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

const passwordInput = ref(null)
const currentPasswordInput = ref(null)

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const updatePassword = () => {
  form.put('/profile/password', {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value.focus()
      }
      if (form.errors.current_password) {
        form.reset('current_password')
        currentPasswordInput.value.focus()
      }
    },
  })
}
</script>

<template>
  <Head title="Forgot Password" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <header>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Update Password
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ensure your account is using a long, random password to stay secure.
          </p>
        </header>
        <div class="p-12 mx-auto rounded-3xl w-2/6">
          <form
            class="mt-6 space-y-6"
            @submit.prevent="updatePassword"
          >
            <div>
              <InputLabel
                for="current_password"
                value="Current Password"
              />

              <TextInput
                id="current_password"
                ref="currentPasswordInput"
                v-model="form.current_password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password"
              />

              <InputError
                :message="form.errors.current_password"
                class="mt-2"
              />
            </div>

            <div>
              <InputLabel
                for="password"
                value="New Password"
              />

              <TextInput
                id="password"
                ref="passwordInput"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
              />

              <InputError
                :message="form.errors.password"
                class="mt-2"
              />
            </div>

            <div>
              <InputLabel
                for="password_confirmation"
                value="Confirm Password"
              />

              <TextInput
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
              />

              <InputError
                :message="form.errors.password_confirmation"
                class="mt-2"
              />
            </div>

            <div class="flex items-center gap-4">
              <PrimaryButton :disabled="form.processing">
                Save
              </PrimaryButton>

              <Transition
                enter-from-class="opacity-0"
                leave-to-class="opacity-0"
                class="transition ease-in-out"
              >
                <p
                  v-if="form.recentlySuccessful"
                  class="text-sm text-gray-600 dark:text-gray-400"
                >
                  Saved.
                </p>
              </Transition>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
