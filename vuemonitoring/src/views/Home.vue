<template>
  <div class="home">
    <Nav />
    <section class="hero is-dark">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">PRISE EN MAIN DU CODE</h1>
          <h2 class="subtitle">
            Bienvenue sur notre application
          </h2>
          <div class="button-block">
            <router-link :to="{name: 'SignIn'}" v-if="!isLogged">
              <button class="button is-xl is-info">
                Se connecter pour naviguer
              </button>
            </router-link>
            <h3 v-else class="is-size-3 has-background-info welcome">{{ getNameUser }}</h3>
          </div>
        </div>
      </div>
    </section>
    <EventsList />
    <FooterList />
  </div>
</template>
<script>
  import { mapGetters } from 'vuex';
  import EventsList from '../components/EventsList';
  import FooterList from '../components/FooterList';
  import Nav from '../components/partials/Nav.vue';
  export default {
    name: 'home',
    computed: {
    ...mapGetters([
      'isLogged',
      'getNameUser'
      ])
    },
    components: {
      EventsList,
      FooterList,
      Nav,
    },
  };
</script>
<style lang="scss" scoped>
  .hero {
    text-align: center;
    background-image: url('../../public/banniere.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 400px;
  }
  .hero-body .title {
    text-shadow: 4px 4px 4px rgba(0, 191, 255, 1.0);
    padding: 40px 0 20px 0;
    font-size: 60px;
  }
  .subtitle {
    text-shadow: 4px 4px 4px rgba(0, 191, 255, 1.0);
    font-size: 30px;
  }
  .button-block {
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    color: #0080ff;
    position: absolute;
    bottom: -150px;
    .button {
      margin-right: 50px;
      padding-left: 50px;
      padding-right: 50px;
    }
    .welcome {
      width: 400px;
      padding: 10px;
      margin-left: auto;
      margin-right: auto;
    }
  }
  .is-xl {
    font-size: 1.7rem;
  }

  h3{
    color: white;
  }
</style>