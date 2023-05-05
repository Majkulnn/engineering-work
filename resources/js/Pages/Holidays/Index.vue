<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import DangerButton from '@/Components/DangerButton.vue'

defineProps({
  auth: Object,
  holidays: Object,
})

</script>

<template>
  <Head title="List" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div>
          <div>
            <Link
              :href="'/dashboard'"
              as="button"
              class="rounded-md bg-emerald-500 border-black border"
            >
              Back
            </Link>
          </div>
        </div>
        <div>
          <table class="border-2">
            <tr v-for="holiday in holidays">
              <td>
                {{ holiday.user }}
              </td>
              <td>
                {{ holiday.start_date }}
              </td>
              <td>
                {{ holiday.end_date }}
              </td>
              <td>
                {{ holiday.type }}
              </td>
              <td>
                {{ holiday.days }}
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
