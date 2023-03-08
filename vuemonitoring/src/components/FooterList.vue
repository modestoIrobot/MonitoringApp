<template>
  <div class="events container">
    <div class="columns is-multiline">
      <div class="column is-4">
        <h1><strong>MONITORING</strong></h1>
        <h2>@2022 - 2022</h2>
        <h2>Conditions d'utilisation</h2>
      </div>
      <div class="column is-2">
        <h1><strong>Informations</strong></h1>
        <h2>Documentation</h2>
        <h2>Aide</h2>
        <h2>A propos</h2>
      </div>
      <div class="column is-2">
        <h1><strong>Statistiques</strong></h1>
        <h2>statistique1</h2>
        <h2>statistique2</h2>
        <h2>statistique3</h2>
      </div>
      <div class="column is-2">
        <h1><strong>Ressources</strong></h1>
        <h2>Code</h2>
        <h2>API</h2>
        <h2>Mobile</h2>
      </div>
      <div class="column is-2">
        <h1><strong>Entreprise</strong></h1>
        <h2>Ojectif</h2>
        <h2>Produits</h2>
        <h2>Création</h2>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'FooterList',
    components: {
    },
  };
</script>
<style lang="scss" scoped>
  .events {
    margin-top: 100px;
    text-align: center;
  }
  strong{
  color: #0080ff;
  }
  h1{
  padding-top: 10px;
  padding-bottom: 10px;
  }
  h2{
  color: #0080ff;
  padding-top: 10px;
  padding-bottom: 10px;
  }
</style>