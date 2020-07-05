<template>

<div class="card col-md-11 ml-4 mx-auto" id="cardapp">
  
 <div class="text-center mb-6"  > <h1>Bienvenue sur Entraide2.O</h1> </div>

    <br> <br> <br>
  <div class="text center">  
<transition-group appear name="slide-in" class="grid-wrapper">
<Card v-for="(card, index) in cards" :key="'card'+index"
      :item="card" :index="index"/>
</transition-group>
<br> <br><br> 

<template v-if="!currentUser">
<div class="card col-md-10 mx-auto mt-4" style="background-color: rgba(197, 194, 248, 0.2);">
  <sequential-entrance fromLeft>
 <div class="row ">
    <div class="col-md-6 col-sm-6  highlight">
          <div class="h-caption"><h3>Inscrivez vous!</h3></div>
          <i class="far fa-registered" style="color: rgb(116, 178, 216); font-size:30px"></i> 
          <div class="h-body text-center">
            <p>Inscrivez-vous afin de faire partie de notre communauté!</p>
            <router-link to="/register"  > Je m'inscris. </router-link>
          </div>
        </div>
        <div class="col-md-6 col-sm-6  highlight">
          <div class="h-caption"><h3>Connectez vous!</h3></div>
          <i class="fas fa-sign-in-alt" style="color: rgb(116, 178, 216); font-size:30px"></i> 
          <div class="h-body text-center">
            <p>Accedez à nos services en vous authentifiant!</p>
            <router-link to="/login"  > Je me connecte. </router-link>
          </div>
        </div>
 </div>
  </sequential-entrance>
</div>  

  <br><br>
  </template>
  <template v-else>
    
    <div class="card col-md-10 mx-auto mt-mb-5" style="background-color: rgba(197, 194, 248, 0.2);">
      <sequential-entrance fromLeft>
 <div class="row ">
    <div class="mx-auto mt-3  highlight">
          <div class="h-caption"><h3>Retrouvez toutes les annonces du site ici</h3></div>
          <i class="fas fa-hand-point-down" style="color: rgb(116, 178, 216); font-size:50px"></i> 
          
          <div class="h-body text-center mt-2 mb-2">
            <router-link to="/ads"  > Je consulte les annonces. </router-link>
          </div>
        </div>
 </div>
      </sequential-entrance>
</div>  
    
  <br><br>
  </template>
      <div class="row">
        <div class="col-md-4 col-sm-6 highlight mx-auto">
          <div class="h-caption"><h4>Publiez une annonce sur le site</h4></div>
          <font-awesome-icon :icon="['fas','comment-dots']" class="fa-3x"  style="color:rgb(116, 178, 216); "/>
          <div class="h-body text-center">
            <p>Ici vous pouvez publier toutes les catégories d'annonces afin d'être aidé par votre entourage.</p>
          </div>
        </div>



        <div class="col-md-4 col-sm-6 highlight mx-auto">
          <div class="h-caption"><h4>Répondez à une annonce</h4></div>
          <font-awesome-icon :icon="['fas','comment']" class="fa-3x" style="color: rgb(116, 178, 216);"/>
          <div class="h-body text-center">
            <p>Vous pouvez réagir aux annonces publiées par d'autres utilisateurs en vue de leur apporter votre aide et vice-versa</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 highlight mx-auto">
          <div class="h-caption"><h4>Contactez d'autres utilisateurs</h4></div>
           <font-awesome-icon :icon="['fas','envelope']" class="fa-3x"  style="color: rgb(116, 178, 216);"/>
          <div class="h-body text-center">
            <p>Pour faciliter la communication entre utilisateurs, un système de messagerie instantanée a été mis en place</p>
          </div>
        </div>
        
      </div> <!-- /row  -->
      <div class="jumbotron top-space">
<div class="social-links-demo">
   <h2 class="section-heading text-uppercase" style="font-family:'Avenir', Helvetica, Arial, sans-serif;" >Parlez-en autour de vous</h2>
  <a href="https://www.facebook.com/sharer/sharer.php?" id="share" target="_blank" title="Share on Facebook"><i class="fab fa-facebook"></i></a>
  <a href="https://twitter.com/intent/tweet?" id="share" target="_blank" title="Tweet"><i class="fab fa-twitter-square"></i></a>
  <a href="https://plus.google.com/share?" id="share" target="_blank" title="Share on Google+"><i class="fab fa-google-plus-square"></i></a>
  <a href="http://pinterest.com/pin/create/button/" id="share" target="_blank" title="Pin it"><i class="fab fa-pinterest-square"></i></a>
 
</div>
      </div>
 </div>
</div>
</template>

<script>
import Card from './Card.vue';
import Vue from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCommentDots,faComment,faEnvelope } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'
Vue.use(SequentialEntrance);


library.add(faCommentDots,faComment,faEnvelope)

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false
export default {
       props: {
      config: {
      type: Object
      }
      },
        name: 'welcome',
        components: {Card},
        data: () => {
          return {
            cards: [
              { img: '/img1.png', grid:'card-2-1'},
              { img: '/img2.png', grid:'card-1-1'},
              { img: '/img3.png', grid:'card-1-1'},
              { img: '/img4.png', grid:'card-2-1'},
              { img: '/img5.png', grid:'card-1-1'},
              { img: '/img6.png', grid:'card-1-1'},
            ]
          }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
    }
</script>


<style lang="scss">

*{
  font-size: 1rem;
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
 
  
 

}
#app{
  position: relative;
  padding-right: 10px;
  margin-left: 2px;
  width: 100%;
  text-align: center;
   color:#394246;
  min-height: 100vh;
   background-color : #e8eaf6;


}
#cardapp{
  position:relative;
}
h1 { font-size: 2rem;}
body{
  width: 100%;
  font-family:'Segoe UI', Tahoma;
  background-color: #efefefb9;
  
  

}

.grid-wrapper{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 10px;
}
.slide-in-enter{
  opacity: 0;
  transform: scale(.5);

}
.slide-in-enter-active{
transition: all  .4s ease;
transition-delay: calc( .2s * var(--i) );
}

  .round-logo{
  width: 100px; /* largeur de l'image */
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
  border-radius: 45%; 
    }
    .round-logo:hover {
  -webkit-transform: scale(1.3);
  transform: scale(1.3);
}
.social-links-demo a {     
  font-size: 42px;
  margin: 5px;
  display: inline-block;
}

#share{
  font-size: 50px;
  margin-left: 5px;
   
}
.social-links-demo .fa-facebook { color: #3b5998; }
.social-links-demo .fa-twitter-square { color: #55acee }
.social-links-demo .fa-google-plus-square { color: #dc4e41 }
.social-links-demo .fa-pinterest-square { color: #bd081c }
.jumbotron { color: inherit; background-color: #F7F5F4; padding-top:40px; padding-bottom:30px; margin-bottom:50px; height: 250px;}
.container .jumbotron { -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; padding-left:40px; padding-right:40px; }
  .jumbotron p { font-size:inherit; }
  .jumbotron h2, .jumbotron h3, .jumbotron h4, 
  .jumbotron h5, .jumbotron h6 { line-height: 1.3em; }


</style>
