<template>
    <GuestLayout
        title="Forgot password"
        subtitle="Vă rugăm să introduceți adresa dvs. de e-mail și vă vom trimite un link de resetare a parolei care vă va permite să alegeți una nouă."
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
    form.post(route('send-password-link'), {
        onError: (error) => {
            console.log(error)
        }
    });
};
</script>
