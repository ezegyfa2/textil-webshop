<template>
    <v-data-table-server
        v-model:page="page"
        v-model:items-per-page="itemsPerPage"
        :items="items"
        :items-length="itemsTotalCount"
        :headers="headers"
        first-icon=""
        last-icon=""
        :hide-default-footer="itemsTotalCount <= 10"
        disable-sort
        @update:options="loadItems"
    >
        <template v-slot:header.image="{ column }">
            <p class="text-h6 main-text">Produs</p>
        </template>
        <template v-slot:header.price="{ column }">
            <p class="text-h6 text-center main-text">Preț</p>
        </template>
        <template v-slot:header.quantity="{ column }">
            <p class="text-h6 text-center main-text">Cantitate</p>
        </template>
        <template v-slot:header.subtotal="{ column }">
            <p class="text-h6 text-center main-text">Subtotal</p>
        </template>

        <template v-slot:item.image="{ item }">
            <v-img
                class="my-2"
                :src="item.product.image_src"
                height="100"
                width="100"
                cover
            />
        </template>

        <template v-slot:item.name="{ item }">
            <p class="text-body-2 main-text">{{ shortText(item.product.name) }}</p>
        </template>

        <template v-slot:item.price="{ item }">
            <p class="text-body-2 text-center main-text">{{ item.product.price }} RON</p>
        </template>

        <template v-slot:item.quantity="{ item }">
            <p class="text-body-2 text-center main-text">{{ item.quantity }}</p>
        </template>

        <template v-slot:item.subtotal="{ item }">
            <p class="text-body-2 text-center main-text">{{ (item.product.price * item.quantity).toFixed(2) }} RON</p>
        </template>

        <template v-slot:no-data>
            <p class="text-body-1 pt-8">Coșul este gol</p>
        </template>
    </v-data-table-server>
</template>

<script setup lang="ts">
import { addNotification } from '@/Layouts/Notification/AddNotification';
import { shortText } from '@/Helpers/Helpers';
import { useDisplay } from 'vuetify';
import { ref, computed } from 'vue';

const props = defineProps<{
    cart_id?: number,
}>();

const { mdAndUp } = useDisplay();
const page = ref(1);
const items = ref([]);
const itemsTotalCount = ref(0);
const itemsPerPage = ref(5);
const loading = defineModel('loading');
const headers = computed(() => {
    const currentHeaders = [
        {
            key: 'image',
        },
        {
            title: '',
            key: 'name',
        },
        {
            key: 'price',
        },
        {
            key: 'quantity',
        },
    ];
    if (mdAndUp.value) {
        currentHeaders.push(
            { key: 'subtotal' }
        );
    }
    return currentHeaders;
});

function loadItems(): void {
    axios.get(route('admin.cart.fetch-items', {
        page: page.value,
        per_page: itemsPerPage.value,
        cart_id: props.cart_id,
    }))
    .then((resp) => {
        items.value = resp.data.data;
        itemsTotalCount.value = resp.data.meta.total;
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul încărcării datelor', 'error');
        items.value = [];
        itemsTotalCount.value = 1;
    })
    .finally(() => {
        loading.value = false;
    });
}
</script>
