<template>
  <div id="app">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">


    <div id="test" class="img-fluid">
      <div class="container">
        
          <div class="col-lg-12 text-center">
           
              <div id= "title" class="section-heading text-uppercase"> <h2><strong>{{name}}</strong></h2></div>
          <div id= "title" class="section-heading text-uppercase"> <h2><strong> Bienvenue sur Entr'aide !</strong></h2></div>
            <img id="roundimage" >
          <br>
          
          <br>
          <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#about">En savoir plus</a>
        </div>
        <br>
        </div>
      </div>
      <br>
      <div class="jumbotron top-space">
		<div class="container">
			
			<h3 class="text-center thin">Nos services</h3>
			
			<div class="row">
				<div class="col-md-4 col-sm-6 highlight">
					<div class="h-caption"><h4>Publiez une annonce sur le site</h4></div>
          <font-awesome-icon :icon="['fas','comment-dots']" class="fa-3x"/>
					<div class="h-body text-center">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque aliquid adipisci aspernatur. Soluta quisquam dignissimos earum quasi voluptate. Amet, dignissimos, tenetur vitae dolor quam iusto assumenda hic reprehenderit?</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 highlight">
					<div class="h-caption"><h4>Répondez à une annonce</h4></div>
          <font-awesome-icon :icon="['fas','comment']" class="fa-3x"/>
					<div class="h-body text-center">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, commodi, sequi quis ad fugit omnis cumque a libero error nesciunt molestiae repellat quos perferendis numquam quibusdam rerum repellendus laboriosam reprehenderit! </p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 highlight">
					<div class="h-caption"><h4>Contactez d'autres utilisateurs</h4></div>
           <font-awesome-icon :icon="['fas','envelope']" class="fa-3x"/>
					<div class="h-body text-center">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, vitae, perferendis, perspiciatis nobis voluptate quod illum soluta minima ipsam ratione quia numquam eveniet eum reprehenderit dolorem dicta nesciunt corporis?</p>
					</div>
				</div>
				
			</div> <!-- /row  -->
		
		</div>
	</div>
  


   

    <!-- About -->
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">A propos</h2>
            <h3 class="section-subheading text-muted">L’application « Entr’aide » vous permettra de poster des annonces et/ou d’y
                    répondre, dans de nombreuses catégories et gratuitement. Le but de cette application
                    est de favoriser l’échange de services et la création de liens entre les utilisateurs.</h3>
          </div>
        </div>
      </div>
    </section>
    <br>
    <div class="jumbotron top-space">
<div class="social-links-demo">
   <h2 class="section-heading text-uppercase">Parlez-en autour de vous</h2>
  <a href="https://www.facebook.com/sharer/sharer.php?" target="_blank" title="Share on Facebook"><i class="fab fa-facebook"></i></a>
  <a href="https://twitter.com/intent/tweet?" target="_blank" title="Tweet"><i class="fab fa-twitter-square"></i></a>
  <a href="https://plus.google.com/share?" target="_blank" title="Share on Google+"><i class="fab fa-google-plus-square"></i></a>
  <a href="http://pinterest.com/pin/create/button/" target="_blank" title="Pin it"><i class="fab fa-pinterest-square"></i></a>
 
</div>
    </div>
   
 

  </div>
</template>


<script >
import Vue from 'vue';
import Header from './header.vue';
import addads from './Ads/addads.vue';
import listads from './Ads/listads.vue';
import myAds from './Ads/myAds.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCommentDots,faComment,faEnvelope } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faCommentDots,faComment,faEnvelope)

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false
export default {
  
      props: {
    config: {
      type: Object
    }
  },
   
        name: 'home',
        components: {Header, addads, listads, myAds},
        computed: {/*to fetch data from store*/
            name() {
                return this.$store.getters.currentUser.name
            }
        }
    }
</script>


<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
body {
  background: black;
}
.jumbotron { color: inherit; background-color: #F7F5F4; padding-top:30px; padding-bottom:30px; margin-bottom:0; }
.container .jumbotron { -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; padding-left:40px; padding-right:40px; }
	.jumbotron p { font-size:inherit; }
	.jumbotron h2, .jumbotron h3, .jumbotron h4, 
	.jumbotron h5, .jumbotron h6 { line-height: 1.3em; }


#test {
    background: url('../images/img.jpg');
    width: 100%;
    height: 390px;
    
}

@media screen and (min-width: 200px) and (max-width: 640px) {
    #test {
        width: 100px;
        background-size: contain;
    }
}

#title{
  color:aliceblue;
  font-family:'Courier New', Courier, monospace;
  font-style:initial;
 font-size:large;

  
}

#usericon{
  size: 100%;
  color: aliceblue;
}
#roundimage{
width: 300px; /* largeur de l'image */
height:200px;
    -webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
 border-radius: 50%; 
    }
    #roundimage:hover {
	-webkit-transform: scale(1.3);
	transform: scale(1.3);
}
.social-links-demo a {     
  font-size: 42px;
  margin: 5px;
  display: inline-block;
}
.social-links-demo .fa-facebook { color: #3b5998 }
.social-links-demo .fa-twitter-square { color: #55acee }
.social-links-demo .fa-google-plus-square { color: #dc4e41 }
.social-links-demo .fa-pinterest-square { color: #bd081c }


</style>