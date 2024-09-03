<template>
    <v-container class="blog-container">
        <v-row>
            <v-col 
                class="pr-10"
                cols="12"
                md="6"
                lg="4"
            >
                <IconImageBox
                    :title="blog1.title"
                    :content="blog1.content"
                    icon="mdi-account-hard-hat"
                    :src="blog1.image_src"
                    :href="blog1.href"
                    gradient-color="#ff9507"
                />
            </v-col>
            <v-col 
                class="px-5"
                cols="12"
                md="6"
                lg="4"
            >
                <IconImageBox
                    :title="blog2.title"
                    :content="blog2.content"
                    icon="mdi-shield"
                    :src="blog2.image_src"
                    :href="blog2.href"
                    gradient-color="#3052E0"
                />
            </v-col>
            <v-col 
                class="pl-10"
                cols="12"
                md="6"
                lg="4"
            >
                <IconImageBox
                    :title="blog3.title"
                    :content="blog3.content"
                    icon="mdi-tshirt-crew"
                    :src="blog3.image_src"
                    :href="blog3.href"
                    gradient-color="#A4303F"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import IconImageBox from '@/Components/User/Home/IconImageBox.vue';
import { BlogShort } from '@/types/blog';

const props = defineProps<{
    blog1: BlogShort,
    blog2: BlogShort,
    blog3: BlogShort,
}>();
</script>

<style>
.blog-container {
    background-color: transparent;
    margin-top: -127px;
}
</style>
