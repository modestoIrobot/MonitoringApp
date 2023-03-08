<template>
  <nav id="navp" class="navbar container" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <strong class="is-size-4">MONITORING</strong>
      </a>
      <a
        role="button"
        class="navbar-burger burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbarBasicExample"
      >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbar" class="navbar-menu">
      <div class="navbar-start">
        <router-link to="/" class="navbar-item">Statistiques</router-link>
        <router-link to="/" class="navbar-item">Ressources</router-link>
        <router-link to="/" class="navbar-item">Entreprise</router-link>
      </div>
      
      <div class="navbar-end">
        <router-link to="/about" class="navbar-item">
          <div class="buttons">
            <a>
              <strong>A propos</strong>
            </a>
          </div> 
        </router-link>
        <router-link to="/signin" v-if="!isLogged" class="navbar-item">
          <div class="buttons">
            <a class="button is-info">
              <strong>Connexion</strong>
            </a>
          </div> 
        </router-link>
        <router-link to="/signup" v-if="!isLogged" class="navbar-item">
          <div class="buttons">
            <a class="button is-info">
              <strong>S'enregistrer</strong>
            </a>
          </div> 
        </router-link>
        <div v-else class="navbar-item">
          <a class="button is-info" @click="logout()">
            <strong>Deconnexion</strong>
          </a>
        </div>           
      </div>
    </div>
  </nav>
</template>
<script>
  import { mapGetters } from 'vuex';
  
  export default {
    name: 'Nav',
    computed: {
    ...mapGetters([
      'isLogged'
      ])
    },

    methods: {
      logout () {
        this.$store.dispatch('logout');
      }
    }

  };
</script>
<style lang="scss" scoped>
  nav {
    margin-top: 10px;
    margin-bottom: 15px;
    a {
      font-weight: bold;
      color: #0080ff;
      &.router-link-exact-active {
        color: #318ce7;
      }
    }
  }
</style>
