import { Ref } from 'vue';

export interface Notification {
    id: number,
    message: string;
    type: 'success'|'error'|'warning';
}

export interface NotificationSnackbar {
    notification: Notification;
    snackbar: boolean;
}
