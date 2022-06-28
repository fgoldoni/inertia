import './bootstrap';

import {createApp, h} from 'vue'

import {createInertiaApp, Link, Head} from '@inertiajs/inertia-vue3'

import {InertiaProgress} from '@inertiajs/progress'

import {useModal} from '@/Mixins/UseModal'

import Layout from '@/Layouts/App'

import {translations} from '@/Mixins/translations'

import VueGridLayout from 'vue-grid-layout'


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({

    title: (title) => `${title} - ${appName}`,

    resolve: async name => {

        let page = (await import(`./Pages/${name}.vue`)).default

        page.layout ??= Layout;

        return page;
    },
    setup({el, app, props, plugin}) {

        return createApp({render: () => h(app, props)})

            .use(plugin)

            .mixin({methods: {route}})

            .component('Link', Link)

            .component('Head', Head)

            .mixin(useModal)

            .mixin(translations)

            .use(VueGridLayout)

            .mount(el);
    },

});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#29d',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})



