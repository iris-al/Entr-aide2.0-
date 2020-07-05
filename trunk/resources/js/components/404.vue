<template>
  <div id="notFound">
    <img src="../images/404.jpg" class="center-block logo" width="400">

    <div class="text-center col-sm-12">
    
     
      <h1>Lost.</h1>
      <h4>This page doesn't exist.</h4>
      <router-link to="./" class="vertical-5p lead">Take me home.</router-link>
    </div>
  </div>
</template>
<script>
import Header from "./header.vue";
export default {
  name: 'NotFound'
}
</script>

<style>
#notFound {
  color: red;
}
</style>