<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

defineProps({
  auth: Object,
  user: Object,
  roles: Object,
  employmentForms: Object,
})

const form = useForm(usePage().props.user)

</script>

<template>
  <Head title="Dashboard" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div>
          User Profile
          <form
            class="max-w-2xl mx-auto"
            method="put"
            @submit.prevent="form.put(`/users/${user.id}`)"
          >
            <div class="max-w-2xl mx-auto">
              <InputLabel value="First Name" />
              <TextInput
                id="first_name"
                v-model="form.first_name"
                type="string"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                autofocus
              />
              <InputError
                class="mt-2"
                :message="form.errors.first_name"
              />
            </div>
            <div class="max-w-2xl mx-auto">
              <InputLabel value="Last Name" />
              <TextInput
                id="last_name"
                v-model="form.last_name"
                type="string"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              />
              <InputError
                class="mt-2"
                :message="form.errors.last_name"
              />
            </div>
            <div class="max-w-2xl mx-auto">
              <InputLabel value="Email" />
              <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              />
              <InputError
                class="mt-2"
                :message="form.errors.email"
              />
            </div>
            <div
              v-if="auth.can.manageUsersRoles"
              class="max-w-2xl mx-auto"
            >
              <InputLabel value="Role" />
              <select
                id="role"
                v-model="form.role"
                type="string"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              >
                <option v-for="role in roles">
                  {{ role.value }}
                </option>
              </select>
              <InputError
                class="mt-2"
                :message="form.errors.role"
              />
            </div>
            <div class="max-w-2xl mx-auto">
              <InputLabel value="Position" />
              <TextInput
                id="position"
                v-model="form.position"
                type="posstringition"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              />
              <InputError
                class="mt-2"
                :message="form.errors.position"
              />
            </div>
            <div class="max-w-2xl mx-auto">
              <InputLabel value="Employment Form" />
              <select
                id="employment_form"
                v-model="form.employment_form"
                type="select"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              >
                <option v-for="employmentForm in employmentForms">
                  {{ employmentForm.value }}
                </option>
              </select>
              <InputError
                class="mt-2"
                :message="form.errors.employment_form"
              />
            </div>
            <div class="max-w-2xl mx-auto">
              <InputLabel value="Employment Date" />
              <TextInput
                id="employment_date"
                v-model="form.employment_date"
                type="date"
                class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              />
              <InputError
                class="mt-2"
                :message="form.errors.employment_date"
              />
            </div>
            <PrimaryButton>
              Update
            </PrimaryButton>
          </form>
          <div />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
