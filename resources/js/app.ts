import './bootstrap';
import '../css/app.css';
import '../styles/globals.scss';

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
import debounce from 'lodash.debounce';
window.debounce = debounce;

const appName = 'MATextil';

const textColor = 'white';
const surfaceColor = '#FFFFFF';
const surfaceVariantColor = '#2F2D2F';
const primaryColor = '#FF9505';
const secondaryColor = '#191719';
const errorColor = '#DA4167';
const successColor = '#1B998B';

const mainTheme: ThemeDefinition = {
    colors: {
        primary: primaryColor,
        secondary: secondaryColor,
        surface: surfaceColor,
        'surface-variant': surfaceVariantColor,
        error: errorColor,
        success: successColor,
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
        VTextField: {
            'hide-details': 'auto',
            rounded: 0,
        },
        VTextarea: {
            'hide-details': 'auto',
            rounded: 0,
        },
        VCard: {
            rounded: 0,
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
    title: (title) => title ? `${title} - ${appName}` : `${appName}`,
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
