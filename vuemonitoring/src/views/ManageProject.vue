<template>
  <div>
   <div class="table0">
      <h2 class="subtitle is-5">Nom du projet: {{ project.name }}</h2>
      <table class="table">
         <thead>
            <tr>
               <th>Deploiement</th>
               <th>Type de projet</th>
               <th>Description</th>
               <th>Auteur</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{ project.deployment }}</td>
               <td>{{ project.project_type }}</td>
               <td>{{ project.description }}</td>
               <td>{{ author.first_name}} {{author.last_name }}</td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="table1">
      <h2 class="subtitle is-5">Liste des developpeurs</h2>
      <table v-if="devs.length == 0" class="table">
         <thead>
            <tr>
               <th>Prenom</th>
               <th>Nom</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  Pour l'instant aucun developpeur attribué a part l'auteur
               </td>
            </tr>
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>Prenom</th>
               <th>Nom</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item in devs">
               <tr v-bind:key="item.id">
                  <td>{{ item.first_name }}</td>
                  <td>{{ item.last_name }}</td>
                  <td>
                     <a @click="RemoveDev(item)" class="button is-black">  
                        <strong>Retirer</strong>
                     </a>
                  </td>
               </tr>
            </template>
         </tbody>
      </table>
   </div>
   <div class="table2">
      <h2 class="subtitle is-5">Potentiels developpeurs</h2>
      <table v-if="users.length == 0" class="table">
         <thead>
            <tr>
               <th>Prenom</th>
               <th>Nom</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  Pas de developpeur inscrit pour l'instant
               </td>
            </tr> 
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>Prenom</th>
               <th>Nom</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item in users">
               <tr v-bind:key="item.id">
                  <td>{{ item.first_name }}</td>
                  <td>{{ item.last_name }}</td>
                  <td>
                     <a @click="SetDev(item)" class="button is-black">  
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
         devs: [],
         users: [],
         project: {},
         author: {}            
      }
   },
   async created () {
      const response = await axios.get('http://localhost:8000/api/AdminDevs/'+this.$route.params.id);   
      this.devs = response.data.DevList;
      const recut = await axios.get('http://localhost:8000/api/AdminUsers');
      this.users = recut.data.users;
      const temp = await axios.get('http://localhost:8000/api/AdminProject/'+this.$route.params.id2+'/'+this.$route.params.id);
      this.project = temp.data.project;
      const temp2 = await axios.get('http://localhost:8000/api/AdminUser/'+this.$route.params.id2);
      this.author = temp2.data.user;
   },
   methods: {
      async RemoveDev(item) {
         const response = await axios.delete('http://localhost:8000/api/AdminRemove/'+this.$route.params.id+'/'+item.id);    
         console.log(response.data.message);
         const idx = this.devs.indexOf(item);
         this.devs.splice(idx, 1);
      },
      async SetDev(item) {
         const response = await axios.post('http://localhost:8000/api/AdminAlloy/'+this.$route.params.id+'/'+item.id);    
         console.log(response.data.message);
         const idx = this.devs.length - 1;
         this.devs.splice(idx, 0, item);
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
      border: 1px solid #fff;
      box-shadow: 2px 2px 20px black;
   }

   .table2{
      margin-top: 10%;
      border: 1px solid #fff;
      box-shadow: 2px 2px 20px black;
   }

   h2{
      text-align: center;
   }
</style>
