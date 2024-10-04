<template>
    <MainLayout>
        <v-container>
            <v-row class="justify-center large-top-section-separator">
                <v-col
                    cols="12" lg="9"
                >
                    <v-card
                        class="pb-4"
                        rounded="0"
                    >
                        <CartItemsTable
                            v-model:items="items"
                            v-model:loading="loading"
                        />
                    </v-card>
                </v-col>
                <v-col
                    v-if="items.length > 0"
                    cols="12" sm="8" md="6" lg="3"
                >
                    <v-card
                        rounded="0"
                        tonal
                    >
                        <p class="text-h6 text-uppercase main-text py-3 px-5">Coș total</p>
                        <v-divider
                            :thickness="1"
                            opacity="100"
                        />

                        <div class="p-5">
                            <div class="d-flex justify-between">
                                <p class="text-body-1 main-text">Preț total</p>
                                <p class="text-body-1 main-text">{{ totalPrice }} RON</p>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <v-btn
                                class="mb-3 w-100"
                                size="x-large"
                                :disabled="loading"
                                :loading="loading"
                                @click="router.visit(route('cart.checkout'))"
                            >
                                <p class="text-uppercase text-body-1 main-text">Finalizează comanda</p>
                            </v-btn>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import CartItemsTable from '@/Components/User/Cart/CartItemsTable.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const items = ref([]);
const loading = ref(false);

const totalPrice = computed(() => {
    return items.value.reduce((total, item) => total + item.quantity * item.product.price, 0).toFixed(2);
});
</script>
