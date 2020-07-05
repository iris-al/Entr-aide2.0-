<template>
  <div
    class="view"
    style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/59.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center; -webkit-background-size: cover; "
  >
    <div class="mask rgba-gradient align-items-center">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-6 mb-5 mt-md-5 mt-5 white-text text-center text-md-left">
            <h1
              class="h1-responsive font-weight-bold wow fadeInLeft"
              data-wow-delay="0.3s"
            >Inscrivez-vous!</h1>
            <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s" />
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">
              Inscrivez-vous sur notre site en remplissant le formulaire suivant. Vous pourrez ainsi vous créer un compte et accéder à tous les services que nous offrons.
              Nous vous souhaitons une bonne visite!
            </h6>

            <router-link
              to="/login"
              class="btn btn-outline-white wow fadeInLeft"
              id="lien"
              data-wow-delay="0.3s"
            >
              Si vous êtes déjà inscrit,
              <u>Cliquez sur ce lien pour vous connecter!</u>
            </router-link>
          </div>

          <div class="col-md-6 col-xl-6 mb-5 mt-md-5">
            <div class="card wow fadeInRight" data-wow-delay="0.3s">
              <div class="card-body">
                <div class="text-center">
                  <h3 class="white-text">
                    <i class="fas fa-user white-text"></i> Inscrivez-vous!
                  </h3>
                  <hr class="hr-light" />
                </div>
                <form @submit.prevent="register">
                  <div class="form-group row" v-if="regError">
                    <p class="error">{{regError}}</p>
                  </div>
                  <div class="md-form">
                    <i class="fas fa-user prefix white-text active"></i>
                    <label for="name" class="active">Adresse</label>
                    <!-- AUTOCOMPLETE ----------------->
                    <input
                      type="text"
                      id="autocomplete"
                      class="white-text form-control"
                      ref="input"
                      v-model="query"
                      @keyup="searchItem"
                      placeholder="Adresse..."
                    />

                    <div class="options" v-if="!choosen && query!=''">
                      <ul>
                        <li
                          v-for="possiblite in possiblites"
                          @click="itemClicked(possiblite)"
                          v-model="possiblites"
                          v-text="possiblite.properties.label"
                        ></li>
                      </ul>
                    </div>

                    <!-- ------------------------ ----------------->
                  </div>
                  <div class="md-form">
                    <i class="fas fa-user prefix white-text active"></i>
                    <label for="name" class="active">Nom</label>
                    <input
                      type="text"
                      id="nom"
                      class="white-text form-control"
                      v-model="formRegister.name"
                      placeholder="Nom"
                    />
                  </div>
                  <div class="md-form">
                    <i class="fas fa-user prefix white-text active"></i>
                    <label for="username" class="active">Nom d'utilisateur</label>
                    <input
                      type="text"
                      id="username"
                      class="white-text form-control"
                      v-model="formRegister.username"
                      placeholder="Nom d'utilisateur"
                    />
                  </div>
                  <div class="md-form">
                    <i class="fas fa-user prefix white-text active"></i>
                    <label for="bio" class="active">Décrivez vos compétences</label>
                    <textarea
                      name="bio"
                      id="competence"
                      class="white-text form-control"
                      v-model="formRegister.bio"
                      cols="30"
                      rows="10"
                      placeholder="Entrez vos compétences"
                    ></textarea>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-user prefix white-text active"></i>
                    <label for="email" class="active">Votre adresse E-mail</label>
                    <input
                      type="email"
                      id="form3"
                      class="white-text form-control"
                      v-model="formRegister.email"
                      placeholder="Adresse e-mail"
                    />
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text active"></i>
                    <label for="password">Votre mot de passe</label>
                    <input
                      type="password"
                      id="form4"
                      class="white-text form-control"
                      v-model="formRegister.password"
                      placeholder="Mot de passe"
                    />
                  </div>
                  <div class="text-center mt-4">
                    <input type="submit" class="btn btn-light ml-auto" value="M'inscrire" />
                    <hr class="hr-light mb-3 mt-4" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { registerUser } from "../../helpers/auth";

export default {
  data() {
    return {
      formRegister: {
        name: "",
        username: "",
        bio: "",
        email: "",
        password: "",
        // adresse
        adresse: "",
        latitude: "",
        longitude: ""
      },
      error: null,
      // ADRESSE
      query: "",
      possiblites: [],
      choosen: false
    };
  },

  methods: {
    register() {
      if (this.choosen) {
        // si j'arrive à avoir une adresse
        registerUser(this.$data.formRegister)
          .then(res => {
            // en cas de succès, on redirige vers la page de login
            this.$router.push({ path: "/login" });
          })
          .catch(error => {
            // sinon on affiche l'erreur
            this.$store.commit("registerFailed", { error });
          });
      }
    },

    searchItem() {
      this.choosen = false;
      // si le champ d'adresse n'est pas vide
      if (this.$data.query != "") {
        axios
          .get(`https://api-adresse.data.gouv.fr/search/?q=${this.$data.query}`)
          .then(response => {
            var i = 0;
            var tab = [];
            // j'insère les données reçus dans tab
            for (i = 0; i < response.data.features.length; i++) {
              tab.push(response.data.features[i]);
            }
            // la liste de possibilités aura donc la liste d'adresse reçue
            this.possiblites = tab;
          })
          .catch(err => {
            console.log("error " + err);
          });
      }
    },
    itemClicked(possiblite) {
      // l'utlisateur a fait son choix d'adresse
      this.choosen = true;
      // l'input est écirt par le nom complet de l'adresse
      this.query = possiblite.properties.label;
      // on récupère les infos (lat, long, nom de l'adresse) afin de les stockés dans la BDD
      this.formRegister.longitude = possiblite.geometry.coordinates[0];
      this.formRegister.latitude = possiblite.geometry.coordinates[1];
      this.formRegister.adresse = possiblite.properties.label;
    }
  },
  computed: {
    regError() {
      return this.$store.getters.regError;
    }
  }
};
</script>

<style scoped>
.error {
  font-family: Georgia, "Times New Roman", Times, serif;
  text-align: center;
  color: lavenderblush;
  font-size: large;
}
.view {
  height: 100%;
}

.card {
  background-color: rgba(126, 123, 215, 0.2);
}

.md-form label {
  color: #ffffff;
}

h6 {
  line-height: 1.7;
  font-family: Georgia, "Times New Roman", Times, serif;
  font-size: large;
}
#lien {
  font-size: large;
  font-family: Georgia, "Times New Roman", Times, serif;
}
.options {
  max-height: 150px;
  overflow-y: scroll;
  margin-top: 5px;
  z-index: 10;
  top: 150px;
  position: absolute;
  width: 92%;
}
.options ul {
  list-style-type: none;
  text-align: left;
  padding-left: 0;
}
.options ul li {
  border-bottom: 1px solid lightgray;
  padding: 10px;
  cursor: pointer;
  background: #f1f1f1;
}
.options ul li:first-child {
  border-top: 2px solid #d6d6d6;
}
</style>