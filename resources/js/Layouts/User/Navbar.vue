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
                <div
                    v-if="mdAndUp"
                    class="d-flex justify-space-around w-75"
                >
                    <Link
                        class="main-text"
                        :href="route('product.index')"
                    >
                        Produsele
                    </Link>
                    <Link
                        class="main-text"
                        :href="route('home') + '#about_us'"
                    >
                        Despre noi
                    </Link>
                    <Link
                        class="main-text"
                        :href="route('blog.index')"
                    >
                        Bloguri
                    </Link>
                    <!--Link
                        class="main-text"
                        :href="route('login')"
                    >
                        Contul meu
                    </Link-->
                </div>
                <v-menu
                    v-if="smAndDown"
                    rounded
                >
                    <template v-slot:activator="{ props }">
                        <v-btn 
                            class="navbar-menu-button bg-primary"
                            color="secondary"
                            elevation="0"
                            icon="mdi-view-headline"
                            size="x-large"
                            v-bind="props"
                        />
                    </template>
                    <v-card
                        class="mx-auto"
                        max-width="300"
                    >
                        <v-list density="compact">
                            <Link :href="route('product.index')">
                                <v-list-item slim>
                                    <v-list-item-title class="text-h6 main-text py-3 px-4" v-text="'Produsele'"/>
                                </v-list-item>
                            </Link>
                            <Link :href="route('home') + '#about_us'">
                                <v-list-item slim>
                                    <v-list-item-title class="text-h6 main-text py-3 px-4" v-text="'Despre noi'"/>
                                </v-list-item>
                            </Link>
                            <Link :href="route('blog.index')">
                                <v-list-item slim>
                                    <v-list-item-title class="text-h6 main-text py-3 px-4" v-text="'Bloguri'"/>
                                </v-list-item>
                            </Link>
                            <!--Link :href="route('login')">
                                <v-list-item slim>
                                    <v-list-item-title class="text-h6 main-text py-3 px-4" v-text="'Contul meu'"/>
                                </v-list-item>
                            </Link-->
                        </v-list>
                    </v-card>
                </v-menu>
                <SkewButton
                    :href="route('cart.index')"
                    content="Comanda"
                />
            </v-card>
        </v-container>
    </v-app-bar>
</template>

<script setup>
import SkewButton from '@/Layouts/User/SkewButton.vue';
import { Link } from '@inertiajs/vue3';
import { useDisplay } from 'vuetify';

const { smAndDown, mdAndUp } = useDisplay();
</script>

<style lang="scss">
@import '@styles/themeVariables';

.navbar-menu-button {
    height: 72px !important;
    width: 72px !important;
}
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
    z-index: 1 !important;

    .main-navbar-card {
        height: 72px;
        display: flex;
        justify-content: space-between;

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
