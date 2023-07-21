<template>
    <Panel :show=isSettingsPanelOpen title="Settings" 
        @close="isSettingsPanelOpen = !isSettingsPanelOpen">
        <template #content>
            <div>Settings Content</div>
        </template>
    </Panel>
</template>

<script setup>
import Panel from '@/Components/Panels/Panel.vue'
import { isSettingsPanelOpen } from '@/Composables'
</script>
