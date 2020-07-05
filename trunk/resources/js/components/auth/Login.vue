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
            >Connectez-vous!</h1>
            <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s" />
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">
              Si vous n'avez pas encore de compte sur Entr'aide 2.0, vous pouvez vous inscrire en cliquant sur le lien ci-dessous. Si vous êtes déjà membre de notre communauté, découvrez maintenant tous nos services en vous connectant.
              Nous vous souhaitons une bonne visite!
            </h6>
            <router-link
              to="/register"
              class="btn btn-outline-white wow fadeInLeft"
              id="lien"
              data-wow-delay="0.3s"
            >
              S'inscrire
              Toujours pas inscrit(e)?
              <u>Cliquez sur ce lien pour y remédier!</u>
            </router-link>
          </div>

          <div class="col-md-6 col-xl-6 mb-5 mt-md-5">
            <div class="card wow fadeInRight" data-wow-delay="0.3s">
              <div class="card-body">
                <div class="text-center">
                  <h3 class="white-text">
                    <i class="fas fa-user white-text"></i> Connectez-vous!
                  </h3>
                  <hr class="hr-light" />
                </div>

                <form @submit.prevent="authenticate">
                  <div class="md-form">
                    <i class="fas fa-user prefix white-text active"></i>
                    <label for="email" class="active">Votre E-mail</label>
                    <input
                      type="email"
                      id="form3"
                      class="white-text form-control"
                      v-model="form.email"
                      placeholder="Adresse e-mail"
                      required
                    />
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text active"></i>
                    <label for="password">Votre mot de passe</label>
                    <input
                      type="password"
                      id="form4"
                      class="white-text form-control"
                      v-model="form.password"
                      placeholder="Password"
                      required
                    />
                  </div>
                  <div class="text-center mt-4">
                    <input type="submit" class="btn btn-light ml-auto" value="Me connecter" />
                    <hr class="hr-light mb-3 mt-4" />
                  </div>
                  <div class="form-group row" v-if="authError">
                    <p class="error">{{ authError }}</p>
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
import { login } from "../../helpers/auth"; /*login se trouve dans components/js...*/
export default {
  name: "login",
  data() {
    return {
      form: {
        email: "",
        password: ""
      },
      error: null
    };
  },
  /*méthode d'authentification*/
  /*faire la dif entre dispatch et commit*/
  methods: {
    authenticate() {
      this.$store.dispatch("login");
      login(this.$data.form)
        .then(res => {
          this.$store.commit("loginSuccess", res);
          this.$router.push({
            path: "/"
          }); /*et la on va utiliser notre rooter */
        })
        .catch(error => {
          this.$store.commit("loginFailed", { error });
        });
    }
  },
  computed: {
    authError() {
      return this.$store.getters.authError;
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
</style>
