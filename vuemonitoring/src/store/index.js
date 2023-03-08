import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

axios.defaults.baseURL = 'http://localhost:8000/api'

export default new Vuex.Store({
  state: {
    user: null,
    permission: JSON.parse(localStorage.getItem('permission')),
    rights: JSON.parse(localStorage.getItem('rights'))
  },

  mutations: {
    setUserData (state, userData) {
      state.user = userData
      state.permission = userData.user.role
      localStorage.setItem('user', JSON.stringify(userData))
      localStorage.setItem('permission', JSON.stringify(userData.user.role))
      axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
    },

    setRightsUser (state, userRights) {
      let temp = [];
      let temp2 = [];
      for(let i = 0; i < userRights.length; i++){
        temp.push(userRights[i].id);
      }
      if(state.rights == null){
        state.rights = temp;
        console.log("valeur1"+state.rights);
        localStorage.setItem('rights', JSON.stringify(temp))  
      }else{
        temp2 = state.rights.concat(temp);
        state.rights = temp2;
        localStorage.setItem('rights', JSON.stringify(temp2))
        console.log("valeur2"+state.rights);
      }
    },

    clearUserData () {
      localStorage.removeItem('user')
      localStorage.removeItem('permission')
      localStorage.removeItem('rights')
      location.reload()
    }

  },

  actions: {
    register ({ commit }, credentials) {
      return axios
        .post('/register', credentials)
        .then(({ data }) => {
          commit('setUserData', data)
        })
    },

    login ({ commit }, credentials) {
      return axios
        .post('/login', credentials)
        .then(({ data }) => {
          commit('setUserData', data)
        })
    },

    logout ({ commit }) {
      return axios
        .post('/logout')
        .then(({ data }) => {
          commit('clearUserData');
          alert(data.message);
        })
    },

    getProjectsUser ({ commit }, id) {
      return axios
        .get('/'+id+'/projects')
        .then(({ data }) => {
          commit('setRightsUser', data.data)
        })
    },

    getDevsUser ({ commit }) {
      return axios
        .get('/UserProjects')
        .then(({ data }) => {
          commit('setRightsUser', data.ProjectsList)
        })
    }

  },

  getters : {
    isLogged: state => !!state.user,
    getPermission(state){
      return state.permission
    },
    getRights(state){
      return state.rights
    },
    getNameUser(state){
      return state.user.user.first_name
    },
    getAuthUser(state){
      return state.user.user.id
    }
  }
})
