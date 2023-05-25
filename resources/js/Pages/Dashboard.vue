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

  <AppLayout :auth="auth">
    <div class="sm:max-w-7xl w-full mx-auto h-full my-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <section>
          <div class=" overflow-hidden bg-white shadow">
            <div class="p-6 bg-white">
              <div class="sm:flex sm:justify-between sm:items-center">
                <div class="sm:flex sm:space-x-5">
                  <div class="shrink-0" />
                  <div class="mt-4 text-center sm:pt-1 sm:mt-0 sm:text-left">
                    <p class="text-sm font-medium text-gray-600">
                      Witaj,
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
        <div class="md:flex w-5/6 mx-auto mt-auto pt-5 space-y-5">
          <div class="md:w-1/3 m-auto flex flex-col mx-auto space-y-5">
            <div class="bg-orange-200 border-2 border-orange-500">
              Następna zmiana w pracy
              <div v-if="nextWork">
                <span>{{ nextWork.date }}</span><br>
                <span>{{ nextWork.start }} - {{ nextWork.end }}</span>
              </div>
              <div v-else>
                Nie posiadasz zmian w najbliższym czasie
              </div>
            </div>
            <div class="bg-orange-200 border-2 border-orange-500">
              Następe Wakacje
              <div v-if="nextHoliday">
                <span>{{ nextHoliday.start_date }}</span><br>
                <span>{{ nextHoliday.type }}</span>
              </div>
              <div v-else>
                Nie masz zaplanowanych wakacji w najbliższym czasie
              </div>
            </div>
          </div>
          <div class="md:w-2/3 flex flex-col mx-auto text-xl space-y-1">
            <Link
              v-if="auth.can.manageUsers"
              as="button"
              :href="'/users'"
              class="w-1/2 mx-auto ring-1 shadow-sky-400 shadow-lg hover:bg-sky-400"
            >
              Pracownicy
            </Link>
            <Link
              v-if="auth.can.manageHolidays"
              as="button"
              class="w-1/2 mx-auto ring-1 shadow-sky-400 shadow-lg hover:bg-sky-400"
              :href="'/holiday/summary'"
            >
              Podsumowanie Urlopów
            </Link>
            <Link
              v-if="auth.can.manageWorkTimes"
              :href="'/workTime/create'"
              as="button"
              class="w-1/2 mx-auto ring-1 shadow-sky-400 hover:bg-sky-400 shadow-lg"
            >
              Zarządzaj czasem pracy
            </Link>
            <Link
              v-if="auth.can.manageWorkTimes"
              :href="'/workTimes/summary'"
              as="button"
              class="w-1/2 mx-auto ring-1 shadow-sky-400 hover:bg-sky-400 shadow-lg"
            >
              Podsumowanie czasu pracy
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
