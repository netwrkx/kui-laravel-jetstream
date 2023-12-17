<template>
    <AppLayout title="Create Team">
		<template #subheader>
			<div
				class="border-t border-gray-300 dark:border-gray-600 w-full p-4 px-4 mx-auto sm:px-6 lg:px-8 bg-white shadow-lg dark:bg-dark-eval-1 shadow-md">
				<div
					class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-row justify-between md:space-y-0">
					<div class="flex items-center">
						<h2 class="text-xl font-semibold leading-tight">
							Create Team
						</h2>
					</div>
				</div>
			</div>
        </template>

        <CreateTeamForm />
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import CreateTeamForm from '@/Pages/Teams/Partials/CreateTeamForm.vue'
</script>
