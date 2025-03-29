<template>
    <v-container class="pt-16">
        <v-form
            ref="formTemplate"
            @submit.prevent="submit"
        >
            <h1 class="text-h5 ml-3 mt-2 mb-8">{{ title.toUpperCase() }}</h1>
            <v-card class="mb-8">
                <v-card-text>
                    <v-row class="justify-center">
                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="props.form.name"
                                :counter="250"
                                label="Nume"
                                :rules="nameRules"
                                required
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error-messages="props.form.errors.name"
                            />
                        </v-col>

                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="props.form.gram_per_m2"
                                label="g/m2"
                                type="number"
                                :rules="[requiredRule, numberRule, (value) => minRule(value, 0)]"
                                hide-spin-buttons
                                required
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error-messages="props.form.errors.email"
                            />
                        </v-col>

                        <v-col cols="12" sm="6">
                            <SearchField
                                v-model="props.form.product_category"
                                search_route="admin.product.search-category"
                                label="Categorie"
                                :rules="[requiredRule]"
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error_messages="props.form.errors.product_category"
                            />
                        </v-col>

                        <v-col cols="12" sm="6">
                            <SearchField
                                v-model="props.form.brand"
                                search_route="admin.product.search-brand"
                                label="Brandul"
                                :rules="[requiredRule]"
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error_messages="props.form.errors.brand"
                            />
                        </v-col>
                        
                        <v-col cols="12" sm="6">
                            <v-select
                                v-model="props.form.gender"
                                :items="genders"
                                label="Gen"
                                placeholder="Gen"
                                :rules="[requiredRule]"
                                :error-messages="props.form.errors.gender"
                            />
                        </v-col>

                        <v-col cols="12" sm="6">
                            <SearchCombobox
                                v-model="form.fabric_properties"
                                search_route="admin.product.search-fabric-property"
                                label="Material"
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error_messages="form.errors['fabric_properties']"
                            />
                        </v-col>

                        <v-col cols="12">
                            <SearchCombobox
                                v-model="form.cut_properties"
                                search_route="admin.product.search-cut-property"
                                label="Taietura"
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error_messages="form.errors['cut_properties']"
                            />
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <Sizes
                v-model="form.sizes"
                :loading="form.processing"
            />
            
            <Prices
                v-model="props.form"
                :size_names="sizeNames"
                :available_colors="available_colors"
            />

            <v-card class="mt-10">
                <v-card-text class="py-8 px-sm-8">
                    <v-row>
                        <v-col cols="12">
                            <ImageDrop
                                label="Imagini"
                                v-model:images="form.images"
                                v-model:main-image="form.main_image"
                                :loading="form.processing"
                                v-model:errors="form.errors.images"
                            />
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <v-row class="mt-5">
                <v-col cols="12">
                    <v-btn 
                        text="Salvați"
                        type="submit"
                        size="x-large"
                        rounded="0"
                        class="my-5"
                    />
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script setup>
import Sizes from '@/Components/Admin/Product/Sizes.vue';
import Prices from '@/Components/Admin/Product/Prices.vue';
import SearchField from '@/Components/SearchField.vue';
import SearchCombobox from '@/Components/SearchCombobox.vue';
import ImageDrop from '@/Components/Admin/Product/ImageDrop.vue';
import { handleValidationErrors, requiredRule, numberRule, nameRules, minRule } from '@/Helpers/ValidationRules';
import { useGoTo } from 'vuetify';
import { ref, computed, useTemplateRef } from 'vue';

const props = defineProps({
    title: String,
    form: Object,
    available_colors: Array,
    genders: Array,
});

if (props.form.sizes.length == 0) {
    props.form.sizes = [
        [
            'type',
            'S',
        ],
        [
            'Lungime',
            '20',
        ],
    ];
}

const formTemplate = useTemplateRef('formTemplate');
const goTo = useGoTo();

const sizeNames = computed(() => {
    if (props.form.sizes.length > 0) {
        return props.form.sizes[0].slice(1).filter(size => size !== null && size !== '');
    } else {
        return [];
    }
});

const emit = defineEmits(['submitted']);

async function submit() {
    const { valid } = await formTemplate.value.validate();
    
    if (valid) {
        emit('submitted');
    } else {
        handleValidationErrors(null, goTo);
    }
}
</script>
