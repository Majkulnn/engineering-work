<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import DangerButton from '@/Components/DangerButton.vue'

defineProps({
  auth: Object,
  holidays_requests: Object,
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
          <div v-if="auth.user.role != 'administrator'">
            <Link
              :href="'/holiday/request/create'"
              as="button"
              class="bg-orange-300"
            >
              Create Holiday Request
            </Link>
          </div>
        </div>
        <div>
          <table class="border-2">
            <tr v-for="holidayRequest in holidays_requests.data">
              <td>
                {{ holidayRequest.creator }}
              </td>
              <td>
                {{ holidayRequest.start_date }}
              </td>
              <td>
                {{ holidayRequest.end_date }}
              </td>
              <td>
                {{ holidayRequest.reason }}
              </td>
              <td>
                {{ holidayRequest.type }}
              </td>
              <td>
                {{ holidayRequest.status }}
              </td>
              <div v-if="holidayRequest.status == 'PENDING' && auth.can.manageHolidays">
                <Link
                  :href="`/holiday/request/${holidayRequest.id}/accept`"
                  method="put"
                  as="button"
                  class="bg-orange-300 rounded-md"
                >
                  &nbsp;Accept&nbsp;
                </Link>
                <Link
                  :href="`/holiday/request/${holidayRequest.id}/reject`"
                  method="put"
                  as="button"
                  class="bg-red-400 rounded-md"
                >
                  &nbsp;Reject&nbsp;
                </Link>
              </div>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
