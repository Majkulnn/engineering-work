<script setup>
import {Head, useForm, Link, router} from '@inertiajs/vue3'
import {Modal} from 'momentum-modal'
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
import {ref} from 'vue'

const props = defineProps({
    auth: Object,
})
const mobileMenuOpen = ref(false)

</script>

<template>
  <div class="min-h-screen h-screen flex-col mb-0 pb-0">
    <slot/>
  </div>
</template>
