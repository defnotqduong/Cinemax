<template>
    <div>
        <div v-if="loading" class="mt-[160px] flex items-center justify-center min-h-[80vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <div v-if="error">
                <Error />
            </div>
            <div v-if="!error">
                <div class="relative container h-[380px] mx-auto px-2 mb-16">
                    <div
                        class="bg-cover bg-center bg-no-repeat absolute top-0 left-0 w-full h-full z-[-1] after:absolute after:content after:top-0 after:left-0 after:w-full after:h-full after:bg-overlay before:absolute before:content before:bottom-0 before:left-0 before:w-full before:h-full before:bg-blur"
                        :style="{ backgroundImage: `url('${movie.poster_url}')` }"
                    ></div>
                </div>
                <div class="relative max-w-[1220px] mx-auto mb-10 mt-[-280px] z-10">
                    <MovieDetails :movie="movie" />
                    <div class="grid grid-cols-3 gap-10 mt-16">
                        <div class="col-span-3">
                            <div class="mb-[30px]">
                                <h4
                                    class="text-2xl font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                                >
                                    Có thể bạn muốn xem...
                                </h4>
                            </div>
                            <div class="grid grid-cols-5 items-start justify-start gap-8">
                                <div v-for="movie in homeStore.suggetMovies" :key="movie.id">
                                    <MovieCard :movie="movie" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, toRefs, reactive } from 'vue'
import MovieDetails from '../../components/Movie/MovieDetails.vue'
import MovieList from '../../components/Movie/MovieList.vue'
import MovieListV2 from '../../components/Movie/MovieListV2.vue'
import MovieListV3 from '../../components/Movie/MovieListV3.vue'
import MovieCard from '../../components/Movie/MovieCard.vue'
import Review from '../../components/Review/Review.vue'
import Error from '../../components/Error/Error.vue'

import { getMovie } from '../../webServices/movieService'
import { useHomeStore } from '../../stores/modules/homeStore'

export default defineComponent({
    components: { MovieDetails, Review, MovieList, MovieListV2, MovieListV3, MovieCard, Error },
    setup() {
        const homeStore = useHomeStore()

        const loading = ref(false)

        const movie = ref(null)

        const error = ref(false)

        return { loading, movie, error, homeStore }
    },
    watch: {
        '$route.params.slug'() {
            this.getData()
        }
    },
    methods: {
        async getData() {
            const slug = this.$route.params.slug

            this.loading = true

            const data = await getMovie(slug)

            console.log(data)

            if (data && data.success) this.movie = data.movie

            this.loading = false
        }
    },
    created() {
        window.scrollTo({ top: 0 })
        this.getData()
    }
})
</script>

<style></style>
