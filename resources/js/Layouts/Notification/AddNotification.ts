import { usePage } from '@inertiajs/vue3';

export function addUnexpectedErrorNotification() {
    addNotification('A apărut o eroare neașteptată', 'error');
}

export function addNotification(message: string, type: "error" | "success" | "warning") {
    const page = usePage();
    let maxId = 0;
    if (!page.props.notifications) {
        page.props.notifications = [];
    } else if (page.props.notifications.length > 0) {
        maxId = Math.max(...page.props.notifications.map(notification => notification.id));
    }
    page.props.notifications.push({
        id: maxId + 1,
        message: message,
        type: type,
    });
}
