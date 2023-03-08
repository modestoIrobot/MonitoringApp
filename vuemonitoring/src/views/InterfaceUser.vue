<template>
  <div>
   <div class="table0">
      <h2 class="subtitle is-5">Nom de l'interface: {{ interface.name }}</h2>
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
               <td>{{ interface.id }}</td>
               <td>{{ interface.name }}</td>
               <td>{{ interface.path }}</td>
               <td>{{ interface.uri }}</td>
               <td>{{ interface.description }}</td>
               <td>
                  <a @click="showModal11" class="button is-black">  
                     <strong>Modifier</strong>
                  </a>
                  <a @click="dropInterface" class="button is-black">  
                     <strong>Supprimer</strong>
                  </a>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="table1">
      <h2 class="subtitle is-5">Liste des widgets</h2>
      <table v-if="widgets.length == 0" class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>fonction</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  aucun widgets pour l'instant
               </td>
            </tr>
         </tbody>
      </table>
      <table v-else class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nom</th>
               <th>fonction</th>
               <th>Description</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <template v-for="item in widgets">
               <tr v-bind:key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.fonction }}</td>
                  <td>{{ item.description }}</td>
                  <td>
                     <router-link :to="{name: 'widgetuser', params: {id: $route.params.id, id2: interface.id, id4: item.id} }">
                        <a class="button is-black">  
                           <strong>Attribuer</strong>
                        </a>
                     </router-link>
                     <a @click="showModal13" class="button is-black">  
                        <strong>Modifier</strong>
                     </a>
                     <a @click="dropWidget(item)" class="button is-black">  
                        <strong>Supprimer</strong>
                     </a>
                  </td>
               </tr>
               <modal13 v-show="isModalVisible13" :item="item" v-if="isModalVisible13" @close="closeModal13">
                  <h3 slot="header">modification du widget</h3>
               </modal13>
            </template>
         </tbody>
      </table>
      <div>
         <a id="create" @click="showModal12" class="button is-black">  
            <strong>Créer un widget</strong>
         </a>
      </div>
   </div>
   <modal12 v-show="isModalVisible12" v-if="isModalVisible12" @close="closeModal12">
      <h3 slot="header">creation d'un widget</h3>
   </modal12>
   <modal11 v-show="isModalVisible11" v-if="isModalVisible11" @close="closeModal11">
      <h3 slot="header">modification de l'interface</h3>
   </modal11>
  </div>
</template>
<script>
import axios from 'axios';
import ModalWindow11 from "@/components/ModalWindow11";
import ModalWindow12 from "@/components/ModalWindow12";
import ModalWindow13 from "@/components/ModalWindow13";
export default {
   data() {
      return {
         widgets: [],
         interface: {},
         isModalVisible11: false,
         isModalVisible12: false,
         isModalVisible13: false            
      }
   },
   async created () {
      const response = await axios.get('http://localhost:8000/api/pages/'+this.$route.params.id2+'/widgets');   
      this.widgets = response.data.data;
      const temp = await axios.get('http://localhost:8000/api/projects/'+this.$route.params.id+'/pages/'+this.$route.params.id2);
      this.interface = temp.data.data; 
   },
   components: {
      ModalWindow11,
      ModalWindow12,
      ModalWindow13
   },
   methods: {
      showModal11() {
        this.isModalVisible11 = true;
      },
      showModal12() {
        this.isModalVisible12 = true;
      },
      showModal13() {
        this.isModalVisible13 = true;
      },
      closeModal11(value) {
        this.isModalVisible11 = false;
        this.interface = value;
      },
      closeModal12(value) {
        this.isModalVisible12 = false;
        const idx = this.widgets.length - 1;
        this.widgets.splice(idx, 0, value);
      },
      closeModal13({value1, value2}) {
        this.isModalVisible13 = false;
        const idx = this.widgets.indexOf(value1);
        this.widgets.splice(idx, 1, value2);
      },
      async dropInterface() {
         const response = await axios.delete('http://localhost:8000/api/projects/'+this.$route.params.id+'/pages/'+this.$route.params.id2);    
         console.log(response.data.message);
         this.$router.push({ name: 'projectuser', params: {id: this.$route.params.id} });
      },
      async dropWidget(item) {
         const response = await axios.delete('http://localhost:8000/api/pages/'+this.$route.params.id2+'/widgets/'+item.id);    
         const idx = this.widgets.indexOf(item);
         this.widgets.splice(idx, 1);
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

   h2{
      text-align: center;
   }

   #create{
      left: 80%;
   }
</style>
