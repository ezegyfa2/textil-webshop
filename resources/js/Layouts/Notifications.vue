<template>
    <v-snackbar
        v-for="notificationSnackbar in notificationSnackbars"
        class="transparent-item"
        :color="notificationSnackbar.notification.type"
        v-model="notificationSnackbar.snackbar.value"
        :timeout="2000"
    >
        {{ notificationSnackbar.notification.message }}
        <template v-slot:actions>
            <a
                @click="notificationSnackbar.snackbar.value = false"
            >
                CLOSE
            </a>
        </template>
    </v-snackbar>
</template>

<script setup lang="ts">
import { ref, ComputedRef, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { NotificationSnackbar } from '@/types/notifications';

const page = usePage();
let notificationSnackbars: ComputedRef<NotificationSnackbar[]> = computed(() => {
    if (page.props.notifications) {
        return page.props.notifications.map(notification => {
            return {
                notification: notification,
                snackbar: ref(true),
            };
        });
    } else {
        return [];
    }
});
</script>

<style lang="scss" scoped>
@import '@styles/themeVariables';

a {
    color: $surface-color;
}
a:hover {
    color: $primary-color;
}
</style>
