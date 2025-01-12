<template>
    <MainLayout title="Resetarea parola">
        <v-container fluid class="h-100 guest-container">
            <v-row class="section-separator justify-center h-100">
                <v-col cols="12" sm="8" md="5">
                    <v-card class="pa-7" max-width="500" rounded="0">
                        <v-card-title class="text-h5 font-weight-bold ml-7 mt-2 pa-0">Resetarea parola</v-card-title>
                        <v-card-subtitle class="guest-subtitle ml-3 mb-8">
                            Vă rugăm să introduceți adresa dvs. de e-mail și vă vom trimite un link de resetare a parolei care vă va permite să alegeți una nouă.
                        </v-card-subtitle>

                        <v-form
                            ref="formTemplate"
                            @submit.prevent="submit"
                        >
                            <v-card-item>
                                <v-text-field
                                    v-model="form.email"
                                    class="mb-4"
                                    label="Email"
                                    type="email"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :rules="emailRules"
                                    required
                                    :error-messages="form.errors.email"
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
                                Resetarea parola
                            </v-btn>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/User/MainLayout.vue';
import { emailRules, handleValidationErrors } from '@/Helpers/ValidationRules';
import { useGoTo } from 'vuetify';
import { useTemplateRef } from 'vue';

const formTemplate = useTemplateRef('formTemplate');
const goTo = useGoTo();
const form = useForm({
    email: '',
});

async function submit() {
    const { valid } = await formTemplate.value.validate();
    
    if (valid) {
        form.post(route('send-password-link'), {
            preserveScroll: true,
            onError: (errors) => {
                handleValidationErrors(errors, goTo);
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
