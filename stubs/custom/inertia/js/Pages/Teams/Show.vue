<template>
    <AppLayout title="Team Settings">
		<template #subheader>
			<div class="border-t border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-eval-1 shadow-md">
                <div class="p-4 mx-auto max-w-7xl sm:p-6 lg:p-8">
                    <div class="flex flex-row justify-between md:space-y-0">
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold leading-tight">
                                Team Settings
                            </h2>
                        </div>
                    </div>
                </div>
			</div>
        </template>

        <div class="grid gap-10">
            <!-- Team Settings -->
            <div>
                <UpdateTeamNameForm :team="team" :permissions="permissions" />
            </div>

            <!-- Team Memeber Manager -->
            <div>
                <TeamMemberManager
                    :team="team"
                    :available-roles="availableRoles"
                    :user-permissions="permissions"
                />
            </div>

            <div
                    v-if="permissions.canDeleteTeam && !team.personal_team"
            >
                <DeleteTeamForm class="mt-10 sm:mt-0" :team="team" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import DeleteTeamForm from '@/Pages/Teams/Partials/DeleteTeamForm.vue'
import TeamMemberManager from '@/Pages/Teams/Partials/TeamMemberManager.vue'
import UpdateTeamNameForm from '@/Pages/Teams/Partials/UpdateTeamNameForm.vue'

defineProps(['team', 'availableRoles', 'permissions'])
</script>
