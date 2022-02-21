import Vue from 'vue';
import router from 'vue-router';

import App from './views/App';

const root = new Vue({
    el: '#root',
    router,
    render: h => h(App),
});