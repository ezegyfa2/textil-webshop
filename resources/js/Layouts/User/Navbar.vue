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
                    v-if="smAndUp"
                    class="d-flex justify-space-around w-75"
                >
                    <v-menu
                        rounded
                    >
                        <template v-slot:activator="{ props }">
                            <a
                                class="main-text"
                                v-bind="props"
                            >
                                Produsele
                            </a>
                        </template>
                        <v-card>
                            <v-container>
                                <v-row>
                                    <v-col 
                                    class="py-0"
                                    cols="12" sm="6" md="4">
                                        <v-list 
                                            class="pa-0"
                                            density="compact"
                                            min-width="160"
                                        >
                                            <Link
                                                v-for="category in menuElements.slice(0, 6)"
                                                :href="category.url"
                                            >
                                                <v-list-item slim>
                                                    <v-list-item-title
                                                        class="text-body-2 main-text"
                                                        v-text="category.name"
                                                    />
                                                </v-list-item>
                                            </Link>
                                        </v-list>
                                    </v-col>
                                    <v-col 
                                        class="py-0"
                                        cols="12" sm="6" md="4"
                                    >
                                        <v-list 
                                            class="pa-0"
                                            density="compact"
                                            min-width="160"
                                        >
                                            <Link
                                                v-for="category in menuElements.slice(6, 12)"
                                                :href="route('product.index') + '?category=' + category.id"
                                            >
                                                <v-list-item slim>
                                                    <v-list-item-title
                                                        class="text-body-2 main-text"
                                                        v-text="category.name"
                                                    />
                                                </v-list-item>
                                            </Link>
                                        </v-list>
                                    </v-col>
                                    <v-col 
                                    class="py-0"
                                    cols="12" sm="6" md="4">
                                        <v-list 
                                            class="pa-0"
                                            density="compact"
                                            min-width="160"
                                        >
                                            <Link
                                                v-for="category in menuElements.slice(12, 18)"
                                                :href="route('product.index') + '?category=' + category.id"
                                            >
                                                <v-list-item slim>
                                                    <v-list-item-title
                                                        class="text-body-2 main-text"
                                                        v-text="category.name"
                                                    />
                                                </v-list-item>
                                            </Link>
                                        </v-list>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card>
                    </v-menu>
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
                    <v-menu
                        rounded
                    >
                        <template v-slot:activator="{ props }">
                            <a
                                class="main-text"
                                v-bind="props"
                            >
                                Contul meu
                            </a>
                        </template>
                        <v-card
                            class="mx-auto"
                            max-width="300"
                        >
                            <v-list 
                                v-if="page.props.auth.user"
                                class="pa-0"
                                density="compact"
                            >
                                <v-list-item slim>
                                    <v-list-item-title
                                        class="text-body-1 main-text py-5 px-4"
                                        v-text="page.props.auth.user.first_name + ' ' + page.props.auth.user.last_name"
                                    />
                                </v-list-item>
                                <hr>
                                <Link :href="route('profile.edit')">
                                    <v-list-item slim>
                                        <v-list-item-title
                                            class="text-body-1 main-text pt-5 px-4"
                                            v-text="'Editează profilul'"
                                        />
                                    </v-list-item>
                                </Link>
                                <Link :href="route('profile.password.edit')">
                                    <v-list-item slim>
                                        <v-list-item-title
                                            class="text-body-1 main-text pt-5 px-4"
                                            v-text="'Modificarea parolei'"
                                        />
                                    </v-list-item>
                                </Link>
                                <Link
                                    :href="route('logout')"
                                    method="post"
                                >
                                    <v-list-item slim>
                                        <v-list-item-title
                                            class="text-body-1 main-text py-5 px-4"
                                            v-text="'Log out'"
                                        />
                                    </v-list-item>
                                </Link>
                            </v-list>
                            <v-list 
                                v-else
                                density="compact"
                            >
                                <Link :href="route('login')">
                                    <v-list-item slim>
                                        <v-list-item-title
                                            class="text-body-1 main-text pt-5 px-4"
                                            v-text="'Logare'"
                                        />
                                    </v-list-item>
                                </Link>
                                <Link :href="route('register')">
                                    <v-list-item slim>
                                        <v-list-item-title
                                            class="text-body-1 main-text py-5 px-4"
                                            v-text="'Înregistrare'"
                                        />
                                    </v-list-item>
                                </Link>
                            </v-list>
                        </v-card>
                    </v-menu>
                </div>
                <v-menu
                    v-else
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
                <SkewButton :href="route('cart.index')">
                    <v-badge
                        v-if="page.props.cart_item_count"
                        color="error"
                    >
                        <template v-slot:badge>
                            <p class="badge-text font-weight-bold main-text">{{ page.props.cart_item_count }}</p>
                        </template>
                        <p class="pr-3">Comanda</p>
                    </v-badge>
                    <p v-else>Comanda</p>
                </SkewButton>
            </v-card>
        </v-container>
    </v-app-bar>
</template>

<script setup>
import SkewButton from '@/Layouts/User/SkewButton.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useDisplay } from 'vuetify';
import { computed } from 'vue';

const { xs, smAndUp } = useDisplay();
const page = usePage();

const menuElements = computed(() => {
    return page.props.genders.concat(page.props.categories);
})
</script>

<style lang="scss">
@import '@styles/themeVariables';

.navbar-menu-button {
    height: 72px !important;
    width: 72px !important;
}
.main-navbar .v-toolbar__content {
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
.badge-text {
    font-size: 10px;
}
</style>
