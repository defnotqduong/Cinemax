<template>
    <div class="relative">
        <div v-if="loading" class="flex items-center justify-center min-h-[100vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <Header />
            <router-view></router-view>
            <Footer />
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Header from './components/Header/Header.vue'
import Footer from './components/Footer/Footer.vue'

import { useHomeStore } from './stores/modules/homeStore'

import { getMenu } from './webServices/menuService'
import { getMovieForHeroSlide, getMovieByCatalog } from './webServices/movieService'

export default defineComponent({
    components: { Header, Footer },
    setup() {
        const homeStore = useHomeStore()

        const loading = ref(false)

        return {
            loading,
            homeStore
        }
    },
    methods: {
        async loadData() {
            this.loading = true
            const [menuData, heroSlideData, movieByCatalogData] = await Promise.all([getMenu(), getMovieForHeroSlide(), getMovieByCatalog()])

            if (menuData && menuData.success) this.homeStore.menu = menuData.menu
            if (heroSlideData && heroSlideData.success) this.homeStore.heroSlide = heroSlideData.movies
            if (movieByCatalogData && movieByCatalogData.success) this.homeStore.movieByCatalog = movieByCatalogData.result

            this.loading = false
        }
    },
    mounted() {
        this.loadData()
    }
})
</script>

<style></style>
