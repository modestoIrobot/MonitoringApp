<template>
  <div class="notification is-danger" v-if="errors.length">
    <button @click="resetErrors" class="delete"></button>
    {{ errors }}
  </div>
</template>
<script>
  export default {
    
    name: 'SignalError',
    props: ['errors'],
    methods: { 
      resetErrors () {
        this.$emit('close');
      }
    }

  };
</script>
<style lang="scss" scoped>
 
</style>