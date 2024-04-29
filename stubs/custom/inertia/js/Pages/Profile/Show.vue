<template>
    <AppLayout title="Profile">
		<template #subheader>
			<div class="border-t border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-eval-1 shadow-md">
                <div class="p-4 mx-auto max-w-7xl sm:p-6 lg:p-8">
                    <div class="flex flex-row justify-between md:space-y-0">
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold leading-tight">
                                Profile Settings
                            </h2>
                        </div>
                    </div>
                </div>
			</div>
        </template>

        <div class="grid gap-10">
            <div
                v-if="$page.props.jetstream.canUpdateProfileInformation"
            >
                <UpdateProfileInformationForm
                :user="$page.props.auth.user"
                />
            </div>

            <div v-if="$page.props.jetstream.canUpdatePassword">
                <UpdatePasswordForm />
            </div>

            <div
                v-if="$page.props.jetstream.canManageTwoFactorAuthentication"
            >
                <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" />
            </div>

            <div>
                <LogoutOtherBrowserSessionsForm :sessions="sessions" />
            </div>

            <div
                v-if="$page.props.jetstream.hasAccountDeletionFeatures"
            >
                <DeleteUserForm />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
})
</script>
