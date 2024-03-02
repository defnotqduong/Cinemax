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

import { getAllCategory } from './webServices/categoryService'
import { getAllGenre } from './webServices/genreService'
import { getAllCountry } from './webServices/countryService'
import { getMovieByCategory, getAllMovie } from './webServices/movieService'

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
            const [categoryData, genreData, countryData] = await Promise.all([getAllCategory(), getAllGenre(), getAllCountry()])

            if (categoryData && categoryData.success) this.homeStore.categories = categoryData.categories
            if (genreData && genreData.success) this.homeStore.genres = genreData.genres
            if (countryData && countryData.success) this.homeStore.countries = countryData.countries

            const [seriesMovies, singleMovies, cartoonMovies, suggetMovies, newMovies] = await Promise.all([
                getMovieByCategory({ category_id: this.findCategoryIdBySlug('phim-bo'), page: 1, limit: 12 }),
                getMovieByCategory({ category_id: this.findCategoryIdBySlug('phim-le'), page: 1, limit: 12 }),
                getMovieByCategory({ category_id: this.findCategoryIdBySlug('phim-hoat-hinh'), page: 1, limit: 12 }),
                getMovieByCategory({ category_id: this.findCategoryIdBySlug('phim-bo'), page: 1, limit: 5 }),
                getAllMovie({ page: 1, limit: 10 })
            ])

            if (seriesMovies && seriesMovies.success) this.homeStore.seriesMovies = seriesMovies.movies.data
            if (singleMovies && singleMovies.success) this.homeStore.singleMovies = singleMovies.movies.data
            if (cartoonMovies && cartoonMovies.success) this.homeStore.cartoonMovies = cartoonMovies.movies.data
            if (suggetMovies && suggetMovies.success) this.homeStore.suggetMovies = suggetMovies.movies.data
            if (newMovies && newMovies.success) this.homeStore.newMovies = newMovies.movies.data

            this.loading = false
        },
        findCategoryIdBySlug(slug) {
            let categoryId = null

            this.homeStore.categories.forEach(category => {
                if (category.slug === slug) {
                    categoryId = category.id
                }
            })

            return categoryId
        }
    },
    mounted() {
        this.loadData()
    }
})
</script>

<style></style>
