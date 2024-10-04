<template>
    <v-container class="section-separator">
        <v-row>
            <v-col class="mb-10">
                <h1 class="text-h4 font-weight-bold text-center">Cel mai recent blog</h1>
                <h2 class="text-body-1 text-center">Postări periodice privind gama noastră de produse și industria textilă</h2>
            </v-col>
        </v-row>
        <v-row>
            <v-col 
                class="d-flex justify-center"
                cols="12" md="6" lg="4"
            >
                <BlogShortSection
                    :blog="blog1"
                />
            </v-col>
            <v-col 
                class="d-flex justify-center"
                cols="12" md="6" lg="4"
            >
                <BlogShortSection
                    :blog="blog2"
                />
            </v-col>
            <v-col 
                class="d-flex justify-center"
                cols="12" md="6" lg="4"
            >
                <BlogShortSection
                    :blog="blog3"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import BlogShortSection from '@/Components/User/BlogShortSection.vue';
import { BlogShort } from '@/types/blog';

const props = defineProps<{
    blog1: BlogShort,
    blog2: BlogShort,
    blog3: BlogShort,
}>()
</script>
