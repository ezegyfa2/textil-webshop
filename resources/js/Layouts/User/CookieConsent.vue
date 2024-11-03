<template>
    <v-footer
        v-if="!accepted"
        app
        class="bg-secondary opacity-90"
    >
        <v-container>
            <v-row>
                <v-col cols="12" class="d-flex">
                    <v-btn
                        class="mr-4"
                        @click="accept"
                    >
                        Am înțeles
                    </v-btn>
                    <p class="text-body-1">
                        Acest site utilizează module cookie pentru a vă asigura că beneficiați de cea mai bună 
                        experiență pe site-ul nostru. Dacă continuați să utilizați site-ul nostru, vom presupune 
                        că sunteți de acord să primiți toate modulele cookie de pe acest site.
                    </p>
                </v-col>
            </v-row>
        </v-container>
    </v-footer>
</template>

<script setup>
import { useCookies } from 'vue3-cookies';
import { ref } from 'vue';

const { cookies } = useCookies();
const accepted = ref(cookies.get('cookies-accepted'));
function accept() {
    cookies.set('cookies-accepted', true);
    accepted.value = true;
}
</script>
