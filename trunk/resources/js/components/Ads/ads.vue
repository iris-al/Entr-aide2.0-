<template>
  
  <div class="container" v-if="ads">

    <div class="row">
      <div class="col-md-8">

        <h1 class="my-4">{{ ads.title }}
          <small>par {{user_ads.name}} </small>
        </h1>
         <span class="ml-auto mr-3">Cette annonce a été vue {{ads.nbr_vue}} fois </span>

        <!-- Infos de l'annonce -->

        <div class="card mb-4">
          <img  v-if="filename" :src="filename" class="card-img-top" id="imagead" width="500" height="300"  alt="Card image cap">
          <div class="card-body " >
            <h2 class="card-title">Concernant cette annonce:</h2>
            <table class="table table-hover table-responsive-lg " id="infotable">
              <tr>
              <th class="table-primary"> Localisation</th>
              <td class="table-primary"> {{ads.localisation }}</td>
              </tr>
              <tr>
              <th class="table-success">Déscription</th>
              <td class="table-success card-text"> {{ads.description }}</td>
              </tr>
              <tr>
              <th class="table-danger"> Catégorie</th>
              <td class="table-danger"> {{ads.categorie }}</td>
              </tr>
            </table>
           <router-link to="./" class="btn btn-primary"> &larr; Retour aux annonces </router-link>
          </div>
          <div class="card-footer text-muted">
            Postée le {{ format_date(ads.created_at) }} par 
            <a href="#aduser">{{user_ads.name}}</a>
          </div>
        </div>

        <!-- Liste des commentaires -->
        <div class="card mb-4 ">
          
          <div class="card-body col-md-10">
            <h2 class="card-title">Commentaires</h2>
            <table class="table table-responsive-xl table-striped w-auto" >
              <div
                v-for="comment in comments"
                v-bind:key="comment.id">
               <tbody>
             <tr>
             <th  scope="row" v-if="comment.user_id==currentUser.id">Vous</th>
                    <th  scope="row" v-else>{{comment.username}}</th>

                    <td>{{comment.body}}</td>
                    <td> <small>Posté le {{ format_date(comment.created_at) }} </small> </td>

                       <td v-if="comment.user_id==currentUser.id">
                      <button class="btn btn-primary btn-sm" @click="supprimer(comment.id)">Supprimer</button>
                    </td>  
             
                    <td v-if="comment.user_id!=currentUser.id">
                    <span  class="btn btn-primary btn-sm" style="width:90px" @click="submitlike(comment)">J'aime  <span class="badge badge-light"> {{comment.like}} </span></span>
                     </td>
                    <td v-if="comment.user_id!=currentUser.id">
                    <span  class="btn btn-primary btn-sm" style="width:130px" @click="submitdislike(comment)">Je n'aime pas <span class="badge badge-light"> {{comment.dislike}} </span></span>
                     </td>
                    </tr>
                  </tbody>
              </div>
                </table>
          </div>
      
        </div>

        <!-- Localisation-->

        <div class="card mb-4 ">
          
          <div class="card-body">
            <h2 class="card-title">Localisation de l'annonce</h2>

            <table class="table-responsive">
              <l-map :zoom="zoom" :center="center" style="height:700px; width:700px">
                <l-tile-layer :url="url" :attribution="attribution" ></l-tile-layer>
                <l-marker :lat-lng="marker"></l-marker>
              </l-map>
            </table>
          </div>
        </div>
      </div>

      
      <div class="col-md-4 " id="rightcards"> 

        <!-- Infos de l'emetteur -->
        <section id="aduser" class="  mx-auto"  >
        <div class="card my-6 ">
          <h5 class="card-header ">Infos de l'émetteur</h5>
          <div class="card-body">
            <div class="row">
              
                <table class="table table table-striped table-dark">
            <tr class="champ-info">Email:</tr>
            <td id="info-user">{{user_ads.email}}</td>
          
            <tr class="champ-info">Nom:</tr>
            <td id="info-user">{{user_ads.name}}</td>
          
            <tr class="champ-info">Nom d'utilisateur:</tr>
            <td id="info-user">{{user_ads.username}}</td>
            <tr class="champ-info">Déscription:</tr>
            <td id="info-user">{{user_ads.bio}}</td>
                </table>

                <router-link to="/chatapp"> Contacter cet utilisateur </router-link>
              
            </div>
          </div>
        </div>
        </section>

        <!-- Notation étoiles -->
        <div class="card my-4 ">
          <h5 class="card-header">Donnez une note !</h5>
          <div class="card-body">
            <div class="star-rating mx-auto">
            <star-rating v-model="rate.rating" :increment="0.5" ></star-rating>
            </div>
            <br>
            <button :disabled="rate.rating == 0" @click="setRating()" class="btn btn-primary">Publier le vote</button>
          </div>
           <h3 class="heading">Historique des votes</h3>
          <div class="review-rating">
            <div class="right-review">
              <div class="row-bar">
                <div class="left-bar">5</div>
                <div class="right-bar">
                  <div class="bar-container">
                    <div class="bar-5" style="width: 0%;"></div>
                  </div>
                </div>
              </div>
              <div class="row-bar">
                <div class="left-bar">4</div>
                <div class="right-bar">
                  <div class="bar-container">
                    <div class="bar-4" style="width: 0%;"></div>
                  </div>
                </div>
              </div>
              <div class="row-bar">
                <div class="left-bar">3</div>
                <div class="right-bar">
                  <div class="bar-container">
                    <div class="bar-3" style="width: 0%;"></div>
                  </div>
                </div>
              </div>
              <div class="row-bar">
                <div class="left-bar">2</div>
                <div class="right-bar">
                  <div class="bar-container">
                    <div class="bar-2" style="width: 0%;"></div>
                  </div>
                </div>
              </div>
              <div class="row-bar">
                <div class="left-bar">1</div>
                <div class="right-bar">
                  <div class="bar-container">
                    <div class="bar-1" style="width: 0%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="justify-content-center">
              <div class="review-title">{{ totalrate }}</div>
              <div class="review-star">
                <star-rating
                  :inline="true"
                  :read-only="true"
                  :show-rating="false"
                  v-model="totalrate"
                  :increment="0.1"
                  :star-size="20"
                  active-color="#000000"
                ></star-rating>
              </div>
              <div class="review-people">
                <i class="fa fa-user"></i>
                {{ totaluser }} total
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</template>

<script>
import moment from "moment";
import swal from "sweetalert2";
import L from "leaflet";
import { LMap, LTileLayer, LMarker } from "vue2-leaflet";

export default {
  name: "ads",

  components: {
    LMap,
    LTileLayer,
    LMarker
  },

  data() {
    return {
      comments: {},
      comment: {
        username: "",
        body: "",
        ad_id: ""
      },

      formComment:{
          username: "",
          body: "",
          ad_id: "",
          user_id:"",
          like:"",
          dislike:"",
      },
      commentid: 0,
      ads: null,
      user_ads: this.$store.getters.currentUser,
      filename: null,
      rate: {
        rating: 0,
        user_id: this.$store.getters.currentUser.id,
        ads_id: this.$route.params.id
      },
      totalrate: 0,
      totaluser: 0,
      //map
      zoom: 13,
      center: "",
      url: "http://{s}.tile.osm.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      marker: ""
    };
  },

  created() {
    this.getAds();  // récupèrer les infos de l'annonce et de son emetteur
    this.getRating(); // récupèrer les notes de l'annonce
    this.getComments(); // récupèrer les commentaires de l'annonce
  },

  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  },

  methods: {
    // fonction qui récupère les info de l'annonce et de son émetteur
    getAds() {
      axios
        .get(`/api/ads/annonce/${this.$route.params.id}`)
        .then(response => {
          this.ads = response.data.ads;
          this.getUrlImage(this.ads.filename);
          this.center = L.latLng(
            response.data.user.latitude,
            response.data.user.longitude
          );
          this.marker = L.latLng(
            response.data.user.latitude,
            response.data.user.longitude
          );
        })
        .catch(err => {
          this.$router.push({ path: "../404" });
        });
    },
  // fonction qui formatte la date et l'heure
    format_date(value) {
      if (value) {
        return moment(String(value)).format("DD/MM/YYYY à HH:MM");
      }
    },

    getUrlImage(url) {
      if (url && url !== "vide") {
        this.filename = "../storage/" + url;
      }
    },

    getComments() {
      axios
        .get(`/api/coms/comments/${this.$route.params.id}`)
        .then(response => (this.comments = response.data.comments))
        .catch(err => {
          console.log("erreur lors de l'affichage des commentaires");
        });
    },
     submitlike(comment) {
      comment.like++;
      this.formComment = comment;
      this.like(this.$data.formComment, comment);
    },
    submitdislike(comment){
     comment.dislike++;
      this.formComment = comment;
      this.dislike(this.$data.formComment, comment);
    },

    like(comment){
    return new Promise((res,rej)=>{
        axios.put('/api/coms/likecomment/'+comment.id, comment)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de l\'insertion de votre like, veuillez réessayer'+err);
        })
    })
    },
    dislike(comment){
    return new Promise((res,rej)=>{
        axios.put('/api/coms/dislikecomment/'+comment.id, comment)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de l\'insertion de votre dislike, veuillez réessayer'+err);
        })
    })
    },
    // fonction qui enregsitre la notation sur cette annonce
    setRating() {
      axios
        .post(`/api/rating/setRating`, this.rate)
        .then(response => {
          swal.fire("Votre vote a bien été pris en compte.", "success");
        })
        .catch(err => {
          swal.fire("Erreur lors du vote.", "error");
        });
    },
  // fonction qui récupère la notation de cette annonce
    getRating() {
      axios.get(`/api/rating/getrating/${this.$route.params.id}`).then(res => {
          var mydata = res.data;
          this.totaluser = mydata.length; // le nombre d'utilisateurs ayant participé au vote
          // calculer la moyenne de tous les votes
          var sum = 0;

          var bar1 = 0;
          var bar2 = 0;
          var bar3 = 0;
          var bar4 = 0;
          var bar5 = 0;

          for (var i = 0; i < mydata.length; i++) {
            // moyenne
            sum += parseFloat(mydata[i]["rating"]);

            //calcule de chaque note
            if (parseInt(mydata[i]["rating"]) == "1") {
              bar1 += 1;
            }
            if (parseInt(mydata[i]["rating"]) == "2") {
              bar2 += 1;
            }
            if (parseInt(mydata[i]["rating"]) == "3") {
              bar3 += 1;
            }
            if (parseInt(mydata[i]["rating"]) == "4") {
              bar4 += 1;
            }
            if (parseInt(mydata[i]["rating"]) == "5") {
              bar5 += 1;
            }            
          }
          var avg = sum / mydata.length;
          this.totalrate = parseFloat(avg.toFixed(1));

          $(".bar-5").css("width", (bar5/this.totaluser).toFixed(1)*100 + "%");
          $(".bar-4").css("width", (bar4/this.totaluser).toFixed(1)*100 + "%");
          $(".bar-3").css("width", (bar3/this.totaluser).toFixed(1)*100 + "%");
          $(".bar-2").css("width", (bar2/this.totaluser).toFixed(1)*100 + "%");
          $(".bar-1").css("width", (bar1/this.totaluser).toFixed(1)*100 + "%");
        })
        .catch(err => {
          console.log(err);
        });
    },
    supprimer(commentid) {
      
      swal
        .fire({
          title: "Etes-vous sur?",
          text: "Vous ne pourrez plus revenir en arrière!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Oui, Supprime le!"
        })
        .then(result => {
          if (result.value) {
            axios.delete("/api/coms/deletecomments/" + commentid).then(() => {
              swal
                .fire(
                  "Supprimé!",
                  "Votre commentaire a été supprimé.",
                  "success"
                )
                .then(() => this.$router.go(0));
            });
          } else {
            swal.fire("Echec!", "Il ya un problème.", "warning");
          }
        });
    }
  }
};
</script>

<style scoped>
/* Star Rating */
* {
  box-sizing: border-box;
}
.fa {
  font-size: 25px;
  
}
.left-bar {
  float: left;
  width: 5%;
  margin-top: 10px;
}
.right-bar {
  margin-top: 10px;
  float: left;
  width: 95%;
}
.row-bar:after {
  content: "";
  display: table;
  clear: both;
}
.review-rating:after {
  content: "";
  display: table;
  clear: both;
}
.right-review {
  float: left;
  width: 100%;
  margin-top: 10px;
}
.review-title {
  font-size: 20pt;
}
.review-star {
  margin: 0 0 10px 0;
}
.review-people .fa {
  font-size: 11pt;
}
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}
.bar-5 {
  height: 18px;
  background-color: #57bb8a;
}
.bar-4 {
  height: 18px;
  background-color: #9ace6a;
}
.bar-3 {
  height: 18px;
  background-color: #ffcf02;
}
.bar-2 {
  height: 18px;
  background-color: #ff9f02;
}
.bar-1 {
  height: 18px;
  background-color: #ff6f31;
}
.star-rating {
 
  color: #000;
  width: 35rem;

}
.star-rating .fa:hover {
  color:orange;
}
.heading {
  font-size: 25px;
  color: rgb(97, 87, 87);
  border-bottom: 2px solid #eee;
}
.custom-text {
  font-weight: bold;
  font-size: 1.9em;
  border: 1px solid #cfcfcf;
  padding-left: 10px;
  padding-right: 10px;
  border-radius: 5px;
  color: #999;
  background: #fff;
}
@media (max-width: 300px) {
  .left-bar,
  .right-bar,
  .right-review {
    width: 100%;
  }
  
}

 
.card {
  background-color: rgba(152, 149, 233, 0.2);
}
.table{
   font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
#info-user{
  color:teal;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  font-size: large;
}

#rightcards{
  width: 19.5rem;
}


</style>