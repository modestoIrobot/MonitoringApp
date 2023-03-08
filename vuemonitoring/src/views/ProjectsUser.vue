<template>
  <div>
    <router-link :to="{name: 'createProject'}">
      <a class="button is-danger">  
        <strong>Créer un projet</strong>
      </a>
    </router-link>
    <div class="projects container">
      <h2 class="subtitle is-3">Liste de mes projets</h2>
      <div class="columns is-multiline">
        <div v-for="project in projects" :project="project" :key="project.id" class="column is-one-quarter">
          <router-link :to="{name: 'projectuser', params:{id: project.id, id2: project.user_id}}">
            <ProjectCard :project="project" />
          </router-link>
        </div>
      </div>
      <notifications group="foo" />
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import ProjectCard from "@/components/ProjectCard";
  export default {
    name: "ProjectsUser",
    components: {
      ProjectCard
    },
    data () {
      return {
        projects: [],
      }
    },
    async created () {
      const id = this.$store.getters.getAuthUser;
      const response = await axios.get('http://localhost:8000/api/'+id+'/projects');  
      this.projects = response.data.data;
      console.log(response.data.data); 
    },
    methods: {
      rappel(){
        this.$notify({
          group: 'foo',
          title: 'Important message',
          text: 'Hello user! This is a notification!'
        });
      }
    }
  }
</script>
<style lang="scss" scoped>
  .button {
    margin-top: 1%;
    left: 85%;
  }
  .projects {
    margin-top: 2%;
    text-align: center;
  }
</style>