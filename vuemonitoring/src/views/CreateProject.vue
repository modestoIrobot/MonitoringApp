<template>
	<section class="hero is-fullheight">
  <div class="hero-body has-text-centered">
    <div class="container">
      <div class="columns is-mobile">
  <div class="column is-half is-offset-one-quarter">
  <div class="box">
      
    <form @submit.prevent="create">
      <h2 class="subtitle is-3 has-text-info">Création d'un projet</h2>     
      <div class="field">
        <label class="label">Nom du projet</label>
        <div class="control">
          <input class="input" v-model="name" type="text" placeholder="Nom du projet"/>
        </div>
      </div>
      <div class="field">
        <label class="label">Description</label>
        <div class="control">
          <textarea class="textarea" placeholder="description de projet" v-model="description"></textarea>
        </div>
      </div>  
      <div class="field">
        <label class="label">Deploiement</label>
        <div class="control">
          <textarea class="textarea" placeholder="Descriptifs pour le deploiement" v-model="deployment"></textarea>
        </div>
      </div>
      <div class="field">
        <label class="label">Type de projet</label>
        <div class="control">
          <input class="input" v-model="project_type" type="text" placeholder="Entrer le type de projet"/>
        </div>
      </div>
      <button type="submit" class="button is-info">Créer un projet</button>
      </form>
  </div>
  </div>
  </div>
  </div>   
  </div>
  </section>
</template>
<script>
import axios from 'axios'; 
export default {
	data() {
	  return {
	    name: '',
	    description: '',
	    deployment: '',
	    project_type: ''            
	  }
	},
	methods: {
	    async create() {
        try{
        const id = this.$store.getters.getAuthUser;
		    const response = await axios.post('http://localhost:8000/api/'+id+'/projects', {
            deployment: this.deployment,
            description: this.description,
            name: this.name,
            project_type: this.project_type
          });
		        this.$router.push({ name: 'projects' });
		    }catch(error){
            console.log(error);
        }
	    }
	}
}
</script>
<style>
</style>