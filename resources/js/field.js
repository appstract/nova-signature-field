import VueSignaturePad from 'vue-signature-pad';

Nova.booting((Vue, router, store) => {
    Vue.use(VueSignaturePad);

    Vue.component('index-nova-signature-field', require('./components/IndexField'));
    Vue.component('detail-nova-signature-field', require('./components/DetailField'));
    Vue.component('form-nova-signature-field', require('./components/FormField'));
});
