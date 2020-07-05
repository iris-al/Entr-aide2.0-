<template>
         <!-- on a besoin de la référence pour l'appeler dans la méthode scrollToBottom-->
 
   
                <div class="feed" ref=  "feed">
                     <ul v-if="contact">
         <!-- affiche chaque message envoyés et recus par l'utilisateur en fonction d'un contact donnée-->
                        <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                            <div class="text"> {{message.text}}</div>
                        </li>
                     </ul>
                </div>
         
    
  
</template>
<script>
export default {
    props: {
        contact: {
            type: Object,
            
        },
        messages: {
            type : Array,
            required: true 
        }
    },
         mounted(){
            console.log(this.user);
            //pour recuperer les messages
            //axios.get(`/api/conversation/${contact.id}`,{
             //   id :this.$store.getters.currentUser.id
            //}).then((response)=>{
                  //  this.messages=response.data;
                  //  this.selectedContact = contact;
                   // console.log(response.data);
                //})
               // .catch((err) => {
                   //  rej("not found");
               // })                
               console.log(contact.id);

                axios.get('/api/conversation',{
                    
                id :this.$store.getters.currentUser.id,
                contact_id : contact.id
            })
                .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                        console.log(response.data);
                    })
            
        },
        methods: {
            //cette methode permet à ce quon on arrive sur le dialogue 
            // deux user on a besoin de scroller pour voir les derniers messages
            scrollToBottom(){
                setTimeout(() => {
                    
                    this.$refs.feed.scrollTop = this.$refs.scrollHeight-this.$refs.feed.clientHeight;

                },50);

            }
        },

        watch: {
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();
            }
        }
    
}
</script>

<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    height:400px;
    max-height: 470px;
    overflow: scroll;
    box-sizing: border-box;
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 10px 0;
                width: 100%;
                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
                &.received {
                    text-align: right;
                    .text {
                        background: #b2b2b2;
                    }
                }
                &.sent {
                    text-align: left;
                    .text {
                        background: #81c4f9;
                    }
                }
            }
        }
    }
}
</style>


