<template>
<div class="card" :class="gridClass" :style="gridStyle">
</div>
</template>


<script>
export default {
 props: [
   'item', 'index'
 ],
 computed: {
   gridStyle() {
     return{
       '--i': this.index,
       'background-image': 'url('+ require('../images'+this.item.img) +')'
       };
   },
   gridClass(){
    return{
      'card-1-1': this.item.grid === 'card-1-1',
      'card-2-1': this.item.grid === 'card-2-1'
    };
   }
 }
}
</script>

<style lang="scss" scoped>
.card{
  width:80%;
  height: 100px;
  background-position: center;
  background-size: cover;
  }
.card-1-1{
    grid-column: span 1;
  }
.card-2-1{
    grid-column: span 2;
  }

</style>