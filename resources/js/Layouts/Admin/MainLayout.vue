<template>
    <v-app class="layout">
        <Navbar/>
        <v-main class="d-flex">
            <slot />
            <Notifications/>
        </v-main>
    </v-app>
</template>

<script setup lang="ts">
import Notifications from '@/Layouts/Notification/Notifications.vue';
import Navbar from '@/Layouts/Admin/Navbar.vue';

const props = defineProps<{
    title?: string;
}>();
</script>
