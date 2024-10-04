<template>
    <MainLayout>
        <v-container>
            <v-row v-if="items.length > 0" class="justify-center top-section-separator">
                <v-col cols="12" md="6" lg="8">
                    <v-card
                        rounded="0"
                    >
                        <v-card-title class="text-h5 main-text text-uppercase ml-3 mt-2 mb-8">
                            Detalii de facturare
                        </v-card-title>

                        <v-card-text>
                            <v-form
                                @submit.prevent="storeOrder"
                                class="text-end"
                            >
                                <v-text-field
                                    v-model="form.first_name"
                                    :counter="250"
                                    label=" * Prenume"
                                    :rules="nameRules"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    required
                                    :error-messages="form.errors.first_name"
                                />

                                <v-text-field
                                    v-model="form.last_name"
                                    :counter="250"
                                    label=" * Nume"
                                    :rules="nameRules"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    required
                                    :error-messages="form.errors.last_name"
                                />

                                <v-text-field
                                    v-model="form.email"
                                    :counter="250"
                                    label=" * Email"
                                    :rules="emailRules"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    required
                                    type="email"
                                    :error-messages="form.errors.email"
                                />

                                <v-text-field
                                    v-model="form.phone"
                                    label="Număr de telefon"
                                    :rules="phoneRules"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    type="tel"
                                    :error-messages="form.errors.phone"
                                />

                                <v-text-field
                                    v-model="form.company_name"
                                    :counter="250"
                                    label="Denumirea companiei"
                                    :rules="[maxFieldLengthRule]"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :error-messages="form.errors.company_name"
                                />

                                <v-textarea
                                    v-model="form.address"
                                    :counter="500"
                                    label="Adresa"
                                    :rules="[maxTextareaLengthRule]"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    :error-messages="form.errors.address"
                                />

                                <v-text-field
                                    v-model="form.postal_code"
                                    :counter="10"
                                    label="Cod postal"
                                    hide-spin-buttons
                                    :rules="[value => maxLengthRule(value, 10)]"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    type="number"
                                    :error-messages="form.errors.postal_code"
                                />

                                <v-btn
                                    class="mb-3"
                                    size="x-large"
                                    type="submit"
                                >
                                    <p class="text-uppercase text-body-1 main-text">Plasați comanda</p>
                                </v-btn>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col
                    v-if="items.length > 0"
                    cols="12" md="6" lg="4"
                >
                    <v-card
                        rounded="0"
                        tonal
                    >
                        <p class="text-h6 main-text py-3 px-5">Produsele</p>
                        <v-divider
                            :thickness="1"
                            opacity="100"
                        />
                        <v-list>
                            <v-list-item
                                v-for="item in items.slice(0, 5)"
                                :key="item.product.id"
                            >
                                <div class="d-flex align-start justify-between py-2">
                                    <div class="d-flex pr-7">
                                        <div>
                                            <v-img
                                                class="mr-3"
                                                :src="item.product.image_src"
                                                height="90"
                                                width="90"
                                                cover
                                            />
                                        </div>
                                        <div>
                                            <p class="text-body-2 main-text mb-2">{{ item.product.name }}</p>
                                            <p class="text-body-2 main-text">{{ item.quantity + ' BUC' }}</p>
                                        </div>
                                    </div>
                                    <p class="text-body-2 main-text">
                                        {{ (item.product.price * item.quantity).toFixed(2) }} RON
                                    </p>
                                </div>
                            </v-list-item>
                            <v-list-item v-if="items.length > 5">
                                <p class="text-body-1 main-text">Și alte {{ items.length - 5 }} produse</p>
                            </v-list-item>
                        </v-list>
                        <v-divider
                            :thickness="1"
                            opacity="100"
                        />
                        <div class="p-5">
                            <div class="d-flex justify-between">
                                <p class="text-h6 main-text">Preț total</p>
                                <p class="text-h6 main-text">{{ totalPrice }} RON</p>
                            </div>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
            <v-row 
                v-else
                class="justify-center"
            >
                <v-col cols="12" sm="8">
                    <v-card
                        class="section-separator text-center py-14"
                        rounded="0"
                    >
                        <p class="text-h5 pb-8">Coșul este gol</p>
                        <Link :href="route('product.index')">
                            <v-btn size="large">
                                <p class="text-body-1 main-text">Continuă cumpărăturile</p>
                            </v-btn>
                        </Link>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import { CartItem } from '@/types/cartItem';
import { addNotification } from '@/Layouts/Notification/AddNotification';
import { nameRules, emailRules, phoneRules, maxFieldLengthRule, maxTextareaLengthRule, maxLengthRule } from '@/Helpers/ValidationRules';
import { ref, computed } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps<{
    items: CartItem[],
    first_name?: string,
    last_name?: string,
    email?: string,
    phone?: string,
    company_name?: string,
    address?: string,
    postal_code?: string,
}>();

const form = useForm({
    first_name: props.first_name,
    last_name: props.last_name,
    email: props.email,
    phone: props.phone,
    company_name: props.company_name,
    address: props.address,
    postal_code: props.postal_code,
});
const loading = ref(false);

const totalPrice = computed(() => {
    return props.items.reduce((total, item) => total + item.quantity * item.product.price, 0).toFixed(2);
});

function storeOrder() {
    form.transform(data => {
        if (data.phone) {
            if (data.phone.length == 10) {
                data.phone = '+4' + data.phone;
            }
            data.phone = data.phone.replaceAll(' ', '');
        }
        return data;
    }).post(route('cart.store-order'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log(errors);
            addNotification('A apărut o eroare neașteptată în timpul plasarea comenzii dvs.', 'error');
            loading.value = false;
        },
    });
}
</script>
