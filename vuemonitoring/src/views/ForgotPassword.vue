<template>
  <section class="hero is-fullheight">
  <div class="hero-body has-text-centered">
    <div class="container">
      <div class="columns is-mobile">
  <div class="column is-half is-offset-one-quarter">
  <div class="box">
      
    <form>
      <h2 class="subtitle is-3 has-text-info">Mot de passe oublié</h2> 
      <div class="field">
        <label class="label">Email</label>
        <div class="control">
          <input class="input" type="email" placeholder="Email input"/>
        </div>
      </div>
      <button type="submit" class="button is-info">Réinitialiser</button>
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
    data() {
      return {}
    }
  }
</script>
<style lang="scss" scoped>
  .hero-body{
  background-color:#000000;
  }
  
</style>
