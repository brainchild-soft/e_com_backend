import  Vue from 'vue'
require('../../../../js/bootstrap');

window.Vue = require('vue');
Vue.config.productionTip = false;


import store from './store'
import VueNoty from '../../../../js/helper/Noty'
Vue.use(VueNoty);

import AppStorage from "../../../../js/helper/AppStorage";
window.AppStorage = AppStorage;

/*
* Start Using Translation
*/
import VueI18n from 'vue-i18n';
Vue.use(VueI18n);

import { ENGLISH_TRANSLATIONS } from './lang/en';
import { SOMALIA_TRANSLATIONS } from './lang/so';

const TRANSLATIONS = {
    en: ENGLISH_TRANSLATIONS,
    so: SOMALIA_TRANSLATIONS
};
const i18n = new VueI18n({
    locale: LANG,
    messages: TRANSLATIONS,
});
/*
* End Using Translation
*/

import StarRating from 'vue-star-rating';
Vue.component('star-rating', StarRating);


import VueClazyLoad from 'vue-clazy-load';
Vue.use(VueClazyLoad);

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('index', require('./components/IndexPage').default);

const crocus_v2 = new Vue({
    el: '#kuteshop_v2',
    store:store,
    i18n,
    create(){
      AppStorage.storeLangInfo('en');
    },
    components:{

    }
});
