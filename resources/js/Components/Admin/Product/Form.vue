<template>
    <v-container class="section-separator">
        <v-card>
            <v-card-title class="text-h5 ml-3 mt-2 mb-8">
                {{ title.toUpperCase() }}
            </v-card-title>

            <v-card-text>
                <v-form @submit.prevent="$emit('submitted')">
                    <v-row class="justify-center">
                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="props.form.name"
                                :counter="250"
                                label="Name"
                                :rules="nameRules"
                                required
                                :error-messages="props.form.errors.name"
                            />
                        </v-col>

                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="props.form.gram_per_m2"
                                label="g/m2"
                                :rules="[requiredRule, numberRule, (value) => minRule(value, 0)]"
                                required
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
                                label="Brand"
                                :rules="[requiredRule]"
                                :disabled="form.processing"
                                :loading="form.processing"
                                :error_messages="props.form.errors.brand"
                            />
                        </v-col>
                        
                        <v-col cols="12">
                            <v-btn 
                                text="Save"
                                type="submit"
                                size="large"
                                rounded="2"
                                class="my-5"
                            />
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
        
        <v-card class="mt-8">
            <v-card-text class="py-8 px-sm-8">
                <v-row>
                    <v-col cols="12">
                        <ImageDrop
                            label="Képek"
                            v-model:images="form.images"
                            v-model:main-image="form.main_image"
                            :loading="form.processing"
                            v-model:errors="form.errors.images"
                        />
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>

    </v-container>
</template>

<script lang="ts" setup>
import SearchField from '@/Components/SearchField.vue';
import ImageDrop from '@/Components/Admin/Product/ImageDrop.vue';
import { InertiaForm } from '@inertiajs/vue3';
import User from '@/types/user';
import { requiredRule, numberRule, nameRules, minRule } from '@/Helpers/ValidationRules';

const props = defineProps<{
    title: string,
    form: InertiaForm<User>,
}>();
</script>
