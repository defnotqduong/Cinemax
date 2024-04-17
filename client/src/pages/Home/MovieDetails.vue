<template>
    <div>
        <div v-if="loading" class="mt-[160px] flex items-center justify-center min-h-[80vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <div class="relative container h-[380px] mx-auto px-2 mb-16">
                <div
                    class="bg-cover bg-center bg-no-repeat absolute top-0 left-0 w-full h-full z-[-1] after:absolute after:content after:top-0 after:left-0 after:w-full after:h-full after:bg-overlay before:absolute before:content before:bottom-0 before:left-0 before:w-full before:h-full before:bg-blur"
                    :style="{ backgroundImage: `url('${movie.poster_url}')` }"
                ></div>
            </div>
            <div class="relative max-w-[1220px] mx-auto mb-10 mt-[-280px] z-10">
                <MovieDetails :movie="movie" />
                <div class="grid grid-cols-7 gap-16 mt-20 mb-24 ml-12">
                    <div class="col-span-5">
                        <div class="mb-[30px]">
                            <h4
                                class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                            >
                                Trailer
                            </h4>
                        </div>
                        <iframe :src="movie.trailer_url" frameborder="0" allowfullscreen class="w-full h-[420px] mx-auto rounded-md"></iframe>
                    </div>
                    <div class="col-span-2">
                        <div class="mb-[30px]">
                            <h4
                                class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                            >
                                Phim mới cập nhật
                            </h4>
                        </div>
                        <div class="max-h-[500px] overflow-y-auto custom-scrollbar">
                            <MovieListV2 :movies="homeStore.heroSlide" />
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

import { getMovie } from '../../webServices/movieService'
import { useHomeStore } from '../../stores/modules/homeStore'

export default defineComponent({
    components: { MovieDetails, Review, MovieList, MovieListV2, MovieListV3, MovieCard, Error },
    setup() {
        const homeStore = useHomeStore()

        const loading = ref(false)

        const movie = ref(null)

        return { loading, movie, homeStore }
    },
    watch: {
        '$route.params.slug'() {
            this.getData()
        }
    },
    methods: {
        async getData() {
            const slug = this.$route.params.slug

            window.scrollTo({ top: 0 })

            this.loading = true

            const data = await getMovie(slug)

            if (data && data.status === 404) this.$router.push({ name: 'home-homepage' })

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
