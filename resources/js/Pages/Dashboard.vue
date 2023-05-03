<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  auth: Object,
  can: Object,
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
                      Cześć,
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
          <div v-if="auth.can.manageUsers">
            <Link :href="'/users'">
              Manage Users
            </Link>
          </div>
          <div v-if="auth.can.manageHolidays">
            <Link :href="'/users'">
              Manage Holidays Requests
            </Link>
          </div>
          <div>
            <Link :href="'/holiday/request/create'" as="button" class="bg-orange-300">
              Create Holiday Request
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
