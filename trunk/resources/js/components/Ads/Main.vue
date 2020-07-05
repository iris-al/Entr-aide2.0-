<template>
    <div class="card col-md-10 ml-4 mx-auto"  style="background-color:rgb(255, 255, 255); background-repeat: no-repeat; background-size: cover; background-position: center center; -webkit-background-size: cover;" >
       
            <div class="card-header" style=" font-family:Georgia, serif; font-size:20px ">Annonces</div>

            <div class="card-body">
                <router-view></router-view>
            </div>
        </div>
   
</template>

<script>
    export default {
        name: 'annonces-main'
    }
</script>