<template>
    <v-container>
        <v-row class="justify-center">
            <v-col cols="12" sm="9" md="8">
                <v-card>
                    <v-card-title class="text-h5 ml-3 mt-2 mb-8">
                        {{ title.toUpperCase() }}
                    </v-card-title>

                    <v-card-text>
                        <v-form @submit.prevent="$emit('submit')">
                            <v-text-field
                                v-model="props.form.name"
                                :counter="250"
                                label="Name"
                                hide-details="auto"
                                :rules="nameRules"
                                required
                                :error-messages="props.form.errors.name"
                            />

                            <v-text-field
                                v-model="props.form.email"
                                :counter="250"
                                label="Email"
                                hide-details="auto"
                                :rules="emailRules"
                                required
                                :error-messages="props.form.errors.email"
                            />

                            <v-text-field
                                v-model="props.form.password"
                                :counter="250"
                                label="Password"
                                hide-details="auto"
                                :rules="passwordRules"
                                required
                                type="password"
                                :error-messages="props.form.errors.password"
                            />

                            <v-btn 
                                text="Save"
                                type="submit"
                                size="large"
                                rounded="2"
                                class="my-5"
                            />
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script lang="ts" setup>
import { InertiaForm } from '@inertiajs/vue3';
import User from '@/types/user';
import { passwordRules, nameRules, emailRules } from '@/Components/ValidationRules';

const props = defineProps<{
    title: string,
    form: InertiaForm<User>,
}>();
</script>
