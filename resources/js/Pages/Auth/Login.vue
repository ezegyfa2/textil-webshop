<template>
    <GuestLayout 
        title="Login"
    >
        <v-container class="h-100">
            <v-row class="justify-center h-100">
                <v-col
                    class="h-100 d-flex flex-column justify-center"
                    cols="12"
                    sm="9"
                    md="6"
                >
                    <v-card
                        rounded="0"
                    >
                        <v-card-title class="text-h5 ml-3 mt-2 mb-8">Log in</v-card-title>

                        <v-form @submit.prevent="submit">
                            <v-card-item>
                                <v-text-field
                                    id="email"
                                    class="mb-4"
                                    type="email"
                                    label="Email"
                                    v-model="form.email"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    required
                                    maxlength="50"
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
                                    :disabled="form.processing"
                                    v-model:checked="form.remember"
                                />
                            </v-card-item>
                            <v-btn
                                type="submit"
                                size="large"
                                class="ml-3 mb-6"
                                color="primary"
                                :disabled="form.processing"
                                :loading="form.processing"
                            >
                                Log in
                            </v-btn>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

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
