import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Vuetify
import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';
import { createVuetify, type ThemeDefinition } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const textColor = 'white';
const surfaceColor = '#FFFFFF';
const surfaceVariantColor = '#2F2D2F';
const backgroundColor2 = '#020202';
const primaryColor = '#FF9505';
const secondaryColor = '#191719';
const errorColor = '#C20114';

const mainTheme: ThemeDefinition = {
    colors: {
        primary: primaryColor,
        secondary: secondaryColor,
        surface: surfaceColor,
        'surface-variant': surfaceVariantColor,
        error: errorColor,
    },
    /*variables: {
        'medium-emphasis-opacity': 0.85,
        'label-opacity': 0.1,
        'snackbar-action-margin': '16px',
    }*/
}

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'mainTheme',
        themes: {
            mainTheme,
        },
    },
    defaults: {
        VBtn: {
            class: 'global-button',
            rounded: 0,
            color: 'primary',
            elevation: 1,
        },
    },
    /*defaults: {
        global: {
            hideDetails: 'auto',
        },
        VTextField: {
            variant: 'solo',
            bgColor: 'secondary',
            rounded: true,
        },
        VCheckbox: {
            baseColor: textColor,
            color: textColor,
        },
        VBtn: {
            rounded: true,
        },
    },*/
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(vuetify)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
