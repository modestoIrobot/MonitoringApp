<template>
  <section class="hero is-fullheight">
  <div class="hero-body has-text-centered">
    <div class="container">
      <div class="columns is-mobile">
  <div class="column is-half is-offset-one-quarter">
  <div class="box">
      
    <form @submit.prevent="register">
      <h2 class="subtitle is-3 has-text-info">Enregistrement</h2>
      
      <div class="field">
        <label class="label">Prénom</label>
        <div class="control">
          <input class="input" v-model="firstname" type="text" placeholder="Text input"/>
        </div>
      </div>
      <div class="field">
        <label class="label">Nom(s)</label>
        <div class="control">
          <input class="input" v-model="lastname" type="text" placeholder="Text input"/>
        </div>
      </div>  
      <div class="field">
        <label class="label">Email</label>
        <div class="control">
          <input class="input" v-model="email" type="email" placeholder="Email input"/>
        </div>
      </div>
      <div class="field">
        <label class="label">Mot de passe</label>
        <div class="control">
          <input class="input" v-model="password" type="password" placeholder="Text input"/>
        </div>
      </div>
      <button type="submit" class="button is-info">Enregistrer</button>
      <p class="forgot-password text-right">
        Déja enregistré
        <router-link :to="{name: 'SignIn'}">connexion?</router-link>
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
  export default {
    name: "register",
    data() {
      return {
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        error: false
      }
    },
    methods:{
      register() {
        this.$store
        .dispatch('register', {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          password: this.password 
          })
        .then(() => {
          this.$router.push({ name: 'SignIn' })
        })
        .catch(err => {
          console.log(err);
          this.error = true;
          this.email = '';
        })
      } 
    }
  }
</script>
<style lang="scss" scoped>
  .hero-body{
  background-color:#000000;
  }
</style>
