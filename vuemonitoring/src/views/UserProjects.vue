<template>
  <div v-if="projects.length == 0" class="projects container">
    <h2 class="subtitle is-3">Liste des projets dont vous êtes développeur</h2>
    <div>
      <h3>Aucun projet pour l'instant</h3>
    </div>
  </div>
  <div v-else class="projects container">
    <h2 class="subtitle is-3">Liste des projets dont vous êtes développeur</h2>
    <div class="columns is-multiline">
      <div v-for="project in projects" :project="project" :key="project.id" class="column is-one-quarter">
        <router-link :to="{name: 'projectuser', params:{id: project.id, id2: project.user_id}}">
          <ProjectCard :project="project" />
        </router-link>
      </div>
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
      const response = await axios.get('http://localhost:8000/api/UserProjects');  
      this.projects = response.data.ProjectsList;
      console.log(response.data.ProjectsList); 
    }
  }
</script>
<style lang="scss" scoped>
  .projects {
    margin-top: 100px;
    text-align: center;
  }

  h3{
    margin-top: 15%;
    text-align: center;
  }
</style>