<template>
  
  <main class="container">

    <Header />
    <router-view></router-view> <!-- this is the tag to inject the pages components, similar to the 'yield'method in laravel -->

  </main>
</template>

<script>

import Header from './components/Header.vue';

export default {
    name: 'App',
    components: {
      Header
    }
}
</script>

<style lang="scss">

  @import '../sass/frontoffice/global.scss';

</style>