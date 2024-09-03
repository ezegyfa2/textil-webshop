import { Ref } from 'vue';

export interface Notification {
    message: string;
    type: 'success'|'error'|'warning';
}

export interface NotificationSnackbar {
    notification: Notification;
    snackbar: Ref<boolean>;
}
