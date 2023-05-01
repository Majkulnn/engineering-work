<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import DangerButton from '@/Components/DangerButton.vue'

defineProps({
  auth: Object,
  users: Object,
})

</script>

<template>
  <Head title="Dashboard" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div>
          <div v-if="auth.can.manageUsers">
            <Link
              :href="'/users/create'"
              as="button"
              class="rounded-md bg-emerald-500 border-black border"
            >
              Create Employee
            </Link>
          </div>
        </div>
        <div>
          <table class="border-2">
            <tr v-for="user in users">
              <td>
                {{ user.email }}
              </td>
              <td>
                {{ user.role }}
              </td>
              <div>
                <Link
                  :href="`/users/${user.id}`"
                  method="delete"
                  as="button"
                  class="bg-red-400 rounded-md"
                >
                  &nbsp;Delete&nbsp;
                </Link>
                <td v-if="user.role === 'employee'">
                  Promote
                </td>
                <td v-if="user.role === 'manager'">
                  Demote
                </td>
              </div>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
