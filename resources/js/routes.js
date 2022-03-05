// DEPENDENCIES
import Vue from 'vue';
import VueRouter from 'vue-router';

// PAGES IMPORT
import Home from './pages/Home';
import Restaurant from './pages/Restaurant';
import NotFound from './pages/NotFound';
import Checkout from './pages/Checkout';

// VUE ROUTER COMPONENT
Vue.use(VueRouter);

// ROUTES LIST
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/restaurant/:slug',
            name: 'restaurant',
            component: Restaurant
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound
        }
    ]
});

// EXPORT
export default router;