<template>
    <div class="container mx-auto relative text-white">
        <Header />
        <router-view></router-view>
        <Footer />
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Header from './components/Header/Header.vue'
import Footer from './components/Footer/Footer.vue'
export default defineComponent({
    components: { Header, Footer }
})
</script>

<style></style>
