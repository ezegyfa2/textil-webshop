<template>
    <GuestLayout
        title="Reset password"
        subtitle="Add a new password for browsing examples"
    >
        <Head title="Reset Password" />

        <form @submit.prevent="submit">
            <div>
                <v-text-field
                    id="email"
                    type="email"
                    label="Email"
                    v-model="form.email"
                    required
                    maxlength="50"
                    :error-messages="form.errors.email"
                />
            </div>

            <div class="mt-4">
                <v-text-field
                    id="password"
                    type="password"
                    label="Password"
                    v-model="form.password"
                    required
                    minlength="8"
                    maxlength="255"
                    :error-messages="form.errors.password"
                    autofocus
                />
            </div>

            <div class="mt-4">
                <v-text-field
                    id="password_confirmation"
                    type="password"
                    label="Confirm password"
                    v-model="form.password_confirmation"
                    required
                    minlength="8"
                    maxlength="255"
                    :error-messages="form.errors.password_confirmation"
                />
            </div>

            <div class="ml-2 mt-13">
                <v-btn
                    color="primary"
                    :disabled="form.processing"
                    type="submit"
                >
                    Reset password
                </v-btn>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>
