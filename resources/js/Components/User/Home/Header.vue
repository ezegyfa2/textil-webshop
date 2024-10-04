<template>
    <v-carousel
        height="600"
        direction="vertical"
        :show-arrows="false"
        hide-delimiters
        cycle
    >
        <v-carousel-item
            src="/storage/images/Header background 1.webp"
            cover
        >
            <v-container class="h-100">
                <v-row class="justify-start h-100">
                    <v-col cols="12" md="6" class="text-md-start pt-16">
                        <h1 class="text-h3 text-surface font-weight-bold mb-3 mt-16">Echipamentul perfect pentru fiecare meserie</h1>
                        <h2 class="text-h6 text-surface mb-6">Alege calitatea online!</h2>
                        <Link :href="route('product.index')">
                            <v-btn 
                                size="x-large"
                                color="primary"
                                rounded="0"
                            >
                                <p class="main-text">Produsele noastre</p>
                            </v-btn>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>
        </v-carousel-item>
        <v-carousel-item
            src="/storage/images/Header background 2.webp"
            cover
        >
            <v-container class="h-100">
                <v-row class="justify-end h-100">
                    <v-col cols="12" md="6" class="text-md-end pt-16">
                        <h1 class="text-h3 text-surface font-weight-bold mb-3 mt-16">Siguranță și confort la locul de muncă</h1>
                        <h2 class="text-h6 text-surface mb-6">Hainele care te susțin!</h2>
                        <Link :href="route('product.index')">
                            <v-btn 
                                size="x-large"
                                color="primary"
                                rounded="0"
                            >
                                <p class="main-text">Produsele noastre</p>
                            </v-btn>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>
        </v-carousel-item>
        <v-carousel-item
            src="/storage/images/Header background 3.webp"
            cover
        >
            <v-container class="h-100">
                <v-row class="justify-start h-100">
                    <v-col cols="12" md="6" class="text-md-start pt-16">
                        <h1 class="text-h3 font-weight-bold mb-3 mt-16">Echipat pentru succes</h1>
                        <h2 class="text-h6 mb-6">Îmbrăcăminte de lucru la un click distanță!</h2>
                        <Link :href="route('product.index')">
                            <v-btn 
                                size="x-large"
                                color="primary"
                                rounded="0"
                            >
                                <p class="main-text">Produsele noastre</p>
                            </v-btn>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>
        </v-carousel-item>
    </v-carousel>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
