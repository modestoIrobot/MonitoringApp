<template>
  <section class="hero is-fullheight">
  <div class="hero-body has-text-centered">
    <div class="container">
      <div class="columns is-mobile">
  <div class="column is-half is-offset-one-quarter">
  <div class="box">
    <SignalError @close="reset" :errors="errors" /> 
    <form @submit.prevent="login">
      <h2 class="subtitle is-3 has-text-info">Connexion</h2> 
      <div class="field">
        <label class="label">Email</label>
        <div class="control">
          <input class="input" type="email" placeholder="Email input" name="email" v-model="email"/>
        </div>
      </div>
      <div class="field">
        <label class="label">Mot de passe</label>
        <div class="control">
          <input class="input" type="password" placeholder="Text input" name="password" v-model="password"/>
        </div>
      </div>
      <p class="forgot-password text-right">
        <router-link :to="{name: 'ForgotPassword'}">Mot de passe oublié ?</router-link>
      </p>
      <button type="submit" class="button is-info">Connecter</button>
      <p>
        Vous n'avez pas de compte ?
        <router-link :to="{name: 'SignUp'}">inscription</router-link>
      </p>
      </form>
  </div>
  </div>
  </div>
  </div>   
  </div>
  </section>
</template>
<script>
  import SignalError from '@/components/SignalError';
  export default {
    data () {
      return {
        email: '',
        password: '',
        errors: []
      }
    },
    components: {
      SignalError
    },
    methods: {
      login () {
        this.$store
          .dispatch('login', {
            email: this.email,
            password: this.password
          })
          .then(() => {
            const role = this.$store.getters.getPermission;
            const id = this.$store.getters.getAuthUser;
            this.$store.dispatch('getProjectsUser',id);
            this.$store.dispatch('getDevsUser');
            console.log("permis"+role);
            console.log("permission"+JSON.parse(localStorage.getItem('permission')))
            if(role == "admin"){
              this.$router.push({ name: 'AdminBoard' });
            }else{
              if(role == "user"){
                this.$router.push({ name: 'UserBoard' });
              }
            }
          })
          .catch(err => {
            console.log(err);
            this.errors = err.response.data.error;
          })
      },
      reset () {
        this.errors = [];
      }
    },
  }
</script>
<style lang="scss" scoped>
  .hero-body{
    background-color:#000000;
  }
</style>
