<template>
    <v-container class="section-separator">
        <v-row class="pt-2">
            <v-col cols="12" class="d-flex justify-space-between align-center">
                <Link :href="route('admin.user.create')">
                    <v-btn
                        prepend-icon="mdi-plus"
                        text="Creați noi"
                    />
                </Link>
                <v-btn
                    prepend-icon="mdi-delete-outline"
                    text="Ștergeți toate"
                    @click="showDeleteAllModal = true"
                    color="error"
                />
            </v-col>
        </v-row>
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
                        class="pt-5"
                        :headers="headers"
                        v-model:page="page"
                        v-model:items-per-page="itemsPerPage"
                        :items="users"
                        :items-length="usersTotalCount"
                        items-per-page-text="Utilizatori pe pagină"
                        :loading="loading"
                        item-value="name"
                        @update:options="loadItems"
                    >
                        <template v-slot:header.name>
                            <p class="text-h6 main-text">Nume</p>
                        </template>
                        <template v-slot:header.email>
                            <p class="text-h6 main-text">Email</p>
                        </template>
                        <template v-slot:item.name="{ item }">
                            <p class="text-body-2">{{ item.name }}</p>
                        </template>
                        <template v-slot:item.email="{ item }">
                            <p class="text-body-2">{{ item.email }}</p>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-menu rounded>
                                <template v-slot:activator="{ props }">
                                    <v-btn 
                                        class="actions-button"
                                        text="asd"
                                        elevation="0"
                                        icon="mdi-dots-vertical"
                                        v-bind="props"
                                    />
                                </template>
                                <v-card
                                    class="mx-auto"
                                    max-width="300">
                                    <v-list density="compact">
                                        <Link :href="route('admin.user.edit', item.id)">
                                            <v-list-item
                                                prepend-icon="mdi-pencil-outline"
                                                slim
                                            >
                                                <v-list-item-title v-text="'Edit'"/>
                                            </v-list-item>
                                        </Link>
                                        <Link :href="route('admin.user.create')">
                                            <v-list-item
                                                prepend-icon="mdi-delete-outline"
                                                slim
                                            >
                                                <v-list-item-title v-text="'Delete'"/>
                                            </v-list-item>
                                        </Link>
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
        <confirms-modal 
            v-model:show="showDeleteModal"
            title="Sunteți sigur că doriți să ștergeți?"
            content="Faceți clic pentru a șterge acest element"
            @confirmed="deleteItem()"
        />
        <confirms-modal 
            v-model:show="showDeleteAllModal"
            title="Sunteți sigur că doriți să ștergeți?"
            content="Faceți clic pentru a șterge toate elementele"
            @confirmed="deleteAll()"
        />
    </v-container>
</template>

<script lang="ts" setup>
import { ref, Ref, computed, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import User from '@/types/user';
import ConfirmsModal from '@/Components/ConfirmsModal.vue';
import { addNotification } from '@/Layouts/Notification/AddNotification';

let page = ref(1);
let itemsPerPage = ref(10);
let search = ref('');
let loading = ref(false);
let users: Ref<User[]> = ref([]);
let usersTotalCount = ref(0);
let selectedId = ref();
let showDeleteModal = ref(false);
let showDeleteAllModal = ref(false);
let headers = computed(() => [
    {
        title: 'Nume',
        sortable: false,
        key: 'name',
    },
    {
        title: 'Email',
        sortable: false,
        key: 'email',
    },
    {
        value: 'actions',
        sortable: false,
        align: 'end',
    },
]);

watch(search, () => loadItems());

function deleteItem(): void {
    loading.value = true;
    axios.post(route('admin.user.delete', [selectedId]))
        .then((resp) => {
            addNotification('Utilizator șters cu succes', 'success');
            loadItems();
        })
        .catch((error) => {
            console.error(error);
            addNotification('A apărut o eroare neașteptată în timpul ștergerii elementului', 'error');
            loading.value = false;
        })
        .finally(() => {
            selectedId.value = null;
        });
}

function showConfirmDelete(item: User): void {
    if (item.id) {
        selectedId.value = item.id;
        showDeleteModal.value = true;
    } else {
        addNotification('A apărut o eroare neașteptată în timpul ștergerii', 'error');
    }
}

function deleteAll(): void {
    loading.value = true;
    axios.post(route('admin.user.delete-all'))
        .then((resp) => {
            addNotification('Utilizatori șterși cu succes', 'success');
            users.value = [];
        })
        .catch((error) => {
            console.error(error);
            addNotification('A apărut o eroare neașteptată în timpul ștergerii elementului', 'error');
        })
        .finally(() => {
            loading.value = false;
            selectedId.value = null;
        });
}

function loadItems(): void {
    axios.get(route('admin.user.fetch', {
        page: page.value,
        per_page: itemsPerPage.value,
        search: search.value,
    }))
    .then((resp) => {
        users.value = resp.data.data;
        usersTotalCount.value = resp.data.meta.total;
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul încărcării datelor', 'error');
        users.value = [];
        usersTotalCount.value = 1;
    })
    .finally(() => {
        loading.value = false;
    });
}
</script>

<style scoped>
.actions-button {
    background-color: transparent !important;
}
</style>
