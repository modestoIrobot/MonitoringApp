<template>
  <div class="events container">
    <h2 class="subtitle is-3 has-text-info">Projets récents</h2>
    <div class="columns is-multiline">
      <div v-for="project in projects" :project="project" :key="project.id" class="column is-one-quarter">
        <router-link :to="{name: 'projectuser', params: { id: project.id, id2: project.user_id}}">
          <EventCard :project="project" />
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import EventCard from '@/components/EventCard';
  export default {
    name: 'EventsList',
    components: {
      EventCard,
    },
    data () {
      return {
        projects: [],
      }
    },
    async created () {
      const response = await axios.get('http://localhost:8000/api/last4projects');  
      this.projects = response.data.projects;
      console.log(response.data.data); 
    }
  };
</script>
<style lang="scss" scoped>
  .events {
    margin-top: 100px;
    text-align: center;
  }
</style>