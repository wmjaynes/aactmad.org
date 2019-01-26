import Vue from 'vue';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);

Vue.component('tts-registration', require('./components/tts.registration.vue'));
Vue.component('mis-registration', require('./components/mis.registration.vue'));
Vue.component('email-lists', require('./components/email.lists.vue'));
Vue.component('member-registration', require('./components/member.registration.vue'));

new Vue({
    el: '#app',
});
