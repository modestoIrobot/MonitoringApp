import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import 'bulma/css/bulma.css';
import ModalWindow from './components/ModalWindow'
import ModalWindow2 from './components/ModalWindow2'
import ModalWindow3 from './components/ModalWindow3'
import ModalWindow4 from './components/ModalWindow4'
import ModalWindow5 from './components/ModalWindow5'
import ModalWindow6 from './components/ModalWindow6'
import ModalWindow7 from './components/ModalWindow7'
import ModalWindow8 from './components/ModalWindow8'
import ModalWindow9 from './components/ModalWindow9'
import ModalWindow10 from './components/ModalWindow10'
import ModalWindow11 from './components/ModalWindow11'
import ModalWindow12 from './components/ModalWindow12'
import ModalWindow13 from './components/ModalWindow13'
import Notifications from 'vue-notification'
import Vuelidate from 'vuelidate'

Vue.component('Modal', ModalWindow);
Vue.component('Modal2', ModalWindow2);
Vue.component('Modal3', ModalWindow3);
Vue.component('Modal4', ModalWindow4);
Vue.component('Modal5', ModalWindow5);
Vue.component('Modal6', ModalWindow6);
Vue.component('Modal7', ModalWindow7);
Vue.component('Modal8', ModalWindow8);
Vue.component('Modal9', ModalWindow9);
Vue.component('Modal10', ModalWindow10);
Vue.component('Modal11', ModalWindow11);
Vue.component('Modal12', ModalWindow12);
Vue.component('Modal13', ModalWindow13);
Vue.use(Notifications)
Vue.use(Vuelidate);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  data: {
    isModalVisible: false,
    isModalVisible1: false,
    isModalVisible2: false,
    isModalVisible3: false,
    isModalVisible4: false,
    isModalVisible5: false,
    isModalVisible6: false,
    isModalVisible7: false,
    isModalVisible8: false,
    isModalVisible9: false,
    isModalVisible10: false,
    isModalVisible11: false,
    isModalVisible12: false,
    isModalVisible13: false
  },
  created () {
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.$store.commit('setUserData', userData)
    }
    axios.interceptors.response.use(
      response => response,
      error => {
        if (error.response.status === 401) {
          this.$store.dispatch('logout')
        }
        return Promise.reject(error)
      }
    )
  },
  render: h => h(App)
}).$mount('#app')

