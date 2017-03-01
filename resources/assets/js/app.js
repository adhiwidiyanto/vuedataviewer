import Vue from 'vue'

import DataViewer from './components/DataViewer.vue'

Vue.config.devtools = true

const app = new Vue({
    el: '#app',
    components: {
      DataViewer
    }
});
