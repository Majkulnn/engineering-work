<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'

defineProps({
  auth: Object,
  user: Object,
})

</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :auth="auth">
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div>
          <div>
            <Link
              :href="'/dashboard'"
              as="button"
              class="rounded-md bg-emerald-500 border-black border"
            >
              Powrót
            </Link>
          </div>
        </div>
        <div>
          Profil Pracownika
          <div class="max-w-2xl mx-auto">
            <InputLabel value="Imię" />
            <TextInput
              id="first_name"
              v-model="user.first_name"
              type="string"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div class="max-w-2xl mx-auto">
            <InputLabel value="Nazwisko" />
            <TextInput
              id="last_name"
              v-model="user.last_name"
              type="string"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div class="max-w-2xl mx-auto">
            <InputLabel value="Email" />
            <TextInput
              id="email"
              v-model="user.email"
              type="email"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div
            v-if="auth.can.manageUsersRoles"
            class="max-w-2xl mx-auto"
          >
            <InputLabel value="Role" />
            <TextInput
              id="role"
              v-model="user.role"
              type="string"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div class="max-w-2xl mx-auto">
            <InputLabel value="Stanowisko" />
            <TextInput
              id="position"
              v-model="user.position"
              type="posstringition"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div class="max-w-2xl mx-auto">
            <InputLabel value="Froma zatrudnienia" />
            <TextInput
              id="employment_form"
              v-model="user.employment_form"
              type="string"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div class="max-w-2xl mx-auto">
            <InputLabel value="Data zatrudnienia" />
            <TextInput
              id="employment_date"
              v-model="user.employment_date"
              type="datetime"
              class="mx-auto text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
              readonly
            />
          </div>
          <div>
            <Link
              as="button"
              class="rounded bg-orange-300"
              method="get"
              :href="`/users/${user.id}/edit`"
            >
              &nbsp;
              Edytuj
              &nbsp;
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
