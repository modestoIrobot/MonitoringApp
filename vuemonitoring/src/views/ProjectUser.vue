<template>
  <div>
   <div class="table0">
      <h2 class="subtitle is-5">Nom du projet: {{ project.name }}</h2>
      <table class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Deploiement</th>
               <th>Type de projet</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{ project.id }}</td>
               <td>{{ project.deployment }}</td>
               <td>{{ project.project_type }}</td>
               <td>{{ project.description }}</td>
               <td>
                  <a @click="showModal1" class="button is-black">  
                     <strong>Modifier</strong>
                  </a>
                  <a @click="dropProject()" class="button is-black">  
                     <strong>Supprimer</strong>
                  </a>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="table1">
      <h2 class="subtitle is-5">Liste des pages</h2>
      <table v-if="pages.filter(page => page.type_page === 'page simple').length == 0" class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Chemin</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  aucune page pour l'instant
               </td>
            </tr>
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Chemin</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item in pages.filter(page => page.type_page === 'page simple')">
               <tr v-bind:key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.path }}</td>
                  <td>{{ item.description }}</td>
                  <td>
                     <router-link :to="{name: 'pageuser', params: {id: project.id , id2: item.id} }">
                        <a class="button is-black">  
                           <strong>Editer</strong>
                        </a>
                     </router-link>
                     <a @click="showModal2" class="button is-black">  
                        <strong>Modifier</strong>
                     </a>
                     <a @click="dropPage(item)" class="button is-black">  
                        <strong>Supprimer</strong>
                     </a>
                  </td>
               </tr>
               <modal4 v-show="isModalVisible2" :item="item" v-if="isModalVisible2" @close="closeModal2">
                  <h3 slot="header">modification de la page</h3>
               </modal4>
            </template>
         </tbody>
      </table>
      <div>
         <a id="create" @click="showModal" class="button is-black">  
            <strong>Créer une page</strong>
         </a>
      </div>
   </div>
   <div class="table2">
      <h2 class="subtitle is-5">Liste des interfaces</h2>
      <table v-if="pages.filter(page => page.type_page === 'interface').length == 0" class="table">
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
               <td>
                  aucune n'interface pour l'instant
               </td>
            </tr> 
         </tbody>
      </table>
      <table v-else class="table">
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
            <template v-for="item in pages.filter(page => page.type_page === 'interface')">
               <tr v-bind:key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.path }}</td>
                  <td>{{ item.uri }}</td>
                  <td>{{ item.description }}</td>
                  <td>
                     <router-link :to="{name: 'interfaceuser', params: {id: project.id , id2: item.id} }">
                        <a class="button is-black">  
                           <strong>Editer</strong>
                        </a>
                     </router-link>
                     <a @click="showModal3()" class="button is-black">  
                        <strong>Modifier</strong>
                     </a>
                     <a @click="dropPage(item)" class="button is-black">  
                        <strong>Supprimer</strong>
                     </a>
                  </td>
               </tr>
               <modal5 v-show="isModalVisible3" :item="item" v-if="isModalVisible3" @close="closeModal3">
                  <h3 slot="header">modification d'une interface</h3>
               </modal5>
            </template> 
         </tbody>
      </table>
   </div>
   <div class="table3">
      <h2 class="subtitle is-5">Configurations effectuée(s)</h2>
      <table v-if="configurations.length == 0" class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Nom variale</th>
               <th>Valeur variale</th>
               <th>Chemin page</th>
               <th>Description</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  aucune configuration pour l'instant
               </td>
            </tr>
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>Nom variable</th>
               <th>Valeur variable</th>
               <th>Chemin page</th>
               <th>Description</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="config in configurations">
               <tr v-bind:key="config.id">
                  <td>{{ config.id }}</td>
                  <td>{{ config.configuration }}</td>
                  <td>{{ config.name }}</td>
                  <td>{{ config.value }}</td>
                  <td>{{ config.path }}</td>
                  <td>{{ config.description }}</td>
               </tr>
            </template>
         </tbody>
       </table>
    </div>
    <modal2 v-show="isModalVisible" v-if="isModalVisible" @close="closeModal">
      <h3 slot="header">creation d'une page</h3>
    </modal2>
    <modal3 v-show="isModalVisible1" v-if="isModalVisible1" @close="closeModal1">
      <h3 slot="header">modification du projet</h3>
    </modal3>
  </div>
</template>
<script>
import axios from 'axios';
import ModalWindow from "@/components/ModalWindow";
import ModalWindow2 from "@/components/ModalWindow2";
import ModalWindow3 from "@/components/ModalWindow3";
import ModalWindow4 from "@/components/ModalWindow4";
import ModalWindow5 from "@/components/ModalWindow5";
export default {
   data() {
      return {
         pages: [],
         configurations: [],
         project: {},
         isModalVisible: false,
         isModalVisible1: false,
         isModalVisible2: false,
         isModalVisible3: false            
      }
   },
   async created () {
      const response = await axios.get('http://localhost:8000/api/projects/'+this.$route.params.id+'/pages');   
      this.pages = response.data.data;
      const result = await axios.get('http://localhost:8000/api/'+this.$route.params.id+'/variablesProject');
      this.configurations = result.data.Variables;
      const temp = await axios.get('http://localhost:8000/api/'+this.$route.params.id2+'/projects/'+this.$route.params.id);
      this.project = temp.data.data;
      console.log(temp.data.data); 
   },
   components: {
      ModalWindow,
      ModalWindow2,
      ModalWindow3,
      ModalWindow4,
      ModalWindow5
   },
   methods: {
      showModal() {
        this.isModalVisible = true;
      },
      showModal1() {
        this.isModalVisible1 = true;
      },
      showModal2() {
        this.isModalVisible2 = true;
      },
      showModal3() {
        this.isModalVisible3 = true;
      },
      closeModal(value) {
        this.isModalVisible = false;
        const idx = this.pages.length - 1;
        this.pages.splice(idx, 0, value);
      },
      closeModal1(value) {
        this.isModalVisible1 = false;
        this.project = value;
      },
      closeModal2({value1, value2}) {
        this.isModalVisible2 = false;
        const idx = this.pages.indexOf(value1);
        console.log("indice"+idx);
        this.pages.splice(idx, 1, value2);
      },
      closeModal3({value1, value2}) {
        this.isModalVisible3 = false;
        const idx = this.pages.indexOf(value1);
        this.pages.splice(idx, 1, value2);
      },
      async dropProject() {
         const response = await axios.delete('http://localhost:8000/api/projects/'+this.$route.params.id);    
         console.log(response.data.message);
         this.$router.push({ name: 'projects' });
      },
      async dropPage(item) {
         const response = await axios.delete('http://localhost:8000/api/projects/'+this.$route.params.id+'/pages/'+item.id);    
         const idx = this.pages.indexOf(item);
         this.pages.splice(idx, 1);
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

   .table3{
      margin-top: 10%;
      border: 1px solid #fff;
      box-shadow: 2px 2px 20px black;
   }

   h2{
      text-align: center;
   }

   #create{
      left: 86%;
   }
</style>