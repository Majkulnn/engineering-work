<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  auth: Object,
  users: Object,
})

</script>

<template>
  <Head title="Pracownicy" />

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
          <div v-if="auth.can.manageUsers">
            <Link
              :href="'/users/create'"
              as="button"
              class="rounded-md bg-emerald-500 border-black border"
            >
              Stwórz konto pracownika
            </Link>
          </div>
        </div>
        <div>
          <table class="border-2">
            <thead>
              <td>Nazwisko</td>
              <td>email</td>
              <td>rola</td>
              <td>stanowisko</td>
              <td>rodzaj zatrudnienia</td>
            </thead>
            <tr v-for="user in users">
              <td>
                {{ user.last_name }}
              </td>
              <td>
                {{ user.email }}
              </td>
              <td>
                {{ user.role }}
              </td>
              <td>
                {{ user.position }}
              </td>
              <td>
                {{ user.employment_form }}
              </td>
              <div>
                <Link
                  :href="`/users/${user.id}`"
                  method="get"
                  as="button"
                  class="bg-orange-300 rounded-md"
                >
                  &nbsp;Szczegóły&nbsp;
                </Link>
                <Link
                  :href="`/users/${user.id}`"
                  method="delete"
                  as="button"
                  class="bg-red-400 rounded-md"
                >
                  &nbsp;Usuń&nbsp;
                </Link>
              </div>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
