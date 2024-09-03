<template>
    <v-container class="top-section-separator">
        <v-row>
            <v-col class="d-flex align-center pr-12" cols="12" md="6">
                <div>
                    <h1 class="text-h4 font-weight-bold mb-12">{{ title }}</h1>
                    <p class="text-body-1 mb-12">{{ content }}</p>
                    <v-btn
                        :href="href"
                        size="large"
                    >
                        <p class="main-text">{{ buttonText }}</p>
                    </v-btn>
                </div>
            </v-col>
            <v-col cols="12" md="6">
                <v-img 
                    :src="src"
                    cover
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
const props = defineProps<{
    title: string;
    content: string;
    buttonText: string;
    src: string;
    href: string;
}>();
</script>
