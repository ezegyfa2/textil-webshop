<template>
    <v-app class="layout">
        <v-app-bar class="bg-grey-lighten-3 p-3">
            <v-toolbar-title class="text-h5 font-weight-bold">
                <Link :href="route('admin.dashboard')">
                    <span class="text-primary">MA</span>Textil
                </Link>
            </v-toolbar-title>
        </v-app-bar>
        <v-main class="d-flex">
            <slot />
            <Notifications/>
        </v-main>
    </v-app>
</template>

<script setup lang="ts">
import Notifications from '@/Layouts/Notification/Notifications.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    title?: string;
}>();
</script>
