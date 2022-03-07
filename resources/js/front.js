import Vue from 'vue';
import App from './views/App';
import router from './routes';
import vueBraintree from 'vue-braintree';

Vue.use(vueBraintree);

const root = new Vue({
    el: '#root',
    router,
    vueBraintree,
    render: h => h(App),
});