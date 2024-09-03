<template>
    <GuestLayout
        title="Registration"
        subtitle="Register to view fenomenal examples"
    >
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <v-text-field
                    id="name"
                    label="Name"
                    type="text"
                    v-model="form.name"
                    autofocus
                    required
                    maxlength="50"
                    :disabled="form.processing"
                    :error-messages="form.errors.name"
                />
            </div>

            <div class="mt-4">
                <v-text-field
                    id="email"
                    label="Email"
                    type="email"
                    v-model="form.email"
                    required
                    maxlength="50"
                    :disabled="form.processing"
                    :error-messages="form.errors.email"
                />
            </div>

            <div class="mt-4">
                <v-text-field
                    id="password"
                    label="Password"
                    type="password"
                    v-model="form.password"
                    required
                    minlength="8"
                    maxlength="255"
                    :disabled="form.processing"
                    :error-messages="form.errors.password"
                />
            </div>

            <div class="mt-4">
                <v-text-field
                    id="password_confirmation"
                    label="Repeat password"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    minlength="8"
                    maxlength="255"
                    :rules="[confirmPasswordRule]"
                    :disabled="form.processing"
                    :error-messages="form.errors.password_confirmation"
                />
            </div>

            <div class="ml-2 mt-13">
                <v-btn
                    color="primary"
                    :disabled="form.processing"
                    type="submit"
                >
                    Register
                </v-btn>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

const confirmPasswordRule = () => {
    if (form.password == form.password_confirmation) {
        return true;
    } else {
        return 'Password and confirmation must match';
    }
}
</script>
