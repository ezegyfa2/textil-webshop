<template>
    <GuestLayout 
        title="Login"
        subtitle="Log in for the best example in the world"
    >
        <Head title="Log in" />

        <div v-if="status" class="ml-2 mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <v-text-field
                id="email"
                class="mb-4"
                type="email"
                label="Email"
                v-model="form.email"
                :disabled="form.processing"
                :loading="form.processing"
                required
                maxlength ="50"
                :error-messages="form.errors.email"
            />
            <v-text-field
                id="password"
                type="password"
                label="Password"
                v-model="form.password"
                :disabled="form.processing"
                :loading="form.processing"
                required
                minlength="8"
                maxlength ="255"
                :error-messages="form.errors.password"
            />
            <v-checkbox 
                name="remember"
                label="Remember me"
                class="ml-1"
                :disabled="form.processing"
                v-model:checked="form.remember"
            />

            <div class="ml-2 mt-13">
                <v-btn
                    type="submit"
                    color="primary"
                    :disabled="form.processing"
                    :loading="form.processing"
                >
                    Log in
                </v-btn>

                <Link
                    :href="form.processing ? '' : route('password.request')"
                    :disabled="form.processing"
                >
                    Forgot your password?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
        onError: (error) => {
            console.log(error)
        }
    });
};
</script>
