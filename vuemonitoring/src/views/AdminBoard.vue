<template>
  <div id="wrapper">
  <NavUser /> 
  <div id="inner" class="columns">
    <aside class="menu">
      <p class="menu-label">
        Menu
      </p>
      <ul class="menu-list">
        <router-link to="#">
          <li><a>Statistiques</a></li>
        </router-link>
        <router-link :to="{name: 'listprojects'}">
          <li><a>Developpeurs</a></li>
        </router-link>
      </ul>
    </aside>
    <section class="column content">
      <router-view></router-view>
    </section>
  </div>  
  </div>
</template>

<script>
  import NavUser from '../components/partials/NavUser.vue';
  export default {
    name: "AdminBoard",
    components: {
      NavUser
    }
  }
</script>

<style lang="scss" scoped>

  #inner {
    float:left; 
    clear: both;
    width:101%;
    max-height: 100%;
    height: 100%;
  }

  .menu {
    position: sticky;
    display: inline-block;
    vertical-align: top;
    overflow-y: auto;
    width: 20%;
    min-height: 100vh;
    max-height: 100%;
    padding: 30px;
    bottom: 0;
    background-color: #000000;
  }

  .content {
    display: inline-block;
    width: 80%;
    //background-color: #888888; 
  }

</style>
