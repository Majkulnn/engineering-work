<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { reactive, ref } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import dayGridPlugin from '@fullcalendar/daygrid'

const props = defineProps({
  auth: Object,
  workTimes: Object,
})

const fullCalendar = ref(null)
const handleEventClick = (info) => {
  if (info.event.id) {
    console.log(info.event.id)
    router.get(`/workTime/${info.event.id}/coworkers`)
  }
}

const calendarOptions = reactive({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
  plugins: [interactionPlugin, dayGridPlugin],
  timeZone: 'UTC',
  initialView: 'dayGridMonth',
  firstDay: 1,
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: '',
  },
  selectable: false,
  height: 'auto',
  weekends: true,
  editable: false,
  events: props.workTimes,
  eventDisplay: 'list-item',
  eventTimeFormat: {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
  },
  displayEventEnd: false,
  eventDidMount: function (info) {
    console.log(info.event)
  },
  eventClick: handleEventClick,
})

</script>

<template>
  <Head title="WorkTime List" />

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
          <div>
            <FullCalendar
              ref="fullCalendar"
              :options="calendarOptions"
            />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
.fc-timeline-slot{
    background-color: #e2e8f0;
}
.fc-timeline-slot-frame{
    background-color: cornflowerblue;
}
</style>
