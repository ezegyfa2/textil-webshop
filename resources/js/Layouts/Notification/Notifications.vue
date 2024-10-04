<template>
    <v-snackbar
        v-if="currentNotificationSnackbar"
        class="transparent-item"
        :color="currentNotificationSnackbar.notification.type"
        v-model="currentNotificationSnackbar.snackbar"
        :timeout="1500"
        rounded="0"
    >
        <p class="text-body-1 text-surface p-2">{{ currentNotificationSnackbar.notification.message }}</p>
        <template v-slot:actions>
            <v-btn
                icon="mdi-close-thick"
                color="surface"
                border="0"
                elevation="0"
                @click="currentNotificationSnackbar.snackbar = false"
            />
        </template>
    </v-snackbar>
</template>

<script setup lang="ts">
import { ref, Ref, computed, watch, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { NotificationSnackbar } from '@/types/notifications';

const page = usePage();
const notificationSnackbars: Ref<NotificationSnackbar[]> = ref([]);
const showedNotificationIds = computed(() => notificationSnackbars.value.map(
    (notificationSnackbar: NotificationSnackbar) => notificationSnackbar.notification.id
));
const currentNotificationSnackbar = computed(() => {
    for (let notificationSnackbar of notificationSnackbars.value) {
        if (notificationSnackbar.snackbar) {
            return notificationSnackbar;
        }
    }
    return null;
});

onMounted(() => {
    updateNotificationSnackbars(page.props.notifications);
});

watch(
    () => page.props.notifications, (newNotifications) => {
        updateNotificationSnackbars(newNotifications);
    },
    { deep: true }
);

function updateNotificationSnackbars(notifications) {
    updateNotificationIds(notifications);
    notifications?.forEach(notification => {
        if (!showedNotificationIds.value.includes(notification.id)) {
            notificationSnackbars.value.push({
                notification: notification,
                snackbar: true,
            });
        }
    });
}

function updateNotificationIds(notifications) {
    if (notifications) {
        let maxId = Math.max(...notifications.map(notification => notification.id));
        if (maxId <= 0) {
            maxId = 1;
        }
        notifications.forEach(notification => {
            if (!notification.id) {
                notification.id = maxId;
                ++maxId;
            }
        });
    }
}
</script>

<style>
.v-snackbar__actions {
    margin: 0;
}
</style>
