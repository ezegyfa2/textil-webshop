<template>
    <v-container>
        <v-row class="button-row">
            <v-col cols="12" sm="6" md="8" class="d-flex justify-space-between align-center">
                <Link :href="route('admin:user.create')">
                    <v-btn
                        prepend-icon="mdi-plus"
                        text="Create new"
                        elevation="0"
                        rounded="2"
                    />
                </Link>
                <v-btn
                    prepend-icon="mdi-delete-outline"
                    text="Delete all"
                    elevation="0"
                    rounded="2"
                    @click="showDeleteAllModal = true"
                    color="error"
                />
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-card outlined class="pa-5">
                    <v-container fluid>
                        <v-row class="p-0">
                            <v-col class="pa-0" cols="12" sm="6" md="4" lg="3">
                                <v-text-field
                                    v-model="search"
                                    placeholder="Search"
                                    hide-details="auto"
                                    rounded="2"
                                    density="compact"
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                    <v-data-table-server
                        v-model:page="tablePage"
                        v-model:items-per-page="itemsPerPage"
                        :headers="headers"
                        :items="users"
                        :items-length="usersTotalCount"
                        items-per-page-text="Users per page"
                        :loading="loading"
                        item-value="name"
                        @update:options="loadItems"
                    >
                        <template v-slot:item.actions="{ item }">
                            <v-menu rounded>
                                <template v-slot:activator="{ props }">
                                    <v-btn 
                                        class="actions-button"
                                        text="asd"
                                        elevation="0"
                                        rounded
                                        icon="mdi-dots-vertical"
                                        v-bind="props"
                                    />
                                </template>
                                <v-card
                                    class="mx-auto"
                                    max-width="300">
                                    <v-list density="compact">
                                        <Link :href="route('admin:user.edit', item.id)">
                                            <v-list-item
                                                prepend-icon="mdi-pencil-outline"
                                                slim
                                            >
                                                <v-list-item-title v-text="'Edit'"/>
                                            </v-list-item>
                                        </Link>
                                        <Link :href="route('admin:user.create')">
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
                    </v-data-table-server>
                </v-card>
            </v-col>
        </v-row>
        <confirms-modal 
            v-model:show="showDeleteModal"
            title="Are you sure to delete?"
            content="Click to delete this item"
            @confirmed="deleteItem()"
        />
        <confirms-modal 
            v-model:show="showDeleteAllModal"
            title="Are you sure to delete?"
            content="Click to delete all items"
            @confirmed="deleteAll()"
        />
    </v-container>
</template>

<script lang="ts" setup>
import { ref, Ref, computed, watch } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import axios from 'axios';
import User from '@/types/user';
import ConfirmsModal from '@/Components/ConfirmsModal.vue';

let tablePage = ref(1);
let itemsPerPage = ref(10);
let search = ref('');
let loading = ref(false);
let users: Ref<User[]> = ref([]);
let usersTotalCount = ref(0);
let selectedId = ref();
let showDeleteModal = ref(false);
let showDeleteAllModal = ref(false);
const page = usePage();
let headers = computed(() => [
    {
        title: 'ID',
        sortable: false,
        key: 'id',
    },
    {
        title: 'Name',
        sortable: false,
        key: 'name',
    },
    {
        title: 'Email',
        sortable: false,
        key: 'email',
    },
    {
        title: 'Created at',
        sortable: false,
        key: 'created_at',
    },
    {
        title: 'Email verified at',
        sortable: false,
        key: 'email_verified_at',
    },
    {
        value: 'actions',
        title: 'Actions',
        sortable: false,
        align: 'end',
    },
]);

watch(search, () => loadItems());

function deleteItem(): void {
    loading.value = true;
    axios.post(route('admin:user.delete', [selectedId]))
        .then((resp) => {
            page.props.notifications.push({
                type: 'success',
                message: 'User successfully deleted',
            });
            loadItems();
        })
        .catch((error) => {
            console.error(error);
            page.props.notifications.push({
                type: 'error',
                message: 'An unexpected error occured while deleting item',
            });
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
        page.props.notifications.push({
            type: 'error',
            message: 'An unexpected error occured during delete',
        });
    }
}

function deleteAll(): void {
    loading.value = true;
    axios.post(route('admin:user.delete-all'))
        .then((resp) => {
            page.props.notifications.push({
                type: 'success',
                message: 'User successfully deleted',
            });
            users.value = [];
        })
        .catch((error) => {
            console.error(error);
            page.props.notifications.push({
                type: 'error',
                message: 'An unexpected error occured while deleting item',
            });
        })
        .finally(() => {
            loading.value = false;
            selectedId.value = null;
        });
}

function loadItems(): void {
    axios.get(route('admin:user.fetch'), {
        page: tablePage.value,
        per_page: itemsPerPage.value,
        search: search.value,
    })
    .then((resp) => {
        users.value = resp.data.data;
        usersTotalCount.value = Math.ceil(resp.data.meta.total / resp.data.meta.per_page);
    })
    .catch((error) => {
        console.error(error);
        page.props.notifications.push({
            type: 'error',
            message: 'An unexpected error occured while loading data',
        });
        users.value = [];
        usersTotalCount.value = 1;
    })
    .finally(() => {
        loading.value = false;
    });
}
</script>

<style scoped>
.button-row {
    padding-top: 2rem;
}
.filter-row {
    padding-bottom: 2rem;
}
.actions-button {
    background-color: transparent !important;
}
</style>
