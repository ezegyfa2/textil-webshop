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
                                <Link :href="route('admin.blog.create')">
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
                        v-model:items-per-page="blogsPerPage"
                        class="pt-5"
                        :headers="headers"
                        :items="blogs"
                        :items-length="blogsTotalCount"
                        items-per-page-text="Comenzi pe pagină"
                        :loading="loading"
                        item-value="title"
                        @update:options="loadItems"
                    >
                        <template v-slot:header.title>
                            <p class="text-h6 main-text">Titlu</p>
                        </template>

                        <template v-slot:item.title="{ item }">
                            <p class="text-body-2">{{ item.title }}</p>
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
                                        <Link :href="route('admin.blog.edit', { blog: item.id })">
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
                                            @click="showConfirmDelete(item)"
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
        <confirms-modal 
            v-model:show="showDeleteModal"
            title="Sunteți sigur că doriți să ștergeți?"
            content="Faceți clic pentru a șterge acest element"
            @confirmed="deleteBlog"
        />
    </v-container>
</template>

<script setup lang="ts">
import ConfirmsModal from '@/Components/ConfirmsModal.vue';
import { ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { addNotification, addUnexpectedErrorNotification } from '@/Layouts/Notification/AddNotification';

const selectedBlogId = ref(null);
const showDeleteModal = ref(false);
const page = ref(1);
const blogsPerPage = ref(10);
const search = ref('');
const loading = ref(false);
const blogs = ref([]);
const blogsTotalCount = ref(0);
const headers = [
    {
        sortable: false,
        key: 'title',
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
    axios.get(route('admin.blog.fetch', {
        page: page.value,
        per_page: blogsPerPage.value,
        search: search.value,
    }))
    .then((response) => {
        blogs.value = response.data.data;
        blogsTotalCount.value = response.data.meta.total;
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul încărcării datelor', 'error');
        blogs.value = [];
        blogsTotalCount.value = 1;
    })
    .finally(() => {
        loading.value = false;
    });
}

function showConfirmDelete(item) {
    if (item.id) {
        selectedBlogId.value = item.id;
        showDeleteModal.value = true;
    } else {
        addUnexpectedErrorNotification();
    }
}

function deleteBlog() {
    loading.value = true;
    axios.delete(route('admin.blog.delete', {
        blog: selectedBlogId.value,
    }))
    .then((response) => {
        loadItems();
    })
    .catch((error) => {
        console.error(error);
        addUnexpectedErrorNotification();
        loading.value = false;
    });
}
</script>

<style scoped>
.show-button {
    background-color: transparent !important;
}
</style>
