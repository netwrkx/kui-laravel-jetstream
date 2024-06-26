<template>
    <AuthenticationLayout title="Register">
        <ValidationErrors class="mb-4" />

        <div class="text-center mb-6" v-if="$page.props.flash?.teamInvitation">
            <h4>
                Register or <Link class="hover:text-purple-600" :href="route('login')">Login</Link>
                to join <strong class="text-purple-500">{{ $page.props.flash.teamInvitation }}</strong>
            </h4>
        </div>

        <form @submit.prevent="submit">
            <div class="grid gap-4">
                <div class="space-y-2">
                    <Label for="name" value="Name" />
                    <InputIconWrapper>
                        <template #icon>
                            <UserIcon aria-hidden="true" class="w-6 h-6" />
                        </template>
                        <Input with-icon id="name" type="text" class="block w-full" placeholder="Name" v-model="form.name" required autofocus autocomplete="name" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="email" value="Email" />
                    <InputIconWrapper>
                        <template #icon>
                            <EnvelopeIcon aria-hidden="true" class="w-6 h-6" />
                        </template>
                        <Input with-icon id="email" type="email" class="block w-full" placeholder="Email" v-model="form.email" required />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password" value="Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-6 h-6" />
                        </template>
                        <Input with-icon id="password" type="password" class="block w-full" placeholder="Password" v-model="form.password" required autocomplete="new-password" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password_confirmation" value="Confirm Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-6 h-6" />
                        </template>
                        <Input with-icon id="password_confirmation" type="password" class="block w-full" placeholder="Confirm Password" v-model="form.password_confirmation" required autocomplete="new-password" />
                    </InputIconWrapper>
                </div>

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <Label for="terms">
                        <div class="flex items-center">
                            <Checkbox name="terms" id="terms" v-model:checked="form.terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-blue-600 hover:text-blue-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-blue-600 hover:text-blue-900">Privacy Policy</a>
                            </div>
                        </div>
                    </Label>
                </div>

                <div>
                    <Button class="w-full justify-center gap-2" :disabled="form.processing" v-slot="{ iconSizeClasses }">
                        <UserPlusIcon aria-hidden="true" :class="iconSizeClasses" />
                        <span>Register</span>
                    </Button>
                </div>

                <p class="text-center text-sm text-gray-600 dark:text-gray-400" v-if="!$page.props.flash?.teamInvitation">
                    Already have an account?
                    <Link :href="route('login')" class="text-blue-500 hover:underline">
                        Login
                    </Link>
                </p>
            </div>
        </form>
    </AuthenticationLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Button from '@/Components/Button.vue'
import Input from '@/Components/Input.vue'
import Checkbox from '@/Components/Checkbox.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import { UserIcon, EnvelopeIcon, LockClosedIcon, UserPlusIcon } from '@heroicons/vue/24/outline'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>
