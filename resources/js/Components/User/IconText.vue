<template>
    <div class="d-flex align-center">
        <v-icon 
            class="mr-3"
            :icon="icon"
            color="surface"
            size="48"
        />
        <div class="d-flex flex-column">
            <p class="text-subtitle-2 text-primary">{{ title }}</p>
            <p class="text-h6 main-text">{{ content }}</p>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps<{
    icon: string;
    title: string;
    content: string;
}>();
</script>