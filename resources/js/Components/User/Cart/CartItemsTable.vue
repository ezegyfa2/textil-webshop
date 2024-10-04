<template>
    <v-data-table-server
        v-model:page="page"
        v-model:items-per-page="itemsPerPage"
        class="cart-items-table"
        :headers="headers"
        :items="items"
        :items-length="itemsTotalCount"
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
                class="my-3"
                :src="item.product.image_src"
                :height="imageSize"
                :width="imageSize"
                cover
            />
        </template>

        <template v-slot:item.name="{ item }">
            <p class="text-body-2 main-text pr-5 pr-md-0 pt-3">{{ shortText(item.product.name) }}</p>
            <p class="text-body-2" pr-5 pr-md-0>{{ item.size }} {{ item.color }}</p>
            <p
                v-if="smAndDown"
                class="text-body-2 pr-5 pr-md-0 pb-3"
            >
                {{ item.product.price }} RON
            </p>
        </template>

        <template v-slot:item.price="{ item }">
            <p class="text-body-2 text-center main-text">{{ item.product.price }} RON</p>
        </template>

        <template v-slot:item.quantity="{ item }">
            <div class="d-flex justify-center">
                <div class="d-flex align-center quantity-field">
                    <v-btn
                        icon="mdi-minus-thick"
                        :size="buttonSize"
                        elevation="0"
                        :disabled="loading || item.quantity <= 1"
                        :loading="loading"
                        @click="decreaseQuantity(item)"
                    />
                    <v-text-field
                        v-model="item.quantity"
                        @change="updateQuantity(item)"
                        type="number"
                        class="m-0 text-body-2 main-text text-center"
                        rounded="0"
                        hide-spin-buttons
                        hide-details
                        center-affix
                        density="compact"
                        :disabled="loading"
                        :loading="loading"
                    />
                    <v-btn
                        icon="mdi-plus-thick"
                        :size="buttonSize"
                        elevation="0"
                        :disabled="loading"
                        :loading="loading"
                        @click="increaseQuantity(item)"
                    />
                </div>
            </div>
        </template>

        <template v-slot:item.subtotal="{ item }">
            <p 
                v-if="mdAndUp"
                class="text-body-2 text-center main-text"
            >
                {{ (item.product.price * item.quantity).toFixed(2) }} RON
            </p>
        </template>

        <template v-slot:item.remove="{ item }">
            <v-btn
                icon="mdi-close-thick"
                :size="buttonSize"
                color="error"
                elevation="0"
                :disabled="loading"
                :loading="loading"
                @click="removeItem(item)"
            />
        </template>

        <template v-slot:no-data>
            <p class="text-body-1 pt-12 pb-8">Coșul este gol</p>
        </template>
    </v-data-table-server>
</template>

<script setup lang="ts">
import { addNotification } from '@/Layouts/Notification/AddNotification';
import { CartItem } from '@/types/cartItem';
import { shortText } from '@/Helpers/Helpers';
import { useDisplay } from 'vuetify';
import { ref, computed } from 'vue';

const page = ref(1);
const itemsPerPage = ref(5);
const itemsTotalCount = ref(0);
const items = defineModel('items');
const loading = defineModel('loading');
const { smAndDown, smAndUp, mdAndUp } = useDisplay();
const imageSize = computed(() => {
    if (mdAndUp.value) {
        return 100;
    } else {
        return 70;
    }
});
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
            key: 'quantity',
        },
    ];
    if (mdAndUp.value) {
        currentHeaders.push(
            { key: 'price' },
            { key: 'subtotal' }
        );
    }
    currentHeaders.push({
        title: '',
        key: 'remove',
    });
    return currentHeaders;
});

const buttonSize = computed(() => smAndUp.value ? 'small' : 'x-small');

function removeItem(item) {
    loading.value = true;
    axios.delete(route('cart.remove-from-cart', {
        product_id: item.product.id,
    }))
    .then((response) => {
        items.value.splice(items.value.indexOf(item), 1);
        addNotification(response.data.message, 'success');
        loadItems();
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul editarea coșului dvs.', 'error');
    })
    .finally(() => {
        loading.value = false;
    });
}

function loadItems(): void {
    axios.get(route('cart.fetch-items', {
        page: page.value,
        per_page: itemsPerPage.value,
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

function increaseQuantity(item) {
    ++item.quantity;
    updateQuantity(item);
}

function decreaseQuantity(item) {
    --item.quantity;
    updateQuantity(item);
}

const updateQuantity = debounce((item: CartItem) => {
    loading.value = true;
    axios.put(route('cart.update'), {
        product_id: item.product.id,
        quantity: item.quantity,
    })
    .then((response) => {
        addNotification(response.data.message, 'success');
    })
    .catch((error) => {
        console.error(error);
        addNotification('A apărut o eroare neașteptată în timpul editarea coșului dvs.', 'error');
    })
    .finally(() => {
        loading.value = false;
    });
}, 400);
</script>

<style lang="scss">
@import 'vuetify/lib/styles/settings/_variables';

@media #{map-get($display-breakpoints, 'xs')} {
    .cart-items-table {
        td, th, .v-field__input {
            padding-left: 4px !important;
            padding-right: 4px !important;
        }
        .v-btn {
            width: 30px !important;
        }
    }
    .quantity-field {
        width: 100px !important;
    }
}
@media #{map-get($display-breakpoints, 'sm')} {
    .quantity-field {
        width: 140px !important;
    }
}
@media #{map-get($display-breakpoints, 'md-and-up')} {
    .quantity-field {
        width: 140px !important;
    }
}
.quantity-field input {
    text-align: center;
}
</style>
