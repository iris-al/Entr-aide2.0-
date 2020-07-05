<template>
    <div class="col-md-12" >
        <div class="card card-default"  style="background-color:#F0F8FF; background-repeat: no-repeat; background-size: cover; background-position: center center; -webkit-background-size: cover; " >
            <div class="card-header">Annonces</div>

            <div class="card-body">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'annonces-main'
    }
</script>