<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  auth: Object,
  nextWork: Object,
  nextHoliday: null,
})

</script>

<template>
  <Head title="Dashboard" />

  <AppLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <section>
          <div class=" overflow-hidden bg-white shadow">
            <div class="p-6 bg-white">
              <div class="sm:flex sm:justify-between sm:items-center">
                <div class="sm:flex sm:space-x-5">
                  <div class="shrink-0" />
                  <div class="mt-4 text-center sm:pt-1 sm:mt-0 sm:text-left">
                    <p class="text-sm font-medium text-gray-600">
                      Welcome,
                    </p>
                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">
                      {{ auth.user.email }}
                    </p>
                    <p class="text-sm font-medium text-gray-600">
                      {{ auth.user.role }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div>
          <Link :href="'/profile/password'">
            Change Password
          </Link>
        </div>
        <div>
          <div v-if="auth.can.manageUsers">
            <Link :href="'/users'">
              Manage Users
            </Link>
          </div>
          <div>
            <Link :href="'/holiday/request'">
              Manage Holidays Requests
            </Link>
          </div>
          <div v-if="auth.can.manageHolidays">
            <Link :href="'/holidays'">
              Manage Holidays
            </Link>
          </div>
          <div v-if="auth.can.manageHolidays">
            <Link :href="'/holiday/summary'">
              Holidays Summary
            </Link>
          </div>
          <div>
            <Link
              :href="'/work/request/create'"
              as="button"
              class="bg-amber-300"
            >
              Create Work Request
            </Link>
          </div>
          <div v-if="auth.can.manageWorkTimes">
            <Link
              :href="'/workTime/create'"
              as="button"
              class=""
            >
              Manage Work
            </Link>
          </div>
          <div v-if="auth.can.manageWorkTimes">
            <Link
              :href="'/workTimes/summary'"
              as="button"
              class=""
            >
              Work Time Summary
            </Link>
          </div>
          <div>
            <Link
              :href="'/workTime'"
              as="button"
              class=""
            >
              Work Schedule
            </Link>
          </div>
          <div class="bg-orange-200 h-1/6 w-2/6 border-2 border-black">
            Next Working Hour
            <div v-if="nextWork">
              <span>{{ nextWork.date }}</span><br>
              <span>{{ nextWork.start }} - {{ nextWork.end }}</span>
            </div>
            <div v-else>
              There is not work anytime soon
            </div>
          </div>
          <div class="bg-orange-200 h-1/6 w-2/6 border-2 border-orange-500">
            Next Holiday
            <div v-if="nextHoliday">
              <span>{{ nextHoliday.start_date }}</span><br>
              <span>{{ nextHoliday.type }}</span>
            </div>
            <div v-else>
              There is not vacation anytime soon
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
