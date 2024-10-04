<template>
    <v-container class="top-section-separator">
        <v-row>
            <v-col
                class="d-flex align-center pr-lg-12"
                cols="12" md="6"
            >
                <div class="w-100 d-flex flex-column align-center align-md-start text-center text-md-start">
                    <h1 class="text-h4 font-weight-bold mb-6 mb-lg-12">{{ title }}</h1>
                    <p class="description-content text-body-2 text-md-body-1 mb-6 mb-lg-12">{{ content }}</p>
                    <Link
                        :href="href"
                    >
                        <v-btn
                            class="mb-12 mb-lg-0"
                            size="large"
                        >
                            <p class="main-text">{{ buttonText }}</p>
                        </v-btn>
                    </Link>
                </div>
            </v-col>
            <v-col 
                class="d-flex align-center"
                cols="12" md="6"
            >
                <v-img 
                    :src="src"
                    cover
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    title: string;
    content: string;
    buttonText: string;
    src: string;
    href: string;
}>();
</script>

<style scoped>
.description-content {
    max-width: 600px;
}
</style>
