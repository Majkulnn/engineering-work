<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import FullCalendar from '@fullcalendar/vue3'
import { reactive } from 'vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import multiMonthPlugin from '@fullcalendar/multimonth'
import plLocale from '@fullcalendar/core/locales/pl'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  auth: Object,
  holidaysRequests: Object,
})
const events = () => {
  const events = []
  for (const item of props.holidaysRequests) {
    events.push({
      id: item.id,
      title: item.creator,
      start: item.start_date,
      end: item.end_date,
      backgroundColor: (item.status === 'PENDING' ? 'orange' : (item.status === 'ACCEPTED' ? 'green' : 'red')),
      extendedProps: {
        status: item.status,
        type: item.type,
      },
    })
  }
  return events
}
const handleEventClick = (info) => {
  router.get(`/holiday/request/${info.event.id}/edit`)
}
const calendarOptions = reactive({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
  themeSystem: 'standard',
  locale: plLocale,
  plugins: [dayGridPlugin, interactionPlugin, listPlugin, multiMonthPlugin],
  initialView: 'dayGridMonth',
  headerToolbar: {
    left: 'prev,next,today',
    center: 'title',
    right: 'dayGridWeek,dayGridMonth,multiMonthYear,listWeek',
  },
  height: 'auto',
  weekends: true,
  eventSources: [events()],
  editable: true,
  eventClick: handleEventClick,
})
let isShow = true
const showCalendar = () => {
  isShow = !isShow
  router.reload()
}

</script>

<template>
  <Head title="List" />

  <AppLayout :auth="auth">
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <div class="flex space-x-5">
          <div>
            <Link
              :href="'/dashboard'"
              as="button"
              class="rounded-md bg-emerald-500 border-black border"
            >
              Powrót
            </Link>
          </div>
          <div v-if="auth.user.role !== 'administrator'">
            <Link
              :href="'/holiday/request/create'"
              as="button"
              class="bg-orange-300"
            >
              Stwórz wiosek o urlop
            </Link>
          </div>
          <div>
            <SecondaryButton @click="showCalendar()">
              Kalendarz / Tabela
            </SecondaryButton>
          </div>
        </div>
        <div v-if="isShow">
          <FullCalendar :options="calendarOptions" />
        </div>
        <div v-if="!isShow">
          <table class="border-2">
            <tr v-for="holidayRequest in holidaysRequests">
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
              <div v-if="holidayRequest.status === 'PENDING' && auth.can.manageHolidays">
                <Link
                  :href="`/holiday/request/${holidayRequest.id}/accept`"
                  method="put"
                  as="button"
                  class="bg-orange-300 rounded-md"
                >
                  &nbsp;Akceptuj&nbsp;
                </Link>
                <Link
                  :href="`/holiday/request/${holidayRequest.id}/reject`"
                  method="put"
                  as="button"
                  class="bg-red-400 rounded-md"
                >
                  &nbsp;Odrzuć&nbsp;
                </Link>
              </div>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
