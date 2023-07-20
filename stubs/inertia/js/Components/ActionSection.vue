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
            <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>

<script setup>
import SectionTitle from '@/Components/SectionTitle.vue'

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
</script>