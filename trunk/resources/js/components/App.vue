<template>
    <div id="main">
        <HeaderTop></HeaderTop>
        <Header></Header>
        <div class="content"> <!--.content-->
            <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from './header.vue';
import HeaderTop from './HeaderTop.vue';
import Footer from './footer.vue';
export default {
  name: 'App',
  components: {Header,Footer,HeaderTop}
};
</script>
<style lang="sass">
    .content 
        margin-top : 20px
        height: 100%
    body
        position: relative
        min-height: 100vh
        padding-bottom: 55px
    html, #app
         height: 100%    
</style>