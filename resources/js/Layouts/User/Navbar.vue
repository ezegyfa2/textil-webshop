<template>
    <v-app-bar 
        class="main-navbar"
        :scroll-threshold="1"
        elevation="0"
    >
        <v-container>
            <v-card
                class="main-navbar-card"
                elevation="3"
                rounded="0"
            >
                <Link
                    class="main-text"
                    :href="route('home')"
                >
                    Produsele
                </Link>
                <Link
                    class="main-text"
                    :href="route('login')"
                >
                    Despre noi
                </Link>
                <Link
                    class="main-text"
                    :href="route('login')"
                >
                    Bloguri
                </Link>
                <Link
                    class="main-text"
                    :href="route('login')"
                >
                    Contul meu
                </Link>
                <v-spacer></v-spacer>
                <SkewButton content="Comanda"/>
            </v-card>
        </v-container>
    </v-app-bar>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SkewButton from '@/Layouts/User/SkewButton.vue';
</script>

<style lang="scss">
@import '@styles/themeVariables';

.v-toolbar__content {
    height: 90px !important;
    display: flex;
    justify-content: center;
}
.main-navbar {
    background-color: transparent !important;
    position: sticky !important;
    top: 10px !important;
    margin-top: -46px;

    .main-navbar-card {
        height: 72px;
        display: flex;

        a:not(.button) {
            font-weight: bold;
            margin-left: 10%;
            display: flex;
            align-items: center;
            height: 100%;

            &:not([disabled=true]):not(.button) {
                cursor: pointer;
                &:hover {
                    color: $primary-color;
                    border-top: 4px solid transparent;
                    border-bottom: 4px solid $primary-color;
                    transition: $main-transition;
                }
            }
        }
    }
}
</style>
