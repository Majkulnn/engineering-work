<script setup>
import { computed } from 'vue'

const emit = defineEmits(['update:checked'])

const props = defineProps({
  checked: {
    type: [Array, Boolean],
    default: false,
  },
  value: {
    default: null,
  },
})

const proxyChecked = computed({
  get () {
    return props.checked
  },

  set (val) {
    emit('update:checked', val)
  },
})
</script>

<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-sky-700 shadow-sm focus:ring-sky-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
  >
</template>
