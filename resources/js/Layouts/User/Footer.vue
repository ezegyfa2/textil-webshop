<template>
    <v-footer class="bg-secondary">
        <v-container>
            <v-row class="py-5">
                <v-col cols="12" sm="6">
                    <Link :href="route('terms-and-conditions')">
                        <p class="footer-link text-center text-sm-start text-h6 text-surface main-text pb-1">Termeni și condiții</p>
                    </Link>
                    <Link :href="route('privacy-policy')">
                        <p class="footer-link text-center text-sm-start text-h6 text-surface main-text pb-1">Politica de confidențialitate</p>
                    </Link>
                </v-col>
                <v-col
                    class="text-end"
                    cols="12" sm="6"
                >
                    <Link :href="route('home')" class="d-flex justify-center justify-sm-end">
                        <p class="text-h4 text-primary main-text pb-4">MA</p><p class="text-h4 text-surface main-text pb-4">Textil</p>
                    </Link>
                    <p class="text-h6 main-text pb-1 text-center text-sm-end">matextil@gmail.ro</p>
                    <p class="text-h6 main-text pb-1 text-center text-sm-end">075 - 139 - 4963</p>
                </v-col>
            </v-row>
        </v-container>
    </v-footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped lang="scss">
@import "@styles/themeVariables";

.footer-link:hover {
    color: $primary-color !important;
}
</style>
