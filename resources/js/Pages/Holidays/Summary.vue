<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import { reactive, ref } from 'vue'

const year = ref(null)

async function getData () {
  router.reload({
    only: ['holidays'], data: { year: year.value },
  })
}
const combineData = () => {
  const combinedData = reactive({})
  for (const user of usePage().props.users) {
    combinedData[user.id] = {
      user,
      holidays: usePage().props.holidays.find((holiday) => holiday.user_id === user.id)?.total_days || 0,
    }
  }
  return combinedData
}

defineProps({
  auth: Object,
  users: Object,
  holidays: Object,
})

</script>

<template>
  <Head title="Podsumowanie urlopów" />

  <AppLayout :auth="auth">
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
        <h1 class="text-center text-3xl font-bold">
          Podsumowanie urlopów
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
          <TextInput
            v-model="year"
            type="year"
            dataformatas="yyyy"
            @change="getData()"
          />
          <div>
            <p>Data for {{ year? year: '2023' }}:</p>
          </div>
        </div>
        <div>
          <ul>
            <tr
              v-for="(user, index) in combineData()"
              :key="index"
            >
              <td>
                {{ user.user.id }}
              </td>
              <td>
                {{ user.user.last_name }}
              </td>
              <td>{{ user.holidays }}</td>
            </tr>
          </ul>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
