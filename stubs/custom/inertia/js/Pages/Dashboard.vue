<template>
    <AppLayout title="Dashboard">
		<template #subheader>
			<div
				class="border-t border-gray-300 dark:border-gray-600 w-full p-4 px-4 mx-auto sm:px-6 lg:px-8 bg-white shadow-lg dark:bg-dark-eval-1 shadow-md">
				<div
					class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-row justify-between md:space-y-0">
					<div class="flex items-center">
						<h2 class="text-xl font-semibold leading-tight">
							Dashboard
						</h2>
					</div>

					<Button variant="black" @click="isSettingsPanelOpen = !isSettingsPanelOpen" class="items-center gap-2 max-w-xs"
						v-slot="{ iconSizeClasses }">
						<CogIcon aria-hidden="true" :class="iconSizeClasses" />
						<span>Panel</span>
					</Button>
				</div>
			</div>
		</template>

        <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md lg:flex-row md:justify-between dark:bg-dark-eval-1">
            <div>You're logged in!</div>

            <div>
                <a 
                    href="https://jetstream.laravel.com/2.x/introduction.html"
                    class="text-blue-600 hover:underline"
                    target="_blank"
                >
                    Jetstream Documentation
                </a>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Button from "@/Components/Button.vue"
import { GithubIcon } from "@/Components/Icons/Brands"
import { isSettingsPanelOpen } from '@/Composables'
import { CogIcon } from '@heroicons/vue/24/outline'
</script>
