import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'       // import bootstrap globally

require('./bootstrap');

window.Vue = require('vue');

import App from "./App.vue";

new Vue({
    el: '#app',
    components: {
        App
    }
});
