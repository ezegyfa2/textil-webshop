<template>
    <v-container class="top-section-separator">
        <v-row class="mb-10">
            <v-col>
                <h1 class="text-h4 font-weight-bold text-center">Produsele noastre</h1>
                <div class="d-flex justify-center">
                    <h2 class="text-body-1 text-center category-subtitle">Compania noastră oferă o gamă largă de servicii în orice domeniu al securității ocupaționale</h2>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="6" md="4" lg="3" v-for="category in categories">
                <ImageBox 
                    :src="category.imageSrc"
                    :content="category.name"
                    :href="category.href"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import ImageBox from '@/Components/User/Home/ImageBox.vue';

const categories = [
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
    {
        name: 'shoes',
        imageSrc: 'https://cdn.vuetifyjs.com/images/parallax/material2.jpg',
        href: '/products',
    },
];
</script>

<style scoped>
.category-subtitle {
    max-width: 450px;
}
</style>
