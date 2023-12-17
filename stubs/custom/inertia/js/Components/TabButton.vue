<template>
  <Tab as="template" v-slot="{ selected }">
      <button :class="[
                'block max-w-xs text-left rounded-md text-gray-600 dark:text-gray-400 transition-colors hover:text-gray-900 dark:hover:text-gray-200',
                width, size,
                {
                    'bg-black text-white hover:text-white dark:text-white dark:hover:text-white' : selected,
                },
            ]"
        >
          {{ title }}
      </button>
  </Tab>
</template>

<script setup>
import { Tab } from '@headlessui/vue'
const props = defineProps({
    title: {
        type: String,
    },
    classes: {
        type: String,
        default: 'bg-black text-white hover:text-white dark:text-white dark:hover:text-white'
    },
    size: {
        type: String,
        default: 'px-4 py-2'
    },
    width: {
        type: String,
        default: 'w-full'
    }
})
</script>
