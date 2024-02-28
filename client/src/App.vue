<template>
    <div class="relative">
        <div v-if="loading" class="flex items-center justify-center min-h-[100vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <Header :genres="genres" :categories="categories" :countries="countries" />
            <router-view></router-view>
            <Footer />
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Header from './components/Header/Header.vue'
import Footer from './components/Footer/Footer.vue'

import { getAllCategory } from './webServices/categoryService'
import { getAllGenre } from './webServices/genreService'
import { getAllCountry } from './webServices/countryService'

export default defineComponent({
    components: { Header, Footer },
    setup() {
        const loading = ref(false)
        const categories = ref([])
        const genres = ref([])
        const countries = ref([])

        return {
            loading,
            categories,
            genres,
            countries
        }
    },
    methods: {
        async loadData() {
            this.loading = true
            const [categoryData, genreData, countryData] = await Promise.all([getAllCategory(), getAllGenre(), getAllCountry()])

            if (categoryData.success) this.categories = categoryData.categories
            if (genreData.success) this.genres = genreData.genres
            if (countryData.success) this.countries = countryData.countries

            this.loading = false
        }
    },
    mounted() {
        this.loadData()
    }
})
</script>

<style></style>
