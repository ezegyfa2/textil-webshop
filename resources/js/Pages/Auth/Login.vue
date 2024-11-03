<template>
    <MainLayout title="Login">
        <v-container fluid class="h-100 guest-container">
            <v-row class="section-separator justify-center h-100">
                <v-col
                    cols="12"
                    sm="8"
                    md="5"
                >
                    <v-card class="pa-7" max-width="500" rounded="0">
                        <v-card-title class="text-h5 font-weight-bold ml-7 mt-2 pa-0">Logare</v-card-title>
                        <v-card-subtitle class="guest-subtitle ml-3 mb-8">Vă rugăm să introduceți datele dvs. de conectare pentru identificare</v-card-subtitle>

                        <v-form @submit.prevent="submit">
                            <v-card-item>
                                <v-text-field
                                    class="mb-4"
                                    type="email"
                                    label="Email"
                                    v-model="form.email"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    required
                                    maxlength="255"
                                    :error-messages="form.errors.email"
                                />
                                <v-text-field
                                    type="password"
                                    label="Parola"
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
                                    label="Amintește-ți de mine"
                                    :disabled="form.processing"
                                    v-model:checked="form.remember"
                                />
                            </v-card-item>
                            <div class="d-flex justify-space-between align-center mx-6 mb-6">
                                <v-btn
                                    type="submit"
                                    size="large"
                                    color="primary"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                >
                                    Log in
                                </v-btn>
                                <Link
                                    :href="form.processing ? '' : route('forgot-password')"
                                    :disabled="form.processing"
                                >
                                    <p class="text-body-1 main-text">Ați uitat parola?</p>
                                </Link>
                            </div>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/User/MainLayout.vue';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onError: (error) => {
            console.log(error)
        },
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<style>
.guest-container {
    background-image: url('/storage/images/Header background 3.webp');
    background-repeat: no-repeat;
    background-size: cover;
}
.guest-subtitle {
    text-wrap: wrap !important;
    padding-left: 17px !important;
}
</style>
