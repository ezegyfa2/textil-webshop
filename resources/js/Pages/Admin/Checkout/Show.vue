<template>
    <MainLayout>
        <v-container>
            <v-row class="my-10">
                <v-col cols="12">
                    <p class="text-h4 main-text text-uppercase">
                        Detalii de facturare
                    </p>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Prenume</p>
                    {{ first_name }}
                </v-col>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Nume</p>
                    {{ last_name }}
                </v-col>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Email</p>
                    {{ email }}
                </v-col>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Număr de telefon</p>
                    {{ phone }}
                </v-col>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Denumirea companiei</p>
                    {{ company_name }}
                </v-col>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Cod postal</p>
                    {{ postal_code }}
                </v-col>
                <v-col cols="6" sm="4">
                    <p class="text-h6 main-text">Adresa</p>
                    {{ address }}
                </v-col>
                <v-col cols="12">
                    <v-card class="mt-10">
                        <CartItemsTable
                            :cart_id="cart_id"
                            v-model:loading="loading"
                        />
                        <v-divider
                            :thickness="1"
                            opacity="100"
                        />
                        <div class="p-5">
                            <p class="text-h5 main-text text-end">Preț total: {{ total_price }} RON</p>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/Admin/MainLayout.vue';
import CartItemsTable from '@/Components/Admin/Cart/CartItemsTable.vue';
import { ref } from 'vue';

const props = defineProps<{
    total_price: number,
    cart_id: number,
    first_name?: string,
    last_name?: string,
    email?: string,
    phone?: string,
    company_name?: string,
    address?: string,
    postal_code?: string,
}>();

const loading = ref(false);
const items = ref([]);
</script>
