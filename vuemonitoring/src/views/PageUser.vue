<template>
  <div>
   <div class="table0">
      <h2 class="subtitle is-5">Nom de la page: {{ page.name }}</h2>
      <table class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Chemin</th>
               <th>Uri</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{ page.id }}</td>
               <td>{{ page.name }}</td>
               <td>{{ page.path }}</td>
               <td>{{ page.uri }}</td>
               <td>{{ page.description }}</td>
               <td>
                  <a @click="showModal8" class="button is-black">  
                     <strong>Modifier</strong>
                  </a>
                  <a @click="dropPage" class="button is-black">  
                     <strong>Supprimer</strong>
                  </a>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="table1">
      <h2 class="subtitle is-5">Liste des fonctions</h2>
      <table v-if="fonctions.length == 0" class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Workflow</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  aucune fonction pour l'instant
               </td>
            </tr>
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Workflow</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item in fonctions">
               <tr v-bind:key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.workflow }}</td>
                  <td>{{ item.description }}</td>
                  <td>
                     <a @click="showModal9" class="button is-black">  
                        <strong>Modifier</strong>
                     </a>
                     <a @click="dropFonction(item)" class="button is-black">  
                        <strong>Supprimer</strong>
                     </a>
                  </td>
               </tr>
               <modal9 v-show="isModalVisible9" :item="item" v-if="isModalVisible9" @close="closeModal9">
                  <h3 slot="header">modification de la fonction</h3>
               </modal9>
            </template>
         </tbody>
      </table>
      <div>
         <a id="create" @click="showModal6" class="button is-black">  
            <strong>Créer une fonction</strong>
         </a>
      </div>
   </div>
   <div class="table2">
      <h2 class="subtitle is-5">Liste des variables</h2>
      <table v-if="variables.length == 0" class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom Configuration</th>
               <th>Nom</th>
               <th>Valeur</th>
               <th>Page</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  aucune variable pour l'instant
               </td>
            </tr> 
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom Configuration</th>
               <th>Nom</th>
               <th>Valeur</th>
               <th>Page</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item in variables">
               <tr v-bind:key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.configuration }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.value }}</td>
                  <td>{{ item.page_path }}</td>
                  <td>{{ item.description }}</td>
                  <td>
                     <a @click="showModal10()" class="button is-black">  
                        <strong>Modifier</strong>
                     </a>
                     <a @click="dropVariable(item)" class="button is-black">  
                        <strong>Supprimer</strong>
                     </a>
                  </td>
               </tr>
               <modal10 v-show="isModalVisible10" :item="item" v-if="isModalVisible10" @close="closeModal10">
                  <h3 slot="header">modification d'une variable</h3>
               </modal10>
            </template> 
         </tbody>
      </table>
      <div>
         <a id="create" @click="showModal7" class="button is-black">  
            <strong>Créer une variable</strong>
         </a>
      </div>
    </div>
    <modal6 v-show="isModalVisible6" v-if="isModalVisible6" @close="closeModal6">
      <h3 slot="header">creation d'une fonction</h3>
    </modal6>
    <modal7 v-show="isModalVisible7" v-if="isModalVisible7" @close="closeModal7">
      <h3 slot="header">creation d'une variable</h3>
    </modal7>
    <modal8 v-show="isModalVisible8" v-if="isModalVisible8" @close="closeModal8">
      <h3 slot="header">modification de la page</h3>
    </modal8>
  </div>
</template>
<script>
import axios from 'axios';
import ModalWindow6 from "@/components/ModalWindow6";
import ModalWindow7 from "@/components/ModalWindow7";
import ModalWindow8 from "@/components/ModalWindow8";
import ModalWindow9 from "@/components/ModalWindow9";
import ModalWindow10 from "@/components/ModalWindow10";
export default {
   data() {
      return {
         fonctions: [],
         variables: [],
         page: {},
         isModalVisible6: false,
         isModalVisible7: false,
         isModalVisible8: false,
         isModalVisible9: false,
         isModalVisible10: false            
      }
   },
   async created () {
      const response = await axios.get('http://localhost:8000/api/pages/'+this.$route.params.id2+'/fonctions');   
      this.fonctions = response.data.data;
      const recut = await axios.get('http://localhost:8000/api/pages/'+this.$route.params.id2+'/variables');
      this.variables = recut.data.data;
      const temp = await axios.get('http://localhost:8000/api/projects/'+this.$route.params.id+'/pages/'+this.$route.params.id2);
      this.page = temp.data.data; 
   },
   components: {
      ModalWindow6,
      ModalWindow7,
      ModalWindow8,
      ModalWindow9,
      ModalWindow10
   },
   methods: {
      showModal6() {
        this.isModalVisible6 = true;
      },
      showModal7() {
        this.isModalVisible7 = true;
      },
      showModal8() {
        this.isModalVisible8 = true;
      },
      showModal9() {
        this.isModalVisible9 = true;
      },
      showModal10() {
        this.isModalVisible10 = true;
      },
      closeModal6(value) {
        this.isModalVisible6 = false;
        const idx = this.fonctions.length - 1;
        this.fonctions.splice(idx, 0, value);
      },
      closeModal7(value) {
        this.isModalVisible7 = false;
        const idx = this.variables.length - 1;
        this.variables.splice(idx, 0, value);
      },
      closeModal8(value) {
        this.isModalVisible8 = false;
        this.page = value;
      },
      closeModal9({value1, value2}) {
        this.isModalVisible9 = false;
        const idx = this.fonctions.indexOf(value1);
        this.fonctions.splice(idx, 1, value2);
      },
      closeModal10({value1, value2}) {
        this.isModalVisible10 = false;
        const idx = this.variables.indexOf(value1);
        this.variables.splice(idx, 1, value2);
      },
      async dropPage() {
         const response = await axios.delete('http://localhost:8000/api/projects/'+this.$route.params.id+'/pages/'+this.$route.params.id2);    
         console.log(response.data.message);
         this.$router.push({ name: 'projectuser', params: {id: this.$route.params.id} });
      },
      async dropFonction(item) {
         const response = await axios.delete('http://localhost:8000/api/pages/'+this.$route.params.id2+'/fonctions/'+item.id);    
         const idx = this.fonctions.indexOf(item);
         this.fonctions.splice(idx, 1);
         console.log(response.data.message);
      },
      async dropVariable(item) {
         const response = await axios.delete('http://localhost:8000/api/pages/'+this.$route.params.id2+'/variables/'+item.id);    
         const idx = this.variables.indexOf(item);
         this.variables.splice(idx, 1);
         console.log(response.data.message);
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

   #create{
      left: 80%;
   }
</style>
