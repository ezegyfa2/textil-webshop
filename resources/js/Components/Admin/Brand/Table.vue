<template>
    <v-container class="section-separator">
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-container fluid>
                        <v-row class="p-0">
                            <v-col
                                class="d-flex pa-0"
                                cols="12" sm="6" md="4"
                            >
                                <Link :href="route('admin.brand.create')">
                                    <v-btn 
                                        class="h-100 mr-5"
                                        text="Creați nouă"
                                        rounded="0"
                                    />
                                </Link>
                                <v-text-field
                                    v-model="search"
                                    placeholder="Cautare"
                                    hide-details="auto"
                                    density="compact"
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                    <v-data-table-server
                        v-model:page="page"
                        v-model:items-per-page="brandsPerPage"
                        class="pt-5"
                        :headers="headers"
                        :items="brands"
                        :items-length="brandsTotalCount"
                        items-per-page-text="Comenzi pe pagină"
                        :loading="loading"
                        item-value="name"
                        @update:options="loadItems"
                    >
                        <template v-slot:header.name>
                            <p class="text-h6 main-text">Nume</p>
                        </template>

                        <template v-slot:item.name="{ item }">
                            <p class="text-body-2">{{ item.name }}</p>
                        </template>
                        
                        <template v-slot:item.actions="{ item }">
                            <v-menu rounded>
                                <template v-slot:activator="{ props }">
                                    <v-btn
                                        color="transparent"
                                        elevation="0"
                                        icon="mdi-dots-vertical"
                                        v-bind="props"
                                    />
                                </template>
                                <v-card
                                    class="mx-auto"
                                    max-width="300"
                                >
                                    <v-list density="compact" class="text-secondary">
                                        <Link :href="route('admin.brand.edit', { brand: item.id })">
                                            <v-list-item
                                                prepend-icon="mdi-pencil-outline"
                                                slim
                                            >
                                                <v-list-item-title v-text="'Editare'"/>
                                            </v-list-item>
                                        </Link>
                                        <v-list-item
                                            prepend-icon="mdi-delete-outline"
                                            slim
                                            @click="() => deleteProductCategory(item)"
                                        >
                                            <v-list-item-title v-text="'Șterge'"/>
                                        </v-list-item>
                                    </v-list>
                                </v-card>
                            </v-menu>
                        </template>

                        <template v-slot:no-data>
                            <p class="text-body-1 py-10">Nu există date disponibile</p>
                        </template>
                    </v-data-table-server>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { addNotification, addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';

const page = ref(1);
const brandsPerPage = ref(10);
const search = ref('');
const loading = ref(false);
const brands = ref([]);
const brandsTotalCount = ref(0);
const headers = [
    {
        sortable: false,
        key: 'name',
    },
    {
        value: 'actions',
        sortable: false,
        align: 'end',
    },
];

watch(search, () => loadItems());

function loadItems(): void {
    loading.value = true;
    axios.get(route('admin.brand.fetch', {
        page: page.value,
        per_page: brandsPerPage.value,
        search: search.value,
    }))
    .then((response) => {
        brands.value = response.data.data;
        brandsTotalCount.value = response.data.meta.total;
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul încărcării datelor', 'error');
        brands.value = [];
        brandsTotalCount.value = 1;
    })
    .finally(() => {
        loading.value = false;
    });
}

function deleteProductCategory(brand) {
    loading.value = true;
    axios.delete(route('admin.brand.delete', {
        brand: brand.id,
    }))
    .then((response) => {
        loadItems();
    })
    .catch((error) => {
        console.error(error);
        addUnexpectedErrorNotification('în timpul ștergerii');
        loading.value = false;
    });
}
</script>

<style scoped>
.show-button {
    background-color: transparent !important;
}
</style>
