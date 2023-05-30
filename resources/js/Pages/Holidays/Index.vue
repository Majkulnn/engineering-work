<script setup>
import plLocale from '@fullcalendar/core/locales/pl'
import FullCalendar from '@fullcalendar/vue3'
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { reactive } from 'vue'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import resourceTimelinePlugin from '@fullcalendar/resource-timeline'

const props = defineProps({
  auth: Object,
  holidays: Object,
})
const events = () => {
  const events = []
  for (const item of props.holidays) {
    events.push({
      id: item.id,
      title: item?.user ? item.user : 'name',
      start: item.start_date ? item.start_date : 'no date',
      end: item.end_date,
      status: item.status,
    })
  }
  return events
}
const handleEventClick = (info) => {
  router.get(`/holidays/${info.event.id}`)
}
const calendarOptions = reactive({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
  plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin, listPlugin, resourceTimelinePlugin],
  locale: plLocale,
  initialView: 'dayGridMonth',
  headerToolbar: {
    left: 'prev,next,today',
    center: 'title',
    right: 'dayGridMonth,dayGridWeek,listDay',
  },
  height: 'auto',
  weekends: false,
  events: events(),
  eventClick: handleEventClick,
})

</script>

<template>
  <Head title="Urlopy" />

  <AppLayout
    :auth="props.auth"
  >
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <h1 class="text-center text-3xl font-bold">
          Urlopy pracownicze
        </h1>
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
          <FullCalendar
            :events="events()"
            :options="calendarOptions"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
