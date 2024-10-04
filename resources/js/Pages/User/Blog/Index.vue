<template>
    <MainLayout>
        <v-container>
            <v-row>
                <v-col class="top-section-separator">
                    <v-card class="pa-3 mt-6 mt-sm-0 d-flex">
                        <v-text-field
                            ref="searchField"
                            v-model="search"
                            density="comfortable"
                            placeholder="Căutare"
                            prepend-inner-icon="mdi-magnify"
                            style="max-width: 300px;"
                            variant="solo"
                            clearable
                            :rules="[maxFieldLengthRule]"
                            :disabled="loading"
                            :loading="loading"
                            :error-messages="errorMessages.search"
                        />
                    </v-card>
                    <v-card>
                        <BlogTable
                            :search="validatedSearch"
                            v-model:loading="loading"
                            v-model:error-messages="errorMessages"
                        />
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import BlogTable from '@/Components/User/Blog/Table.vue';
import { maxFieldLengthRule } from '@/Helpers/ValidationRules';
import { ref, watch, useTemplateRef } from 'vue';

const search = ref(null);
const loading = ref(false);
const errorMessages = ref({});
const validatedSearch = ref('');
const searchComponent = useTemplateRef('searchField');

watch(search, (newSearch) => {
    if (searchComponent.value) {
        searchComponent.value.validate().then((result) => {
            if (result.length == 0) {
                validatedSearch.value = newSearch;
            }
        });
    }
});
</script>
