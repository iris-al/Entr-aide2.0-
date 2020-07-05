<template>
  <div class="conversation">
  <h1>{{contact? contact.name : 'Select a contact'}}</h1>


      <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage" />

  
  
  
  </div>
</template>

<script>
import MessageComposer from './MessageComposer.vue';
import MessagesFeed from './MessagesFeed.vue';
export default {
  components:{ MessageComposer , MessagesFeed},
  props: {
    contact: {
      type: Object,
      default: null
    },
    messages: {
      type:Array,
      default:[]
    }
  },
  methods: {
    sendMessage(text){
      console.log(text);
      //si aucun contact n'est selectionné allors la methode ne fait rien
      //sinon elle fait une requete a la bdd
      if(!this.contact){
        return ;
      }
      axios.post('/api/conversation/send',{
        contact_id: this.contact.id,
        text: text,
        from :this.$store.getters.currentUser.id
      }).then((response)=>{
                    this.$emit('new', response.data);
                    
       })
    }
  }
    
    

}
</script> 
<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>
