<template>
  <nav id="nav" class="navbar container" role="navigation" aria-label="main navigation">
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
        <div class="navbar-item" v-if="getPermission == 'user'"><p>Developpement</p></div>
        <div class="navbar-item" v-else><p>Administration</p></div>
      </div>
        
      <div class="navbar-end">
        <div class="navbar-item">
          Bienvenue<p>&nbsp;{{ getNameUser }}</p>
        </div>
        <div class="navbar-item">
          <a class="button is-white" @click="logout()">
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
  
    name: "NavUser",
    computed: {
    ...mapGetters([
      'getPermission',
      'getNameUser'
      ])
    },
    methods: {
      logout () {
        this.$store.dispatch('logout');
      }
    }

  }
</script>

<style lang="scss" scoped>
  #nav {
    float:left;
    max-width:100%;
    width:100%;
    background-color: #000; 
  }

  p{
    color: white;
  }
</style>
