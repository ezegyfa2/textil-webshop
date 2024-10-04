<template>
    <v-container class="section-separator">
        <v-row class="mb-10">
            <v-col>
                <h1 class="text-h4 mb-3 font-weight-bold text-center">Produsele noastre</h1>
                <div class="d-flex justify-center">
                    <h2 class="text-body-1 text-center category-subtitle">Compania noastră oferă o gamă largă de servicii în orice domeniu al securității ocupaționale</h2>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col
                v-for="category in categories"
                cols="12" sm="6" md="4" lg="3"
            >
                <Link 
                    :href="category.href"
                    class="image-content"
                >
                    <ImageBox
                        :src="category.image_src"
                    >
                            <p class="text-h6 text-surface">{{ category.name }}</p>
                    </ImageBox>
                </Link>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import ImageBox from '@/Components/User/ImageBox.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    categories: Array,
}>();
</script>

<style scoped lang="scss">
@import "@styles/themeVariables";

.category-subtitle {
    max-width: 450px;
}
</style>
