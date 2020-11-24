import Vue from 'vue';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);

Vue.component('tts-registration', require('./components/tts.registration.vue').default);
Vue.component('mis-registration', require('./components/mis.registration.vue').default);
Vue.component('email-lists', require('./components/email.lists.vue').default);
Vue.component('member-registration', require('./components/member.registration.vue').default);

new Vue({
    el: '#app',
});
