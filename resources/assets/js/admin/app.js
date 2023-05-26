//includes
import './bootstrap';
import en from '@admin/translates/en';
import nl from '@admin/translates/nl';
import Notifications from "vue-notification";
import VeeValidate from "vee-validate";
import VueI18n from 'vue-i18n'

//jquery(
require('jquery-form-styler');
window.$ = $.extend(require('jquery-form-styler'));

//Vue main modules
import Vue from 'vue';

//Vue user's modules
import store from '@admin/store';
import router from '@admin/router'

//Views, components
import App from '@admin/views/App';

//use
Vue.use(router);
Vue.use(Notifications);
Vue.use(VeeValidate);
Vue.use(VueI18n);

let i18n = new VueI18n({
    locale: 'nl',
    messages: {
        en: en,
        nl: nl
    }
});

export default new Vue({
    el: '#app',
    router,
    store,
    i18n,
    render: h => h(App),
    created() {
        this.$store.dispatch('auth/setToken');
    }
});