<template>
    <MainLayout title="Registrare">
        <v-container fluid class="h-100 guest-container">
            <v-row class="section-separator justify-center h-100">
                <v-col
                    cols="12"
                    sm="8"
                    md="6"
                >
                    <v-card class="pa-7" rounded="0">
                        <v-card-title class="text-h5 font-weight-bold ml-7 mt-2 pa-0">Registrare</v-card-title>
                        <v-card-subtitle class="guest-subtitle ml-3 mb-8">Vă rugăm să introduceți datele dvs. de conectare pentru identificare</v-card-subtitle>

                        <v-form @submit.prevent="submit">
                            <v-card-item class="mb-2">
                                <v-text-field
                                    label="Nume"
                                    v-model="form.last_name"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="[ requiredRule, maxFieldLengthRule ]"
                                    counter="255"
                                    :error-messages="form.errors.last_name"
                                />
                                <v-text-field
                                    label="Prenume"
                                    v-model="form.first_name"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="[ requiredRule, maxFieldLengthRule ]"
                                    counter="255"
                                    :error-messages="form.errors.first_name"
                                />
                                <v-text-field
                                    type="email"
                                    label="Email"
                                    v-model="form.email"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="emailRules"
                                    counter="255"
                                    :error-messages="form.errors.email"
                                />
                                <v-text-field
                                    type="password"
                                    label="Parola"
                                    v-model="form.password"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="passwordRules"
                                    counter="255"
                                    :error-messages="form.errors.password"
                                />
                                <v-text-field
                                    type="password"
                                    label="Confirmarea parolei"
                                    v-model="form.password_confirmation"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="[ (value) => confirmPasswordRule(value, form.password_confirmation), ...passwordRules ]"
                                    counter="255"
                                    :error-messages="form.errors.password_confirmation"
                                />
                                <v-text-field
                                    v-model="form.phone"
                                    label="Număr de telefon"
                                    :rules="phoneRules"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    type="tel"
                                    :error-messages="form.errors.phone"
                                />

                                <v-text-field
                                    v-model="form.company_name"
                                    :counter="250"
                                    label="Denumirea companiei"
                                    :rules="[maxFieldLengthRule]"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :error-messages="form.errors.company_name"
                                />

                                <v-textarea
                                    v-model="form.address"
                                    :counter="500"
                                    label="Adresa"
                                    :rules="[maxTextareaLengthRule]"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :error-messages="form.errors.address"
                                />

                                <v-text-field
                                    v-model="form.postal_code"
                                    :counter="10"
                                    label="Cod postal"
                                    hide-spin-buttons
                                    :rules="[value => maxLengthRule(value, 10)]"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    type="number"
                                    :error-messages="form.errors.postal_code"
                                />
                            </v-card-item>
                            <v-btn
                                type="submit"
                                size="large"
                                class="ml-6 mb-6"
                                color="primary"
                                :disabled="form.processing"
                                :loading="form.processing"
                            >
                                Registrare
                            </v-btn>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { requiredRule, maxLengthRule, maxFieldLengthRule, maxTextareaLengthRule, emailRules, passwordRules, confirmPasswordRule, phoneRules } from '@/Helpers/ValidationRules';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    company_name: '',
    phone: '',
    address: '',
    postal_code: '',
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
