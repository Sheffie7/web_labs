import Vue from 'vue'
import App from './App.vue'
import router from './router'
import Axios from "axios";

Vue.config.productionTip = false

Vue.prototype.$http = Axios.create({
  baseURL: 'http://localhost:8000/v1'
  // baseURL: 'http://192.168.1.2:8000/v1'
});

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
