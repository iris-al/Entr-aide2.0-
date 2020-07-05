<template>
  
<div class="card col-md-11 ml-4 mx-auto">
<div class="card-header">
        <i class="fas fa-pencil-ruler" style="color:black"></i> Vous pouvez modifier votre profil.
      </div>
<div

    class="view"
    style="background-image: url('../images/profile.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center; -webkit-background-size: cover; "
  >
    <div class="mask rgba-gradient align-items-center">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-10 mx-auto ">
            <div class="card wow fadeInRight" data-wow-delay="0.3s">
              <div class="card-body">
                <div class="text-center">
                  <h3 class="white-text">
                    <i class="fas fa-user white-text" style="color:black; font-size:35px"></i> Votre profil 
                  </h3>
                  <hr class="hr-light" />
                </div>

                <form @submit.prevent="updateProfile">
                  <div class="md-form">
                    <i class="fas fa-pencil-alt prefix white-text active"  style="color:black"></i>
                    <label  class="active">Votre Nom</label>
                    <input type="text" id="form3" class="white-text form-control" v-model="formUpdate.name" />
                  </div>

                  <div class="md-form">
                    <i class="fas fa-pencil-alt prefix white-text active"  style="color:black"></i>
                    <label  class="active">Votre Nom d'utilisateur</label>
                    <input type="text" id="form3" class="white-text form-control" v-model="formUpdate.username" />
                  </div>

                  <div class="md-form">
                    <i class="fas fa-pencil-alt prefix white-text active" style="color:black"></i>
                    <label  class="active" >Vos compétences</label>
                    <textarea id="form3" class="white-text form-control" cols="30" rows="10" v-model="formUpdate.bio" />
                  </div>

                  <div class="md-form">
                    <i class="fas fa-mail-bulk prefix white-text active" style="color: black"></i>
                    <label class="active">Votre e-mail</label>
                    <input type="email" id="form3" class="white-text form-control" v-model="formUpdate.email" />
                  </div>

                  <div class="text-center mt-4">
                    <input type="submit" class="btn btn-primary " value="Enregistrer" />
                    <hr class="hr-light mb-3 mt-4" />
                  </div>

                </form>


                <form @submit.prevent="changeOldPassword">
                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text active"  style="color: black"></i>
                    <label  class="active">Ancien mot de passe</label>
                    <input type="password" id="form3" class="white-text form-control" v-model="passUpdate.oldpassword"  required/>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text active"  style="color:black"></i>
                    <label  class="active">Nouveau mot de passe</label>
                    <input type="password" id="form3" class="white-text form-control" v-model="passUpdate.newpassword" required />
                  </div>

                  <div class="text-center mt-4">
                    <input type="submit" class="btn btn-primary " value="Changer le mot de passe" />
                    <hr class="hr-light mb-3 mt-4" />
                  </div>

                </form>

              
        <div class="form-group row ">
          
            <button class="btn btn-danger mx-auto" type="button" @click="deleteUser=true" >
              Supprimer mon compte
            </button>
           
          </div>
        </div>
      </div>
      <aside v-if="deleteUser" class="mymodal">
      <div class="mymodal-wrapper" style="height: auto;">
        <div>
          <div>
            <div class="modal-header">
              <h5 class="modal-title">Etes-vous sur de vouloir supprimer votre compte ?</h5>
              <button type="button" class="close" @click="deleteUser=false" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">                           
                  <p> Cete action est irréverssible, votre compte sera supprimer de notre base de données et vous serez directement déconnecté</p>                                                  
            </div>
            <div class="modal-footer">
                  <button type="submit" class="btn btn-danger" @click="deleteProfile">Confirmer</button>
                  <button type="submit" class="btn btn-primary" @click="deleteUser=false">Annuler</button>
            </div> 
          </div>
        </div>
      </div>
    </aside>
            </div>
          </div>
        
      </div>
    </div>
  </div>
</div>
</template>

<script>

import swal from 'sweetalert2'
import { updateprofileuser, deleteProfilUser,changePassword } from '../helpers/auth'
import Vue from 'vue';
import VModal from 'vue-js-modal'
Vue.use(VModal)
export default {
  data () {
    return {
      formUpdate: {
        id:this.$store.getters.currentUser.id,
        name:this.$store.getters.currentUser.name,
        username:this.$store.getters.currentUser.username,
        bio:this.$store.getters.currentUser.bio,
        email:this.$store.getters.currentUser.email,
       
      },
      passUpdate:{
        oldpassword:'',
        newpassword:'',
      },
      errors: {},
      submiting: false,
      deleteUser: false
    }
  },
  
  methods: {
    updateProfile () {
      updateprofileuser(this.$data.formUpdate)
      .then(res => {
        this.$store.commit("updateInfoUser", this.$data.formUpdate);
         swal.fire( 'Vos informations ont bien été modifiées!','success')
                    
      })
      
      .catch(error => {
        
        this.submiting = false
        console.log("ERREUR MODIFICATION " + error);
      })
       

    },
    // methode permettant de suprimer le profil
    deleteProfile() {
      this.deleteUser = false;
      console.log(this.$store.getters.currentUser);
      deleteProfilUser(this.$data.formUpdate.id)
      .then(res => {
        this.$store.commit('logout');
        this.$router.push('/login');              
      })
      .catch(error => {
        swal.fire("Une erreur est survenue lors de la suppression.", "error");
      })
  }, 
    changeOldPassword(){

        changePassword(this.$data.passUpdate)
        .then(res => {
           
        swal.fire({
         title: 'Votre mot de passe a bien été modifié!',
         icon: 'success',
      })
        })
         .catch(error => {
            this.submiting = false
        swal.fire({
  title: 'L\'ancien mot de passe est incorrect, veuillez réessayer.',
  icon: 'warning',
  }) .then(() => this.$router.go(0));
       
        
         })
    }
    

  }  
}
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
  background-color: rgba(197, 194, 248, 0.2);
}

.md-form label {
  color:black;
  font-family:Georgia, 'Times New Roman', Times, serif;
  font-size: 20px;
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