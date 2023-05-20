<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { onMounted, reactive, ref, watch } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import resourceTimelinePlugin from '@fullcalendar/resource-timeline'

const props = defineProps({
  auth: Object,
  users: Object,
  workTimes: Object,
})

const fullCalendar = ref(null)
const usersToResource = () => {
  const resources = []
  for (const user of props.users) {
    resources.push({
      id: user.id,
      title: user.last_name,
      extendedProps: {
        job_title: user.position,
      },
    })
  }
  return resources
}
const handleDateSelect = (selectInfo) => {
  const position = selectInfo.resource.extendedProps.job_title
  const calendarApi = selectInfo.view.calendar

  const data = {
    user_id: selectInfo.resource.id,
    position,
    start: selectInfo.startStr,
    end: selectInfo.endStr,
  }

  calendarApi.unselect()
  router.post('/workTime', data)
  calendarApi.refetchEvents()
}
onMounted(() => {
  watch(
    console.log('event refetch'),
  )
})
const handleEventClick = (info) => {
  if (info.event.id) {
    console.log(info.event.id)
    router.get(`/workTime/${info.event.id}`)
  }
}
const handleEventChange = (changeInfo) => {
  const position = changeInfo.event.title
  const userId = changeInfo.event.getResources().map(function (resource) {
    return resource.id
  })
  const data = {
    oldEvent: {
      user_id: userId[0],
      start: changeInfo.oldEvent.startStr,
      end: changeInfo.oldEvent.endStr,
    },
    newEvent: {
      user_id: userId[0],
      start: changeInfo.event.startStr,
      end: changeInfo.event.endStr,
    },
    position,
  }
  router.put('/workTime/update', data)
  router.reload()
}

const calendarOptions = reactive({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
  plugins: [interactionPlugin, resourceTimelinePlugin],
  timeZone: 'UTC',
  initialView: 'resourceTimeline',
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: '',
  },
  selectable: true,
  height: 'auto',
  eventOverlap: function (stillEvent, movingEvent) {
    return stillEvent.display === 'background'
  },
  weekends: true,
  resourceAreaWidth: '10%',
  initialResources: usersToResource(),
  editable: true,
  eventResourceEditable: false,
  select: handleDateSelect,
  eventSources: [
    '/api/workTimes',
    '/api/holidays',
    '/api/workRequests',
  ],
  slotLabelFormat: { hour: 'numeric', hour12: false },
  eventClick: handleEventClick,
  eventAdd: '',
  eventChange: handleEventChange,
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
