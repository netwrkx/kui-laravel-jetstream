<template>
    <TransitionRoot appear as="template" :show="props.show">
        <Dialog as="div" class="fixed inset-0 overflow-hidden z-50" :onClose="close">
            <div class="absolute inset-0 overflow-hidden">
            <TransitionChild
                as="template"
                enter="transition-opacity ease-in-out duration-200"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-in-out duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <DialogOverlay class="absolute inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm" />
            </TransitionChild>
            <div :class="['fixed inset-y-0 max-w-full flex', { 'right-0 pl-10': !props.left, 'left-0 pr-10': props.left }]">
                <TransitionChild as="template"
                    enter="transform transition ease-in-out duration-300 sm:duration-500"
                    :enter-from="props.left ? '-translate-x-full' : 'translate-x-full'"
                    enter-to="translate-x-0"
                    leave="transform transition ease-in-out duration-300 sm:duration-500"
                    leave-from="translate-x-0"
                    :leave-to="props.left ? '-translate-x-full' : 'translate-x-full'"
                >
                <div class="relative w-screen max-w-md">
                    <TransitionChild as="template"
                        enter="ease-in-out duration-300"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="ease-in-out duration-300"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                    <div
                    class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition"
                        :class="[
                        'absolute top-0 pt-4 flex',
                        {
                            'left-0 -ml-8 pr-2 sm:pr-4 sm:-ml-10': !props.left,
                            'right-0 -mr-8 pl-2 sm:-mr-10 sm:pl-4': props.left,
                        },
                        ]"
                    >
                        <button
                        type="button"
                        class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                        @click="close"
                        >
                        <span class="sr-only">Close panel</span>
                        <XMarkIcon aria-hidden="true" class="w-6 h-6" />
                        </button>
                    </div>
                    </TransitionChild>
                    <div class="h-full flex flex-col bg-white shadow-xl overflow-y-hidden dark:bg-gray-900">
                    <div class="px-4 flex-shrink-0 sm:px-6 pt-6">
                        <DialogTitle class="text-lg font-medium text-gray-900 dark:text-gray-200">
                        {{ props.title }}
                        </DialogTitle>
                    </div>
                    <div class="mt-6 relative flex-1 px-4 overflow-y-auto sm:px-6">
                        <!-- {{ slots.default && slots.default() }} -->
                        <slot name="content"></slot>
                    </div>
                    </div>
                </div>
                </TransitionChild>
            </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogOverlay, DialogTitle, TransitionRoot, TransitionChild } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
const emit = defineEmits(['close'])

const props = defineProps({
    show: {
      type: Boolean,
      required: true,
    },
    left: {
      type: Boolean,
      required: false,
      default: false,
    },
    title: {
      type: String,
      required: true,
    },
})

const close = () => {
    emit('close')
}
</script>
