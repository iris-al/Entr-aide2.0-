require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store';
import App from './components/App.vue';/*main component*/
import {initialize} from './helpers/general';
import "bootstrap/dist/css/bootstrap.min.css";
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

import L from 'leaflet';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import { Icon } from 'leaflet';
import StarRating from 'vue-star-rating';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';


Vue.use(VueRouter);
Vue.use(Vuex);
Vue.component('star-rating', StarRating);
window.$ = require('jquery');
Vue.use(Vuetify);

const store = new Vuex.Store(StoreData);/*pour init notre store dans l'app*/
/*création objet router pour front/navigation*/
const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router);

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});

const app = new Vue({
    el: '#app',
    router,/*pour dire à Vue d'utiliser router*/
    store,/*Pour que notre instance utilise le store*/
    components: {/* ici liste des components utiliser dans l'appli*/
        App
    }
});
