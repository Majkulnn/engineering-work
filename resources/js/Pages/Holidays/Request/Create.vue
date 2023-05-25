<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
  auth: Object,
  holiday_type: Object,
})

const form = useForm({
  start_date: '',
  end_date: '',
  type: '',
  reason: '',
})

</script>

<template>
  <Head title="Wnioski urlopowe" />

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
          Stwórz wniosek
          <form
            class="max-w-2xl mx-auto"
            method="post"
            @submit.prevent="form.post('/holiday/request')"
          >
            <div class="">
              <InputLabel
                for="start_date"
                value="Od"
              />

              <TextInput
                id="start_date"
                v-model="form.start_date"
                type="date"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                required
                autofocus
                autocomplete="start_date"
              />

              <InputError
                class="mt-2"
                :message="form.errors.start_date"
              />
            </div>
            <div class="">
              <InputLabel
                for="end_date"
                value="Do"
              />

              <TextInput
                id="end_date"
                v-model="form.end_date"
                type="date"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                required
                autocomplete="end_date"
              />

              <InputError
                class="mt-2"
                :message="form.errors.end_date"
              />
            </div>
            <div class="">
              <InputLabel
                for="type"
                value="Rodzaj urlopu"
              />

              <select
                id="type"
                v-model="form.type"
                type="text"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                required
                autocomplete="type"
              >
                <option v-for="holidayType in holiday_type">
                  {{ holidayType.label }}
                </option>
              </select>

              <InputError
                class="mt-2"
                :message="form.errors.type"
              />
            </div>
            <div class="">
              <InputLabel
                for="reason"
                value="Powód"
              />

              <TextInput
                id="position"
                v-model="form.reason"
                type="text"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                placeholder="Powód"
                autocomplete="reason"
              />

              <InputError
                class="mt-2"
                :message="form.errors.reason"
              />
            </div>
            <div class="flex justify-center w-fit">
              <PrimaryButton
                class="w-full flex justify-center bg-blue-700 text-white p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500"
              >
                Utórz
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
