<template>

  <div class="card col-md-9 ml-4 mx-auto"  style="background-color: rgba(126, 123, 215, 0.1); ">
<div class="card-body">
      <p class="error">{{regError}}</p>
      <div class="text-center">
      <h3 class="white-text">
      <i class="fas fa-newspaper" style="font-size:30px; color: #008B8B;" ></i> &nbsp; <i style=" font-family:Georgia, serif "> Publiez une nouvelle annonce !</i>
      </h3>
      </div>
      </div>
        <div class="card-body">
          <form @submit.prevent="add">
            <div class="form-group row">
              <label id="titre" for="title">Titre de l'annonce</label>
              <input
                type="text"
                class="form-control"
                id="title_annonce"
                aria-describedby="title"
                v-model="formAnnonce.title"
                name="title"
                placeholder="Le titre de votre annonce"
                required
              />
            </div>
            <div class="form-group row">
              <label id="titre" for="description">Description de l'annonce</label>
              <textarea
                name="description"
                id="description"
                class="form-control"
                v-model="formAnnonce.description"
                cols="30"
                rows="10"
                placeholder="Une brève description"
                required
              ></textarea>
            </div>
            <div class="form-group row">
              <label id="titre" for="localisation">Localisation</label>
              <input
                name="localisation"
                class="form-control"
                v-model="formAnnonce.localisation"
                id="localisation"
                placeholder="Où vous situez-vous?"
                required
              />
            </div>
            <div class="form-group row">
              <select
                class="form-control"
                v-model="formAnnonce.categorie"
                id="categorie"
                name="categorie"
                required
              >
                <option disabled>Choisissez la catégorie</option>
                <option value="Bricolage">Bricolage</option>
                <option value="Babysitting/cours">Babysitting et cours de soutien</option>
                <option value="Dons/prêts">Dons ou prêts d'objet</option>
                <option value="Transport/déménagement">Transport et déménagement</option>
                <option value="Animaux">Animaux</option>
                <option value="Autre">Autre</option>
              </select>
            </div>
            <div class="form-group row">
              <input
                name="image"
                id="upload-file"
                type="file"
                multiple
                class="form-control"
                @change="imageChanged"
              />
            </div>
            <div class="form-group row">
              <button type="submit" class="btn btn-primary">Soumettre mon annonce</button>
            </div>
          </form>
        </div>
      </div>
    
</template>
<script>
import swal from "sweetalert2";
import { addAnnonce } from "../../Helpers/ad.js";
export default {
  name: "add-annonce",
  data() {
    return {
      formAnnonce: {
        title: "",
        description: "",
        localisation: "",
        categorie: "",
        user_id: this.$store.getters.currentUser.id,
        filename: "vide"
      },
      attachments: [],
      form: new FormData(),

      error: null
    };
  },
  methods: {
    postAnnonce(){
        addAnnonce(this.$data.formAnnonce)
          .then(res => {
            swal.fire("Votre annonce a été posté.", "success");
            this.$router.push({ path: "/ads/" });
          })
          .catch(error => {
            console.log("ERREUR ANNONCE " + error);
          });
    },

    add() {
        // si il y a une image
        if(this.attachments.length != 0){

      for (let i = 0; i < this.attachments.length; i++) {
        this.form.append("pics[]", this.attachments[i]);
      }
      const config = { headers: { "Content-Type": "multipart/form-data" } };
      document.getElementById("upload-file").value = [];
      // je poste l'image à stocker d'abord
      axios.post("/api/ads/image", this.form, config).then(response => {
        //success
        // je récupère le nom de l'image sotcké dans le serveur pour l'envoyé dans la BDD
        this.$data.formAnnonce.filename = response.data.filename;
        
        /* mnt j'envoie l'annonce avec le nom de l'image */
        this.postAnnonce();
      });

    //sinn
    }else{
        /* j'envoie l'annonce  */
        this.postAnnonce();
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
  },
  computed: {
    regError() {
      return this.$store.getters.regError;
    }
  },
};
</script>
<style>
#titre{
  font-family: Georgia, 'Times New Roman', Times, serif;
  font-size: large;
}


</style>