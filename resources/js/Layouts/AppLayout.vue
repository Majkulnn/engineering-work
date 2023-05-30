<script setup>
import { Link, router } from '@inertiajs/vue3'
import { Modal } from 'momentum-modal'
import {
  Dialog,
  DialogPanel,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Popover, PopoverButton,
  PopoverGroup, PopoverPanel,
} from '@headlessui/vue'
import {
  Bars3Icon,
  XMarkIcon,
} from '@heroicons/vue/24/outline'
import { ref } from 'vue'

defineProps({
  auth: Object,
})
const mobileMenuOpen = ref(false)

</script>

<template>
  <div class="min-h-screen h-screen flex-col mb-0 pb-0">
    <header>
      <nav class="sm:text-xl rounded-b-md bg-sky-300 flex justify-between min-h-min h-1/6 sm:w-10/12 w-full mx-auto">
        <div @click="router.get('/dashboard')">
          Koala Work Schedule
        </div>
        <div class="flex md:hidden">
          <button
            type="button"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
            @click="mobileMenuOpen = true"
          >
            <span class="sr-only">Open main menu</span>
            <Bars3Icon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </button>
        </div>
        <PopoverGroup class="hidden md:flex md:gap-x-12 h-full space-x-5">
          <Link
            :href="'/work/request/create'"
            as="button"
            class="shadow"
          >
            Preferencje pracy
          </Link>
          <Link
            class="shadow"
            as="button"
            :href="'/holiday/request'"
          >
            Wnioski o urlop
          </Link>
          <Link
            as="button"
            class="shadow"
            :href="'/holidays'"
          >
            Urlopy
          </Link>

          <Link
            :href="'/workTime'"
            as="button"
            class="shadow"
          >
            Grafik pracy
          </Link>
        </PopoverGroup>
        <Popover class="hidden md:flex flex-col">
          <PopoverButton>{{ auth.user.email }}</PopoverButton>
          <PopoverPanel class="">
            <Link :href="'/profile/password'">
              Zmień hasło
            </Link>
            <br>
            <Link
              method="POST"
              as="button"
              class=""
              :href="'/logout'"
            >
              Wyloguj
            </Link>
          </PopoverPanel>
        </Popover>
      </nav>
      <Dialog
        as="div"
        class="md:hidden"
        :open="mobileMenuOpen"
        @close="mobileMenuOpen = false"
      >
        <div class="fixed inset-0 z-10" />
        <DialogPanel class="fixed top-0 rounded-3xl border-2 right-0 z-10 w-full overflow-y-auto bg-blue-300 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a
              href="/dashboard"
              class="-m-1.5 p-1.5"
            >
              <span>Koala Work</span>
            </a>
            <button
              type="button"
              class="-m-2.5 rounded-md p-2.5 text-gray-700"
              @click="mobileMenuOpen = false"
            >
              <span class="sr-only">Close menu</span>
              <XMarkIcon
                class="h-6 w-6"
                aria-hidden="true"
              />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="flex flex-col space-y-2 py-6">
                <Link
                  :href="'/work/request/create'"
                  as="button"
                  class="shadow"
                >
                  Preferencje pracy
                </Link>
                <Link
                  as="button"
                  class="shadow"
                  :href="'/holiday/request'"
                >
                  Wnioski o urlop
                </Link>
                <Link
                  as="button"
                  class="shadow"
                  :href="'/holidays'"
                >
                  Urlopy
                </Link>

                <Link
                  :href="'/workTime'"
                  as="button"
                  class="shadow"
                >
                  Grafik pracy
                </Link>
              </div>
              <Disclosure>
                <DisclosureButton class="py-2">
                  {{ auth.user.email }}
                </DisclosureButton>
                <DisclosurePanel class="text-gray-800">
                  <Link :href="'/profile/password'">
                    Zmień hasło
                  </Link>
                  <br>
                  <Link
                    method="POST"
                    as="button"
                    class=""
                    :href="'/logout'"
                  >
                    Wyloguj
                  </Link>
                </DisclosurePanel>
              </Disclosure>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </header>
    <main class="relative rounded px-6 2xl:container h-5/6 sm:w-10/12 mx-auto flex-col flex-grow">
      <Modal />
      <slot />
    </main>
    <footer class="rounded-t bottom-0 fixed mb-0 pb-0 bg-sky-300 flex justify-center w-full mx-auto my-auto">
      @2023
    </footer>
  </div>
</template>
