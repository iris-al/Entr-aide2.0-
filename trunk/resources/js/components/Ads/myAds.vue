<template>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="other">
  {{ info }}
</div>
<div class="card">
         <div class="card-header">
            <label for="title">Les posts récents</label>
        </div>
<div class="card-body"> 
<form @submit.prevent="searchads">
<div class ="form-group">
<input type="text" class="form-control" id="words" v-model="formSearch.words" />
<button type="submit" class="btn btn-primary">Rechercher</button>
</div>
</form>
<form>
<div id ="results">
<!--<img class="card-img-top" src="https://via.placeholder.com/350*150" alt="Card image">-->
<div v-for="ad in ads" v-if="ad.user_id==current_user" v-bind:key="ad.id" class="card mb-3" style="width: 100%">
  <div class="card-body">
    <h4 class="card-title" style="color:gray">Title :<b> {{ ad.title }} </b></h4>
    <p style="color:gray"><b>localisation :</b> {{ ad.localisation }}</p>
    <p style="color:gray"><b>description :</b> {{ ad.description }}</p>
    <p style="color:gray"><b>categorie :</b> {{ ad.categorie }}</p>
    <a href="#" @click="modif(ad)"  class="btn btn-primary" >modifier</a>
    <a href="#" @click="del(ad.id)"  class="btn btn-primary">Supprimer</a>
  </div>
</div>
</div>
</form>
</div>
<div class= "card-footer pb-0 pt-3">
<nav>
<ul class="pagination justify-content-center">
<li v-for="n in pagination.last_page" v-bind:key="n" v_bind:class="{active: !pagination.current_page == n}" class="page-item"><a href="#" @click="viewAds(n)" class="page_link">{{n}}</a></li>
</ul>
</nav>
</div>
</div>
</div>
<!-- debut modif ################################-->
<aside class="mymodal" v-if="edit">
<div class="mymodal-wrapper">
 <div>
        <div>
         <div>
            <label for="title">Modifiez votre annonce</label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span  @click="edit=false">&times;</span>
            </button>
        </div>
        <div>
        <form @submit.prevent="update(formAnnonce)">
        	<div class="form-group row">
			    <label for="title">Titre de l'annonce</label>
                <input type="text" class="form-control" id="title" aria-describedby="title" name="title" v-model="formAnnonce.title" >
          </div>
			  <div class="form-group row">
				  <label for="description">Description de l'annonce</label>
				   <textarea name="description" class="form-control" id="description" v-model="formAnnonce.description" cols="30" rows="10"  ></textarea>
			  </div>
			  <div  class="form-group row">
				  <label for="localisation">localisation</label>
				  <input name="localisation" class="form-control" v-model="formAnnonce.localisation" id="localisation"  ></textarea>
			  </div>
            <div class="form-group row">
            <select class="form-control" v-model="formAnnonce.categorie" id="categorie" name="categorie">
            <option disabled >Choisissez</option>
            <option value="Bricolage">Bricolage</option>
            <option value="Babysitting/cours">Babysitting et cours de soutien</option>
            <option value="Dons/prêts">Dons ou prêts d'objet</option>
            <option value="Transport/déménagement">Transport et déménagement</option>
            <option value="Animaux">Animaux</option>
            <option value="Autre">Autre</option>
            </select>
            </div>
            <div class="form-group row">
            <input name="image" id="upload-file" type="file" multiple @change="imageChanged">
            </div>
              <div>
			      	<button type="submit" class="btn btn-primary">modifier mon annonce</button>
              <button type="submit" class="btn btn-primary" @click="edit=false">Annuler</button>
			   </div>
        </form>
  </div>
</div>

</div>
</div>
</aside>
<!-- fin modif  #############################--> 
</div>
</div>
</div>
</template>

<style>
.pagination {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.pagination > li {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ddd;
}

.pagination li.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination li:hover:not(.active) {background-color: #ddd;}

.pagination li:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination li:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
.mymodal {
  position : fixed;
  align-items: center;
  justify-content:center;
  top:0;
  left:0;
  width: 100%;
  height:100%;
  background:rgba(0,0,0,0.5);
}
.mymodal-wrapper {
  align-items: center;
  justify-content:center;
  overflow:auto;
  width: 500px;
  height:500px;
  margin-left: 30%;
  margin-right: 30%;
  margin-top: 2%;
  margin-bottom: 5%;
  nav-width : calc(100px - 50px);
  nav-height : calc(100vh -50px);
  padding : 20px;
  background-color:white;
}
@media (max-width: 780px){
    aside
    {
        top: 100%;
    }

    .mymodal-wrapper
    {
        width: 100%;
        margin-left: 0;
        margin-right: 0;
        margin-top: 0;
        height:100%;
        nav-width : calc(100px - 10px);
        nav-height : calc(100vh -10px);
        margin-bottom:0 ; 
      
    }
}


</style>

<script>
import swal from 'sweetalert2'
import VModal from 'vue-js-modal'
import Vue from 'vue';
import {addAnnonce} from '../../Helpers/ad.js';
import {RechAnnonce} from '../../Helpers/ad.js';
import {affAnnonce} from '../../Helpers/ad.js';
import {putAnnonce} from "../../Helpers/ad.js";
Vue.use(VModal)

export default {
    name: 'aff2-annonce',
    data(){
        return {
           ads:{}, 
           ad:{  
             //id:0,
             title:'',
             description:'',
             localisation:'',
             categorie:'',
             //user_id:0
           },
           ad_id:'',
           info: null,
           current_page: 0,
           pagination: {},
           page:1,
           formSearch: {
            words: '',
            },
            current_user:0,
            edit: false,
            delete: false,

            formAnnonce: {
            title: '',
            description: '',
            localisation: '',
            categorie: '',
            user_id:this.$store.getters.currentUser.id,
            filename: "vide"
            },
            attachments:[],
            form : new FormData,
            error: null,
            id:0
          }

    },
    mounted () {
     
      if(this.page != 1) {this.viewAds(this.page);}
      else {
        axios
          .get('/api/ads/annonces')
          .then(response => (this.ads = response.data.ads.data))
      }
    },
    created () {
       /*permet de récuperer les annonces a afficher a la création de la page
       seulement si les annonces appartiennent a l'utisateur connecté*/
      this.viewAds();
      this.current_user  = this.$store.getters.currentUser.id;
    },
    methods : {
      viewAds(n){
        this.page = n;
        axios  
          .get('/api/ads/annonces?page='+this.page)
          .then(response => 
          ( this.pagination = {
              current_page: response.data.ads.current_page,
              last_page: response.data.ads.last_page,
              from_page: response.data.ads.from,
              to_page: response.data.ads.to,
              total_page: response.data.ads.total,
              path_page: response.data.ads.path+"?page=",
        
              },
            this.ads = response.data.ads.data)
          )
      },
      searchads(){
            RechAnnonce(this.$data.formSearch)
            .then(res => (this.ads = res.data.ads.data,
                    this.pagination = {
                      current_page: res.data.ads.current_page,
                      last_page: res.data.ads.last_page,
                      from_page: res.data.ads.from,
                      to_page: res.data.ads.to,
                      total_page: res.data.ads.total,
                      path_page: res.data.ads.path+"?page=" }
                )
            )
            .catch(error => {
                console.log("ERREUR ANNONCE "+error);
            })
        },
        del(id){
          /*fonction qui supprime une annonce aprés confirmation*/
                     swal.fire({
                        title: 'Etes-vous sur?',
                        text: "Vous ne pourrez plus revenir en arrière!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, Supprime le!'
                        }).then((result) => {
                          if (result.value) {
                              axios
                              .get('/api/ads/deleteannonce/'+id)
                              .then(()=>{
                                     swal.fire(
                                            'Supprimé!',
                                            'Votre annonce a été supprimé.',
                                            'success'
                                            ).then(() =>(
                                              this.$router.go(0)
                                            ))
                              })
                          }
                            else {
                                swal.fire("Echec!", "Il ya un problème.", "warning")
                            }                                
                        })
                      
                 },
        modif(annonce){

             // on recuperer l'objet annonce et on met edit a true la fenetre modele se met ducoup en mode show
             this.formAnnonce = annonce; 
             this.edit=true;
          },
        updateAnnonce(ad){    
            putAnnonce(this.$data.formAnnonce, ad)
           .then(res => {
            swal.fire("Votre annonce a bien été modifié.", "success")
                  this.$router.push({ path: "/ads" });
        })
        .catch(error => {
            console.log("ERREUR ANNONCE " + error);
        });
        },
        update(ad){
          // si il y a une image
            if(this.attachments.length != 0){

            for (let i = 0; i < this.attachments.length; i++) {
            this.form.append("pics[]", this.attachments[i]);
            }
            const config = { headers: { "Content-Type": "multipart/form-data" } };
            document.getElementById("upload-file").value = [];
            axios.post("/api/ads/image", this.form, config).then(response => {
            //success
            // je récupère le nom de l'image stocké dans le serveur pour l'envoyé dans la BDD
            this.$data.formAnnonce.filename = response.data.filename;
        
            /* mnt j'envoie l'annonce avec le nom de l'image */
           this.updateAnnonce(ad);
           });
            }else{
            /* j'envoie l'annonce  */
            
           this.updateAnnonce(ad);
            }
          },
          imageChanged(e) {
          let selectedFiles = e.target.files;
          if (!selectedFiles.length) {
          return false;
          }

          for (let i = 0; i < selectedFiles.length; i++) {
          this.attachments.push(selectedFiles[i]);
          }
          console.log(this.attachments);
          }
        }
 }
</script>