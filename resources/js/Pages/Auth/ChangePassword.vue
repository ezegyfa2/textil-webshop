<template>
    <MainLayout title="Resetarea parola">
        <v-container fluid class="h-100 guest-container">
            <v-row class="section-separator justify-center h-100">
                <v-col cols="12" sm="8" md="5">
                    <v-card class="pa-7" max-width="500" rounded="0">
                        <v-card-title class="text-h5 font-weight-bold ml-7 mt-2 pa-0">Resetarea parola</v-card-title>
                        <v-card-subtitle class="guest-subtitle ml-3 mb-8">Vă rugăm să introduceți parolă nouă</v-card-subtitle>

                        <v-form
                            ref="formTemplate"
                            @submit.prevent="submit"
                        >
                            <v-card-item>
                                <v-text-field
                                    type="password"
                                    label="Password"
                                    v-model="form.password"
                                    counter="255"
                                    required
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="passwordRules"
                                    :error-messages="form.errors.password"
                                />
                                <v-text-field
                                    type="password"
                                    label="Confirmarea parolei"
                                    v-model="form.password_confirmation"
                                    counter="255"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="[ (value) => confirmPasswordRule(value, form.password), ...passwordRules ]"
                                    :error-messages="form.errors.password_confirmation"
                                />
                            </v-card-item>
                            <v-btn
                                type="submit"
                                size="large"
                                class="ml-4 mb-6"
                                color="primary"
                                :disabled="form.processing"
                                :loading="form.processing"
                            >
                                Modificarea parola
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
import { passwordRules, confirmPasswordRule, handleValidationErrors } from '@/Helpers/ValidationRules';
import { useForm } from '@inertiajs/vue3';
import { useGoTo } from 'vuetify';
import { useTemplateRef } from 'vue';

const formTemplate = useTemplateRef('formTemplate');
const goTo = useGoTo();
const form = useForm({
    password: '',
    password_confirmation: '',
});

async function submit() {
    const { valid } = await formTemplate.value.validate();
    
    if (valid) {
        form.post(route('profile.password.update'), {
            preserveScroll: true,
            onError: (errors) => {
                handleValidationErrors(errors, goTo);
                form.reset('password', 'password_confirmation');
            },
        });
    } else {
        handleValidationErrors(null, goTo);
    }
}
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
