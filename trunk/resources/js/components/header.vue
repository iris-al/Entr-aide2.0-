<template>

<div id="content" >
<span class="slide">

        <a href="#"  @click.prevent="openSlideMenu">
            <i class =" ml-4 fa fa-bars " ></i>
        </a>
    </span>
    <div id = "menu" class = "nav " >
        <a href="#" @click.prevent="closesSlideMenu" class="close " style="margin-top:40px;" >
            
            <i class="fa fa-times-circle" style=" font-size:35px; color: red; "></i>
        </a>
        <div class="wrapper">
            <template v-if="!currentUser">
                <div class="sidebar">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                            
                            <td style="font-size:35px;"><i class="fas fa-user"></i></td>
                            <td style="padding-left: 5px; font-size:30px  " ><router-link to="/login" class="nav-link">Login</router-link></td>

                        <tr>
                            <td><i class="fas fa-registered" style="font-size:35px; "></i></td>
                            <td style="padding-left: 5px; font-size:30px  " ><router-link to="/register" class="nav-link">Register</router-link></td>
                        </tr>
                    </table>

                </div>
            </template>
        <template v-else>
          <div class="sidebar">
            <table width="100%"  cellspacing="0" cellpadding="0" border-spacing= "10px" border-collapse="separate">
                 <tr>
                    <td ><i class="fas fa-pen" style="font-size:25px;"></i></td>
                    <td style="padding-left: 5px; font-size:20px  "><router-link to="/ads/addads" class="nav-link">Publier une annonce</router-link></td>
                </tr>
                <tr>
                    <td><i class="fas fa-newspaper" style="font-size:25px;"></i></td>
                    <td style="padding-left: 5px; font-size:20px  "><router-link to="/ads/" class="nav-link">Annonces</router-link></td>
                </tr>
                <tr>
                    <td><i class="fas fa-clipboard-list" style="font-size:25px;"></i></td>
                    <td style="padding-left: 5px; font-size:20px "><router-link to="/ads/myAds" class="nav-link">Mes annonces</router-link></td>
                </tr>
                <tr>
                     <td><i class="fas fa-envelope" style="font-size:25px;"></i></td>
                     <td style="padding-left: 5px; font-size:20px;"><router-link to="../ChatApp" class="nav-link">Messagerie</router-link></td>
                </tr>
                <tr>
                     <td><i class="fas fa-edit" style="font-size:25px;"></i></td>
                     <td style="padding-left: 5px; font-size:20px;"><a href="#!" @click.prevent="updateprofile">Mon profil</a></td>
                </tr>
                <tr>
                      <td><i class="fas fa-sign-out-alt" style="font-size:25px;"></i></td>
                      <td style="padding-left: 5px; font-size:20px;"><a href="#!" @click.prevent="logout" >Se déconnecter</a></td>
                </tr>
            </table>

            
            
           </div>
            </template>
         
         </div>  
    </div>
</div>
</template>

<script>

    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
                this.$router.go(0);
            },
            updateprofile(){
                this.$router.push('/ProfileSet')
            },
            openSlideMenu(){
                document.getElementById('menu').style.visibility='visible';
                document.getElementById('menu').style.width='240px';
                
                document.getElementById('content').style.marginLeft='240px';
            },
            closesSlideMenu(){
                document.getElementById('menu').style.visibility='hidden';
                document.getElementById('menu').style.width='0';
                document.getElementById('content').style.marginLeft='0';
            }

        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        
    }
</script>

<style lang="scss" scoped>


.nav{
    visibility: hidden;
    height: 100%;
    width : 10%;
    position : fixed ; 
    z-index: 1;
    top: 0;
    left: 0;
    background-color:rgba(132, 129, 218, 0.7);
    opacity: .9;
    padding-top: 100px;
    transition: 0.4s;
     margin : 0 ;
  
   box-sizing: border-box;
   text-decoration: none;
   font-family: 'Josefin Sans', sans-serif;
    

}
.nav a {
    display : block;
    padding: 10px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    text-decoration: none;
    color:lavender;
}

.nav a:hover{
    color: rgb(16, 16, 29);
    transition : 0.4s;

}
.nav .close{
    position: absolute;
    top:0;
    right: 60px;
    margin-left: 50px;
    font-size: 40px;
}

.slide a {
    color : #000 ;
    font-size: 30px;
    float : left;
    
   
   
}

@media screen and (max-width:800px) {
	table {
		
        width: 250px;
	}
	tr{
        flex-direction: column;
    }
    
    
	
}

</style>