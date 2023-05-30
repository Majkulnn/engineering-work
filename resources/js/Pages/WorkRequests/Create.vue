<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
defineProps({
  auth: Object,
})

const form = useForm({
  date: '',
  from: '',
  to: '',
})
</script>

<template>
  <Head title="Preferencje czasu pracy" />

  <AppLayout :auth="auth">
    <div class="max-w-7xl h-full mx-auto py-4">
      <div class="mt-6 max-w-full h-full mx-auto bg-sky-300 shadow-lg rounded-lg p-6">
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
        <div class="w-fit mx-auto">
          Stwórz preferencję pracy
          <form
            class="max-w-2xl w-fit mx-auto space-y-5"
            method="post"
            @submit.prevent="form.post('/work/request')"
          >
            <div class="mx-auto">
              <InputLabel
                for="date"
                value="Data"
              />

              <TextInput
                id="date"
                v-model="form.date"
                type="date"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                required
                autofocus
                autocomplete="date"
              />

              <InputError
                class="mt-2"
                :message="form.errors.date"
              />
            </div>
            <div class="">
              <InputLabel
                for="from"
                value="Godzina rozpoczęcia"
              />

              <TextInput
                id="from"
                v-model="form.from"
                type="time"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                required
                autocomplete="from"
              />

              <InputError
                class="mt-2"
                :message="form.errors.from"
              />
            </div>
            <div class="">
              <InputLabel
                for="to"
                value="Godzina Zakończenia"
              />

              <TextInput
                id="to"
                v-model="form.to"
                type="time"
                class="w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                required
                autocomplete="to"
              />

              <InputError
                class="mt-2"
                :message="form.errors.to"
              />
            </div>
            <div>
              <PrimaryButton
                class="w-full flex justify-center bg-blue-700 text-white p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500"
              >
                Utwórz
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
