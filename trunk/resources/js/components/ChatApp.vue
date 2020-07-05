<template>
  
<div class="chat-app" >
    <div class="content">
        <table width = "100%">
            <tr>
                <td><Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/></td>
                <td><contactsList  @selected= "startConversationWith"></contactsList></td>
            </tr>
        </table>
        
        
                
       
          
        
       
        
        
            
        
    </div>
</div>

        
</template>
  <script>
  import "bootstrap/dist/css/bootstrap.min.css";

  import Conversation from './Conversation.vue';
  import ContactsList from './ContactsList.vue';
        
    export default{
        components: {Conversation,ContactsList},
        props: {
                user:{
                    type: Object,
                    
                }
            },
        data(){

            
            return{
                selectedContact: null,
                messages:[],
                contacts:[]
            };
        },
        mounted(){
            console.log(this.user);
            //pour recuperer les contacts
            axios.get(`/api/contacts/${this.$store.getters.currentUser.id}`)
            .then((response)=>{
                    this.contacts=response.data;
                    console.log(response.data);
                })
                .catch((err) => {
                     rej("not found");
                })
        },
        methods: {
            startConversationWith(contact){
                console.log(contact.id);
                axios.get(`/api/conversation/${this.$store.getters.currentUser.id}${contact.id}`)
                .then((response) => {
                        this.messages=response.data;
                        this.selectedContact = contact;
                        console.log(this.messages);
                        
                       console.log(response.data);
                    })
                     .catch((err) => {
                     rej("not found");
                })
            },
            saveNewMessage(text){
                  //var key = "prop_11"; 
           // myObj.prop_1[key] = "value_11"; 
            //el_down.innerHTML = JSON.stringify(myObj); 
                this.messages.push(text);
                
                
            }
        }
        


    }
</script>

<style lang="scss" scoped>
@media screen and (max-width:800px) {
	table {
		display:flex;
        width: 100%;
	}
	
	td {
		flex:1;
	}
	tr {
		display:flex;
		flex-direction:column;
	}
}
</style>
