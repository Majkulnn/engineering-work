<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import { reactive, ref } from 'vue'

const month = ref(null)

async function getData () {
  router.reload({
    only: ['workTime'], data: { month: month.value },
  })
}
const combineData = () => {
  const combinedData = reactive({})
  for (const user of usePage().props.users) {
    combinedData[user.id] = {
      user,
      workTime: usePage().props.workTime.find((wt) => wt.user_id === user.id)?.total_hours || 0,
    }
  }
  return combinedData
}

defineProps({
  auth: Object,
  users: Object,
  workTime: Object,
})

</script>

<template>
  <Head title="Hours Schedule" />

  <AppLayout :auth="auth">
    <div class="max-w-7xl mx-auto py-4">
      <div class="mt-6 max-w-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
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
            v-model="month"
            type="month"
            dataformatas="mm-yyyy"
            @change="getData()"
          />
          <div>
            <p>Dane dla {{ month? month: 'Maj-2023' }}:</p>
          </div>
        </div>
        <div>
          <ul>
            <tr
              v-for="(user, index) in combineData()"
              :key="index"
            >
              <td>
                {{ user.user.last_name }}
              </td>
              <td>{{ user.workTime }}</td>
            </tr>
          </ul>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
