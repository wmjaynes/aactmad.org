import Vue from 'vue';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);

Vue.component('coming-events-container', require('./components/coming.events.container.vue'));

new Vue({
    el: '#app',
});
