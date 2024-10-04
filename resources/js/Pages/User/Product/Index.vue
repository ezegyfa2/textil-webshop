<template>
    <MainLayout>
        <v-container>
            <v-row>
                <v-col class="top-section-separator">
                    <v-card class="pa-3 mt-6 mt-sm-0 d-flex">
                        <v-btn
                            class="mr-3"
                            icon="mdi-filter"
                            @click="drawer = !drawer"
                        />
                        <v-text-field
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
                        <ProductTable
                            :filters="validatedFilters"
                            v-model:loading="loading"
                            v-model:error-messages="errorMessages"
                        />
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
        <v-navigation-drawer
            v-model="drawer"
            class="bg-surface top-0 h-100"
            elevation="2"
        >
            <v-form ref="filterForm">
                <v-expansion-panels 
                    v-model="panels"
                    multiple
                >
                    <v-expansion-panel
                        rounded="0"
                    >
                        <template v-slot:title>
                            <p class="text-h6 main-text">Prețuri</p>
                        </template>
                        <template v-slot:text>
                            <v-text-field
                                v-model="fromPrice"
                                placeholder="De la preț"
                                class="text-body-2 main-text"
                                type="number"
                                step=".01"
                                density="comfortable"
                                variant="solo"
                                clearable
                                :rules="[pozitiveRule]"
                                :disabled="loading"
                                :loading="loading"
                                :error-messages="errorMessages.from_price"
                            />
                            <v-text-field
                                v-model="toPrice"
                                placeholder="La preț"
                                class="text-body-2 main-text"
                                type="number"
                                step=".01"
                                density="comfortable"
                                variant="solo"
                                clearable
                                :rules="[toPriceMinRule, pozitiveRule]"
                                :disabled="loading"
                                :loading="loading"
                                :error-messages="errorMessages.to_price"
                            />
                        </template>
                    </v-expansion-panel>
                    <v-expansion-panel rounded="0">
                        <template v-slot:title>
                            <p class="text-h6 main-text">Categorii</p>
                        </template>
                        <template v-slot:text>
                            <v-list-item
                                v-for="category in categories"
                                :key="category.name"
                                class="d-flex justify-end"
                            >
                                <v-checkbox
                                    v-model="selectedCategoryIds"
                                    :value="category.id"
                                    density="compact"
                                    hide-details
                                    :disabled="loading"
                                >
                                    <template v-slot:prepend>
                                        <p class="text-body-2 main-text">{{ category.name }}</p>
                                    </template>
                                </v-checkbox>
                            </v-list-item>
                        </template>
                    </v-expansion-panel>
                    <v-expansion-panel rounded="0">
                        <template v-slot:title>
                            <p class="text-h6 main-text">Dimensiuni</p>
                        </template>
                        <template v-slot:text>
                            <v-list-item
                                v-for="size in sizes"
                                :key="size.name"
                                class="d-flex justify-end"
                            >
                                <v-checkbox
                                    v-model="selectedSizeIds"
                                    :value="size.id"
                                    density="compact"
                                    hide-details
                                    :disabled="loading"
                                >
                                    <template v-slot:prepend>
                                        <p class="text-body-2 main-text">{{ size.name }}</p>
                                    </template>
                                </v-checkbox>
                            </v-list-item>
                        </template>
                    </v-expansion-panel>
                    <v-expansion-panel rounded="0">
                        <template v-slot:title>
                            <p class="text-h6 main-text">Culorile</p>
                        </template>
                        <template v-slot:text>
                            <v-list-item
                                v-for="color in colors"
                                :key="color.name"
                                class="d-flex justify-end"
                            >
                                <v-checkbox
                                    v-model="selectedColorIds"
                                    :value="color.id"
                                    density="compact"
                                    hide-details
                                    :disabled="loading"
                                >
                                    <template v-slot:prepend>
                                        <p class="text-body-2 main-text">{{ color.name }}</p>
                                    </template>
                                </v-checkbox>
                            </v-list-item>
                        </template>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-form>
        </v-navigation-drawer>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import ProductTable from '@/Components/User/Product/Table.vue';
import { maxFieldLengthRule, minRule, pozitiveRule, numberRule } from '@/Helpers/ValidationRules';
import { ref, computed, watch, useTemplateRef } from 'vue';

const props = defineProps<{
    sizes: Array,
    colors: Array,
    categories: Array,
}>();

const search = ref('');
const fromPrice = ref(null);
const toPrice = ref(null);
const selectedCategoryIds = ref([]);
const selectedSizeIds = ref([]);
const selectedColorIds = ref([]);
const loading = ref(false);
const errorMessages = ref({});
const drawer = ref(false);
const panels = ref([0, 1, 2, 3]);
const validatedFilters = ref({});
const filterFormComponent = useTemplateRef('filterForm');

const filters = computed(() => {
    return {
        search: search.value,
        from_price: fromPrice.value,
        to_price: toPrice.value,
        category_ids: selectedCategoryIds.value,
        size_ids: selectedSizeIds.value,
        color_ids: selectedColorIds.value,
    };
});

watch(filters, (newFilters) => {
    if (filterFormComponent.value) {
        filterFormComponent.value.validate().then((result) => {
            if (result.valid) {
                validatedFilters.value = newFilters;
            }
        });
    }
});

function toPriceMinRule(value) {
    if (fromPrice.value === null || fromPrice.value === '') {
        return true;
    } else {
        return minRule(value, fromPrice.value);
    }
}
</script>
