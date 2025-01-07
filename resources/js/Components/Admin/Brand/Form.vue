<template>
    <v-container class="pt-16">
        <v-row class="justify-center">
            <v-col cols="12" sm="9" md="8">
                <v-card>
                    <v-card-title class="text-h5 ml-3 mt-2 mb-8">
                        {{ title.toUpperCase() }}
                    </v-card-title>

                    <v-card-text>
                        <v-form
                            ref="formTemplate"
                            @submit.prevent="submit"
                        >
                            <v-text-field
                                v-model="props.form.name"
                                :counter="250"
                                label="Nume"
                                hide-details="auto"
                                :rules="nameRules"
                                required
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error-messages="props.form.errors.name"
                            />

                            <ImageField
                                v-model:image="form.image"
                                upload_url="admin.brand.upload-image"
                                delete_url="admin.brand.delete-image"
                                :loading="form.processing"
                                required
                                :error-messages="props.form.errors.image"
                            />

                            <v-btn 
                                text="Save"
                                type="submit"
                                size="large"
                                rounded="0"
                                class="mt-5 mb-1"
                            />
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import ImageField from '@/Components/ImageField.vue';
import { nameRules, handleValidationErrors } from '@/Helpers/ValidationRules';
import { useGoTo } from 'vuetify';
import { useTemplateRef } from 'vue';

const props = defineProps({
    title: String,
    form: Object,
});

const emit = defineEmits(['submitted']);

const formTemplate = useTemplateRef('formTemplate');
const goTo = useGoTo();

async function submit() {
    const { valid } = await formTemplate.value.validate();
    
    if (valid) {
        emit('submitted');
    } else {
        handleValidationErrors(null, goTo);
    }
}
</script>
