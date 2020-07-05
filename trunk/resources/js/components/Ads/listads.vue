<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <label for="title">Les posts récents</label>
            <div>
              <input v-model="checked_filtre" type="checkbox" @click="filtreLocalite" />
              <label
                for="checkbox"
              >Afficher les annonces autours de moi seulement (dans un rayon de 10km)</label>
            </div>
          </div>
          <div class="card-body">
            <form @submit.prevent="searchads">
              <div class="form-group">
                <input type="text" class="form-control" id="words" v-model="formSearch.words" />
                <button type="submit" class="btn btn-primary">Rechercher</button>
              </div>
            </form>
            <form>
              <div id="results">
                <div v-for="ad in ads" v-bind:key="ad.id" class="card mb-3" style="width: 100%">
                  <div class="card-body">
                    <router-link :to="{path: '../ads/' + ad.id}">
                    <h4 class="card-title" style="color:gray" >
                    
                      Titre :
                      <b>{{ ad.title }}</b>
                      
                    </h4>
                    </router-link>  
                    <p style="color:gray">
                      <b>localisation :</b>
                      {{ ad.localisation }}
                    </p>
                    <p style="color:gray">
                      <b>description :</b>
                      {{ ad.description }}
                    </p>
                    <p style="color:gray">
                      <b>categorie :</b>
                      {{ ad.categorie }}
                    </p>
                    
                    <div class="mx-auto">
                    <button
                    
                      type="button"
                      class="btn btn-primary btn-sm btn-block "
                      data-toggle="modal"
                      data-target="#exampleModalCenter"
                      @click="submitcomment(ad)"
                    >Commenter</button>
                    
                    <span
                      
                      class="btn btn-primary btn-sm btn-block"
                      @click="countlike(ad)"
                      
                    >&#128522; Remercier</span>
                   
                    <span  id="count">&#128522;{{ ad.count }}</span>
                    </div>
                    <p id="createdat" class="align-self-end" style="color:gray;">
                      <span>{{ format_date(ad.created_at) }}</span>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 card-footer pb-0 pt-3">
        <nav>
          <ul class="pagination justify-content-center">
            <li
              v-for="n in pagination.last_page"
              v-bind:key="n"
              v_bind:class="{active: !pagination.current_page == n}"
              class="page-item"
            >
              <a href="#" @click="viewAds(n)" class="page_link">{{n}}</a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Modal -->
      <div
        class="modal fade "
        id="exampleModalCenter"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
        
      >
        <div class="modal-dialog modal-dialog-centered " role="document" >
          <div class="modal-content"  style="background-color:rgba(255, 255, 255, 0.600)"  >
            <div class="modal-header">
              <h5 class="modal-title mx-auto" id="exampleModalCenterTitle" style="font-family:Arial, Helvetica, sans-serif;; margin-left:60px; font-size:30px;">Commentez cette annonce</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                <form action @submit.prevent="createComment(post)">
                  <div class="form-group row mx-auto" >
                    <label for="title" style="font-size:25px" ><i class="fas fa-hand-point-right" style="font-size:25px"></i> &nbsp; Titre de l'annonce : {{formAd.title}}</label>
                  </div>
                  <div class="form-group">
                    <textarea v-model="comment.body" placeholder="Commentaire" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <button  class="btn  btn-primary" 
                    type="submit"
                      @click.prevent="createComment(comment)"
                    >Envoyer</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import moment from "moment";
import { addAnnonce } from "../../Helpers/ad.js";
import swal from "sweetalert2";
import { RechAnnonce, affAnnonce } from "../../Helpers/ad.js";
import { putlike } from "../../Helpers/ad.js";
import Vue from "vue";
import VModal from "vue-js-modal";
Vue.use(VModal);
export default {
  name: "aff-annonce",
  data() {
    return {
      comments: [],
      comment: {
        user_id: this.$store.getters.currentUser.id,
        body: "",
        ad_id: "",
        username: this.$store.getters.currentUser.username
      },
      formAd: {
        id: "",
        title: ""
      },
      ad: {
        id: "",
        title: "",
        description: "",
        localisation: "",
        categorie: ""
      },
      ad_id: "",
      current_page: 0,
      pagination: {},
      page: 1,
      formSearch: {
        words: ""
      },
      form: {
        id: "",
        count: "",
        title: "",
        description: "",
        localisation: "",
        categorie: ""
      },
      edit: false,
      checked_filtre: false,
      ads: [],
      ads_filtre: [],
      id: 0
    };
  },
  mounted() {
    if (this.page != 1) {
      this.viewAds(this.page);
    } else {
      this.$store.dispatch("getAds");
    }
  },
  created() {
    this.viewAds();
  },
  methods: {
    createComment(comment) {
      this.comment.ad_id = this.formAd.id;
      if (this.comment.body!=""){
      this.$store.dispatch("createComment", comment)
      .then(res=>{
         
        swal.fire({
  title: 'Merci pour votre commentaire !',
  icon: 'success',
})
        .then(() => this.$router.go(0));
      })
       .catch(error => {
            console.log("ERREUR COMMENTAIRE " + error);
          });
      }
     if (this.comment.body==""){
        swal.fire({
  title: 'Veuillez rédiger un commentaire.',
  icon: 'warning',
})

      }
    },
    submitcomment(annonce) {
      this.comment.ad_id = this.formAd.id;
      this.formAd = annonce;
      this.edit = true;
    },
    countlike(annonce) {
      annonce.count++;
      this.form = annonce;
      putlike(this.$data.form, annonce);
    },
    viewAds(n) {
      this.page = n;
      axios.get("/api/ads/annonces?page=" + this.page).then(
        response => (
          (this.pagination = {
            current_page: response.data.ads.current_page,
            last_page: response.data.ads.last_page,
            from_page: response.data.ads.from,
            to_page: response.data.ads.to,
            total_page: response.data.ads.total,
            path_page: response.data.ads.path + "?page="
          }),
          (this.ads = response.data.ads.data)
        )
      );
    },
    searchads() {
      RechAnnonce(this.$data.formSearch)
        .then(
          res => (
            (this.ads = res.data.ads.data),
            (this.pagination = {
              current_page: res.data.ads.current_page,
              last_page: res.data.ads.last_page,
              from_page: res.data.ads.from,
              to_page: res.data.ads.to,
              total_page: res.data.ads.total,
              path_page: res.data.ads.path + "?page="
            })
          )
        )
        .catch(error => {
          console.log("ERREUR ANNONCE " + error);
        });
    },

    // fct qui donne la distance en KM entre deux points
    getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
      var R = 6371; // Radius of the earth in km
      var dLat = this.deg2rad(lat2 - lat1); // deg2rad below
      var dLon = this.deg2rad(lon2 - lon1);
      var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(this.deg2rad(lat1)) *
          Math.cos(this.deg2rad(lat2)) *
          Math.sin(dLon / 2) *
          Math.sin(dLon / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c; // Distance in km
      return d;
    },
    deg2rad(deg) {
      return deg * (Math.PI / 180);
    },
    // fct qui permet de filtrer les annonces sur un rayon de 10km ou de les defiltrer
    filtreLocalite() {
      // si la checkbox est coché, alors je filtre dans une rayon de 10km
      if (!this.checked_filtre) {
      // récuperer les coordonnées de l'utilisateur courant
        var lat_user = this.$store.getters.currentUser.latitude;
        var lon_user = this.$store.getters.currentUser.longitude;
        // je boucle sur les annonces
        var i = this.ads.length;
        while (i--) {
          var lat = this.ads[i].latitude;
          var lon = this.ads[i].longitude;
          // si la distance entre l'utilisateur et l'annonce > 10 km
          if ( this.getDistanceFromLatLonInKm(lat_user, lon_user, lat, lon) > 10) {
            this.ads_filtre.push(this.ads[i]);
            this.ads.splice(i, 1);
          }
        }
      } else {
        //sinon je remets toutes les annonces
        var i = this.ads_filtre.length;
        while (i--) {
          this.ads.push(this.ads_filtre[i]);
          this.ads_filtre.splice(i, 1); //pour vider ads_filtre
        }
      }
    },

    format_date(value) {
      if (value) {
        return moment(String(value)).fromNow();
      }
    }
  },
  computed: {
    regError() {
      return this.$store.getters.regError;
    },
    isValid() {
      return (
        this.comment.body !== "" &&
        this.comment.user_id !== "" &&
        this.comment.ad_id !== this.formAd.id
      );
    }
  }
};
</script>
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
  background-color: #4caf50;
  color: white;
  border: 1px solid #4caf50;
}
.pagination li:hover:not(.active) {
  background-color: #ddd;
}
.pagination li:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
.pagination li:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
.comments {
  margin-top: 20px;
  padding: 20px;
  padding-top: 0;
}
.comments-wrapper {
  max-height: 250px;
  overflow-y: auto;
  padding-right: 10px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  border-radius: 10px;
  background-color: #fff;
}
.custom-scrollbar::-webkit-scrollbar {
  width: 8px;
  background-color: #fff;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  background-color: #555;
}

.card-body{
  display: flex;
  flex-direction: column;
}

@media (min-width: 576px) {
    #count{
        font-size: 1.2rem;
    }
 }

#exampleModalCenter{
  background-color: rgba(242, 247, 248, 0.658);
  color: rgb(27, 22, 15);
  font-family: Arial, Helvetica, sans-serif;

}
</style>