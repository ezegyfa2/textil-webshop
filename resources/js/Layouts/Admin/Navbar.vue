<template>
    <v-app-bar class="bg-grey-lighten-3 p-3">
        <v-app-bar-nav-icon 
            color="secondary"
            variant="text"
            @click.stop="drawer = !drawer"
        />
        <v-toolbar-title class="text-h5 font-weight-bold">
            <Link :href="route('admin.dashboard')">
                <span class="text-primary">MA</span>Textil
            </Link>
        </v-toolbar-title>
    </v-app-bar>
    <v-navigation-drawer
        v-model="drawer"
        :location="$vuetify.display.mobile ? 'bottom' : undefined"
        class="bg-grey-lighten-3 pt-6"
    >
        <v-list>
            <v-list-item
                v-for="(navItem, i) in navItems"
                :key="navItem.href"
                class="admin-list-item"
                color="surface"
            >
                <Link :href="navItem.href" class="d-flex align-center text-h6 py-3">
                    <v-icon :icon="navItem.icon" class="mr-5"/>{{ navItem.text }}
                </Link>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

let drawer = ref(false);
const navItems = [
    {
        icon: 'mdi-account-outline',
        text: 'Utilizatori',
        href: route('admin.user.index'),
    },
    {
        icon: 'mdi-package-variant-closed',
        text: 'Produsele',
        href: route('admin.product.index'),
    },
    {
        icon: 'mdi-dolly',
        text: 'Comenzi',
        href: route('admin.checkout.index'),
    },
];
</script>

<style lang="scss">
@import '@styles/themeVariables';

.admin-list-item:hover {
    background-color: $primary-color;
}
.admin-list-item:hover a {
    color: $secondary-color;
}
</style>
