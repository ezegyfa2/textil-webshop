<template>
    <v-app class="layout">
        <Navbar/>
        <v-main class="bg-surface-variant d-flex justify-center align-center h-100">
            <slot />
            <Notifications/>
        </v-main>
    </v-app>
</template>

<script setup lang="ts">
import Notifications from '@/Components/Notifications.vue';
import Navbar from '@/Layouts/Admin/Navbar.vue';

const props = defineProps<{
    title?: string;
}>();
</script>
