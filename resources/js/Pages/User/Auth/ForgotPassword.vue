<template>
    <GuestLayout
        title="Forgot password"
        subtitle="Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one."
    >
        <Head title="Forgot Password" />

        <form @submit.prevent="submit">
            <div>
                <v-text-field
                    type="email"
                    label="Email"
                    v-model="form.email"
                    autofocus
                    :disabled="form.processing"
                    :loading="form.processing"
                    required
                    maxlength="50"
                    :error-messages="form.errors.email"
                />
            </div>

            <div class="ml-2 mt-13">
                <v-btn
                    color="primary"
                    :disabled="form.processing"
                    :loading="form.processing"
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
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'), {
        onError: (error) => {
            console.log(error)
        }
    });
};
</script>
