<template>
  <div>
   <div class="table0">
      <h2 class="subtitle is-5">Nom du widget: {{ widget.name }}</h2>
      <table class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Fonction</th>
               <th>Description</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{ widget.id }}</td>
               <td>{{ widget.name }}</td>
               <td>{{ widget.fonction }}</td>
               <td>{{ widget.description }}</td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="table1">
      <h2 class="subtitle is-5">Liste des fonctions disponibles</h2>
      <div class="field">
        <div class="control">
          <input class="input" type="text" placeholder="chercher les fonctions par leur nom..." v-model="searchQuery"/>
        </div>
      </div>
      <table v-if="fonctions.length == 0" class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>workflow</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  Ce projet n'a encore aucune fonction pour l'instant
               </td>
            </tr>
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>workflow</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item of resultQuery">
               <tr v-bind:key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.workflow }}</td>
                  <td>{{ item.description }}</td>
                  <td>
                     <a @click="SetFonction(item)" class="button is-black">  
                        <strong>Attribuer</strong>
                     </a>
                  </td>
               </tr>
            </template>
         </tbody>
      </table>
   </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
   data() {
      return {
         widget: {},
         fonctions: [],
         searchQuery: null            
      }
   },
   async created () {
      const response = await axios.get('http://localhost:8000/api/'+this.$route.params.id+'/fonctionsProject');   
      this.fonctions = response.data.Fonctions;
      const temp = await axios.get('http://localhost:8000/api/pages/'+this.$route.params.id2+'/widgets/'+this.$route.params.id4);
      this.widget = temp.data.data; 
   },
   methods: {
      async SetFonction(item) {
         const response = await axios.put('http://localhost:8000/api/pages/'+this.$route.params.id2+'/widgets/'+this.$route.params.id4, {fonction: item.workflow});    
         console.log(response.data.message);
         this.widget = response.data.data;
      }
   },
   computed: {
      resultQuery() {
         if (this.searchQuery) {
            return this.fonctions.filter(item => {
               return this.searchQuery
               .toLowerCase()
               .split(" ")
               .every(v => item.name.toLowerCase().includes(v));
            });
         } else {
            return this.fonctions;
         }
      }
   }

}
</script>
<style>
   .table0{
      margin-top: 4%;
   }

   .table1{
      margin-top: 10%;
   }

   h2{
      text-align: center;
   }

   #create{
      left: 80%;
   }
</style>
