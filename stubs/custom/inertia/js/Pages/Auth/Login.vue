<template>
    <AuthenticationLayout title="Log in">
        <ValidationErrors class="mb-4" />

        <div class="text-center mb-6" v-if="$page.props.flash?.teamInvitation">
            <h4>
                Login or <Link class="hover:text-purple-600" :href="route('register')">register</Link>
                to join <strong class="text-purple-500">{{ $page.props.flash.teamInvitation }}</strong>
            </h4>
        </div>
        

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="email" value="Email" />
                    <InputIconWrapper>
                        <template #icon>
                            <EnvelopeIcon aria-hidden="true" class="w-6 h-6" />
                        </template>
                        <Input with-icon id="email" type="email" class="block w-full" placeholder="Email" v-model="form.email" required autofocus />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password" value="Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-6 h-6" />
                        </template>
                        <Input with-icon id="password" type="password" class="block w-full" placeholder="Password" v-model="form.password" required autocomplete="current-password" />
                    </InputIconWrapper>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-blue-500 hover:underline">
                        Forgot your password?
                    </Link>
                </div>

                <div>
                    <Button class="w-full justify-center gap-2" :disabled="form.processing" v-slot="{ iconSizeClasses }">
                        <ArrowLeftOnRectangleIcon aria-hidden="true" :class="iconSizeClasses" />
                        <span>Log in</span>
                    </Button>
                </div>

                <p class="text-center text-sm text-gray-600 dark:text-gray-400" v-if="!$page.props.flash?.teamInvitation">
                    Don't have an account?
                    <Link :href="route('register')" class="text-blue-500 hover:underline">
                        Register
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
import { EnvelopeIcon, LockClosedIcon, ArrowLeftOnRectangleIcon } from '@heroicons/vue/24/outline'

defineProps({
    canResetPassword: Boolean,
    status: String
})

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : ''
    }))
    .post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>
