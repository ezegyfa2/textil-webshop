<template>
    <MainLayout>
        <v-container>
            <v-row>
                <v-col
                    class="section-separator"
                    cols="12"
                >
                    <h1 class="text-h3">{{ blog.title }}</h1>
                    <p class="text-body-2 mt-2 ml-1 mb-10">{{ blog.created_at }}</p>
                    <v-img :src="blog.image_src"></v-img>
                    <div class="mt-15 blog-content" v-html="blog.content"></div>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';

const props = defineProps<{
    blog: Object,
}>();
</script>

<style lang="scss">
.blog-content p {
    font-size: 1rem !important;
    font-weight: 400;
    line-height: 1.5;
    letter-spacing: 0.03125em !important;
    font-family: "Roboto", sans-serif;
    text-transform: none !important;
    margin-bottom: 20px;
}
.blog-content h2 {
    font-size: 1.5rem !important;
    font-weight: 400;
    line-height: 1.333;
    letter-spacing: normal !important;
    font-family: "Roboto", sans-serif;
    text-transform: none !important;
    margin-bottom: 20px;
}
</style>
