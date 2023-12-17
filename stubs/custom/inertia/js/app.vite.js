import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { isDark } from './Composables'
import Toast from 'vue-toastification'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'K UI'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, {
                hideProgressBar: true,
                closeOnClick: false,
                closeButton: false,
                icon: false,
                timeout: 5000,
                transition: 'Vue-Toastification__fade',
            })
            .mount(el)
    },
    progress: {
        color: isDark ? '#FFFFFF':'#4B5563',
    },
})