<template>
  <div class="contacts-list">
      
      <ul>
      <li v-for="(contact ,index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'selected': index==selected}">
            
            <div class="contact">
                <p class="name">{{contact.name}}</p>
                <p class="email">{{contact.email}}</p>
                 
            </div>
      </li>
      </ul>
  </div>
</template>

<script>
export default {
    data(){
        return {
            contacts: [],
            selected : 0
        }
    },
    //props: {
      //  contacts: {
           // type : Array,
           // default: []
       // }
    //},
   
    
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
            selectContact(index,contact){
                this.selected=index;
                this.$emit('selected',contact);

            }
        }

    

}
</script> 

<style lang="scss" scoped>
.contacts-list {
    flex: 2;
    max-height: 100%;
    height: 450px;
    overflow: scroll;
    border-left: 1px solid #a6a6a6;
    
    
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #aaaaaa;
           // height: 80px;
            position: relative;
            cursor: pointer;
            &.selected {
                background: #dfdfdf;
            }
            .contact {
                flex: 3;
                //font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                p {
                    margin: 0;
                    &.name {
                        font-weight: bold;
                    }
                }
            }
        }
    }
}
</style>
