<template>
  <div class="composer">
     <!--lorsqu'on clique sur entrée le message est envoyé -->
    <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>

</div>

<!--<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">With textarea</span>
  </div>
  
  <textarea aria-label="Message" v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
</div>-->
  
</template>
<script>
export default{
     data(){
            return{
                message: ''
            };
        },

    methods: {
       
        send(e){
            //indique que si l'evenement e n'est pas traité explicitement son action par 
            //défaut ne doit pas etrre prise en compte comme elle le serait normalement 
            e.preventDefault();
            if(this.message==''){
                return ; 
            }
            this.$emit('send',this.message);
            this.message= '';
            //console.log(this.message);
              
        }
    }
}
</script>
<style lang="scss" scoped>
.composer textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
</style>
