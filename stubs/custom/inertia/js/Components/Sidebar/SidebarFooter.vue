<template>
    <div class="flex-shrink-0 px-3" :class="sidebarState.isOpen ? 'lg:hidden': ''">
        <Button 
            iconOnly 
            variant="secondary" 
            type="button" 
            v-slot="{ iconSizeClasses }"
            v-show="!sidebarState.isOpen"
            @click="sidebarState.isOpen = !sidebarState.isOpen"
            :srText="sidebarState.isOpen ? 'Close sidebar' : 'Open sidebar'"
        >
            <MenuFoldLineLeftIcon 
                aria-hidden="true" 
                v-show="sidebarState.isOpen" 
                :class="[iconSizeClasses]" />

            <MenuFoldLineRightIcon 
                aria-hidden="true"
                v-show="!sidebarState.isOpen"  
                :class="[iconSizeClasses]" />
        </Button>
    </div>
</template>

<script setup>
import { sidebarState } from '@/Composables'
import Button from '@/Components/Button.vue'
import { MenuFoldLineLeftIcon, MenuFoldLineRightIcon } from '@/Components/Icons/Outline'
</script>
