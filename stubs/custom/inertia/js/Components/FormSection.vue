<template>
    <div class="md:grid md:gap-6" :class="gridClass">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0" :class="colClass">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow"
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                >
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions" class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { computed, useSlots } from 'vue';
import SectionTitle from '@/Components/SectionTitle.vue'

defineEmits(['submitted']);

defineProps({
    gridClass: {
        type: String,
        default: 'md:grid-cols-3'
    },

    colClass: {
        type: String,
        default: 'md:col-span-2'
    }
});

const hasActions = computed(() => !! useSlots().actions);
</script>
