<template>
  <b-navbar id="navbarhead" toggleable="lg" type="dark" variant="info" style="height:67px; ">
    <b-navbar-brand class="ml-2" href="#">
      <router-link to="/">
        <img class="round-logo" src="../images/logo.png" alt="logo" />
      </router-link>
    </b-navbar-brand>

    <router-link to="/" class="mx-auto">
      <b-navbar-brand id="titletop">Entr'aide 2.0</b-navbar-brand>
    </router-link>
    <!-- Right aligned nav items -->

    <template  v-if="currentUser">
      <router-link
        to="/ProfileSet"
        id="name_user"
      >{{ currentUser.name }}</router-link>
      <b-navbar-nav id="userlogo">
        <i id="userlogo" class="fas fa-user-alt"></i>
      </b-navbar-nav>
    </template>

    <template v-else>
      <router-link
        to="/"
        style="color:white; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:20px"
      >A propos</router-link>

      <b-navbar-nav id="infologo">
        <i id="infologo" class="fas fa-info-circle"></i>
      </b-navbar-nav>
    </template>
  </b-navbar>
</template>

<script>
import { BNavbar, BNavbarBrand, BNavbarNav } from "bootstrap-vue";
import Vue from "vue";

Vue.component("b-navbar-nav", BNavbarNav);

Vue.component("b-navbar-brand", BNavbarBrand);

Vue.component("b-navbar", BNavbar);
export default {
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  }
};
</script>

<style lang="scss" scoped>
.round-logo{
         width: 54px; /* largeur de l'image */
    -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;

     }
      .round-logo:hover {
          margin-top: 15px;
  -webkit-transform: scale(1.5);
  transform: scale(1.5);
      }
  

#userlogo{
    
    margin-left: 5px;
    font-size: 1.1rem;
    color:rgb(158, 218, 255);
}
@media (min-width: 576px) {
    #userlogo{
        font-size: 2rem;
    }
 }

#infologo{
    margin-left: 5px;
    font-size: 30px;
    color:rgb(158, 218, 255);
}



#brand{
    
    position: relative;
}

@media screen and (max-width:800px) {
  table {
    
        width: 250px;
  }
  tr{
        flex-direction: column;
    }
  
}

#titletop{
    font-size: 1rem;
    
}
@media (min-width: 576px) {
    #titletop{
        font-size: 1.5rem;
    }
 }

 #name_user{
    font-size: 0.9rem;
    color:white; 
    font-family:Verdana, Arial, Helvetica, sans-serif;
}
@media (min-width: 576px) {
    #name_user{
        font-size: 1.5rem;
    }
 }

</style>