<template>
    <v-data-iterator
        :items="product_categories"
        :items-per-page="product_categories.length"
    >
        <template v-slot:default="{ items }">
            <v-container>
                <v-row dense>
                    <v-col
                        v-for="item in items"
                        :key="item.raw.id"
                        class="pa-2"
                        cols="12" sm="6" md="3"
                    >
                        <v-card
                            class="product-box d-flex flex-column h-100 pa-2"
                            color="white"
                            rounded="0"
                        >
                            <Link :href="route('product.index', {category: item.raw.id})">
                                <ImageBox
                                    width="100%"
                                    height="300"
                                    :src="item.raw.image_src"
                                >
                                    <v-icon 
                                        icon="mdi-eye"
                                        color="primary"
                                        size="80"
                                    />
                                </ImageBox>
                            </Link>

                            <p class="text-h6 text-center main-text mt-4 mb-2">{{ item.raw.name }}</p>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </template>
    </v-data-iterator>
</template>

<script setup lang="ts">
import ImageBox from '@/Components/User/ImageBox.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    product_categories: Array,
}>();
</script>

<style scoped lang="scss">
@import "@styles/themeVariables";

.image-hover-content {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    background-color: black;
}
.image-hover-content:hover {
    opacity: 0.7;
}
</style>

