<template>
  <div>
    <div class="projects container">
      <h2 class="subtitle is-3">Liste des projets</h2>
      <div class="columns is-multiline">
        <div v-for="project in projects" :project="project" :key="project.id" class="column is-one-quarter">
          <router-link :to="{name: 'projectDev', params: {id: project.id, id2: project.user_id}}">
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
    name: "AllProjects",
    components: {
      ProjectCard
    },
    data () {
      return {
        projects: [],
      }
    },
    async created () {
      const response = await axios.get('http://localhost:8000/api/AdminProjects');  
      this.projects = response.data.projects;
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
  .projects {
    margin-top: 7%;
    text-align: center;
  }

  .columns {
    margin-top: 4%;
  }
</style>