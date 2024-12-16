<template>
    <v-dialog v-model="isActive" max-width="600">
        <v-card class="bg-secondary pa-7">
            <p class="text-h5 pb-8">Deservim numai persoane juridice</p>
            <p class="text-body-1 pb-12">Stimate vizitator, puteți plasa o comandă pe site numai prin introducerea detaliilor companiei dvs. Vă mulțumim pentru înțelegere.</p>

            <div class="d-flex justify-center">
                <v-btn
                    text="Am înțeles"
                    class="text-h6"
                    color="primary"
                    size="large"
                    @click="accept"
                ></v-btn>
            </div>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { useCookies } from 'vue3-cookies';
import { ref } from 'vue';

const { cookies } = useCookies();
const isActive = ref(!cookies.get('only-for-companies-accepted'));

function accept() {
    isActive.value = false;
    cookies.set('only-for-companies-accepted', true);
}
</script>
