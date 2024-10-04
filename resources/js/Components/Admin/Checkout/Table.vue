<template>
    <v-container class="section-separator">
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-container fluid>
                        <v-row class="p-0">
                            <v-col class="pa-0" cols="12" sm="6" md="4" lg="3">
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
                        v-model:items-per-page="checkoutsPerPage"
                        class="pt-5"
                        :headers="headers"
                        :items="checkouts"
                        :items-length="checkoutsTotalCount"
                        items-per-page-text="Comenzi pe pagină"
                        :loading="loading"
                        item-value="name"
                        @update:options="loadItems"
                    >
                        <template v-slot:header.name>
                            <p class="text-h6 main-text">Nume</p>
                        </template>
                        <template v-slot:header.company_name>
                            <p class="text-h6 main-text">Denumirea companiei</p>
                        </template>
                        <template v-slot:header.total_price>
                            <p class="text-h6 main-text">Preț total</p>
                        </template>
                        <template v-slot:header.items_count>
                            <p class="text-h6 main-text">Cantitatea de produse</p>
                        </template>
                        <template v-slot:header.created_at>
                            <p class="text-h6 main-text">Data</p>
                        </template>

                        <template v-slot:item.name="{ item }">
                            <p class="text-body-2">{{ item.name }}</p>
                        </template>
                        <template v-slot:item.company_name="{ item }">
                            <p class="text-body-2">{{ item.company_name }}</p>
                        </template>
                        <template v-slot:item.total_price="{ item }">
                            <p class="text-body-2">{{ item.total_price }} RON</p>
                        </template>
                        <template v-slot:item.items_count="{ item }">
                            <p class="text-body-2">{{ item.items_count }}</p>
                        </template>
                        <template v-slot:item.created_at="{ item }">
                            <p class="text-body-2">{{ item.created_at }}</p>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <Link :href="route('admin.checkout.show', item.id)">
                                <v-btn 
                                    class="show-button"
                                    icon="mdi-eye"
                                    elevation="0"
                                />
                            </Link>
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
import { addNotification } from '@/Layouts/Notification/AddNotification';

const page = ref(1);
const checkoutsPerPage = ref(10);
const search = ref('');
const loading = ref(false);
const checkouts = ref([]);
const checkoutsTotalCount = ref(0);
const headers = [
    {
        title: 'Nume',
        sortable: false,
        key: 'name',
    },
    {
        title: 'Denumirea companiei',
        sortable: false,
        key: 'company_name',
    },
    {
        title: 'Preț total',
        sortable: false,
        key: 'total_price',
    },
    {
        title: 'Cantitatea de produse',
        sortable: false,
        key: 'items_count',
    },
    {
        title: 'Data',
        sortable: false,
        key: 'created_at',
    },
    {
        value: 'actions',
        sortable: false,
        align: 'end',
    },
];

watch(search, () => loadItems());

function loadItems(): void {
    axios.get(route('admin.checkout.fetch', {
        page: page.value,
        per_page: checkoutsPerPage.value,
        search: search.value,
    }))
    .then((resp) => {
        checkouts.value = resp.data.data;
        checkoutsTotalCount.value = resp.data.meta.total;
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul încărcării datelor', 'error');
        checkouts.value = [];
        checkoutsTotalCount.value = 1;
    })
    .finally(() => {
        loading.value = false;
    });
}
</script>

<style scoped>
.show-button {
    background-color: transparent !important;
}
</style>
