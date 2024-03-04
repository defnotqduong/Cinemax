<template>
    <div class="mt-[160px]">
        <div v-if="loading" class="flex items-center justify-center min-h-[80vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <div v-if="error">
                <Error />
            </div>
            <div v-if="!error">
                <div class="max-w-[1200px] mx-auto px-2 mb-16">
                    <div class="text-sm">
                        <ul class="flex items-center justify-start gap-1 font-medium">
                            <li>
                                <router-link :to="{ name: 'home-homepage' }">Trang chủ</router-link>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </li>
                            <li>Chi tiết</li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </li>
                            <li class="text-secondary">{{ movie.title }}</li>
                        </ul>
                    </div>
                </div>
                <div class="max-w-[1200px] mx-auto px-2 mb-10">
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

import { getPublicMovie } from '../../webServices/movieService'
import { useHomeStore } from '../../stores/modules/homeStore'

export default defineComponent({
    components: { MovieDetails, Review, MovieList, MovieListV2, MovieListV3, MovieCard, Error },
    setup() {
        const homeStore = useHomeStore()

        const loading = ref(false)

        const movie = ref({
            category_id: null,
            category_slug: '',
            category_title: '',
            country_id: null,
            country_slug: '',
            country_title: '',
            created_at: null,
            description: '',
            duration: '',
            episode_current: null,
            eps: null,
            genre_id: null,
            genre_slug: '',
            genre_title: '',
            id: null,
            name_eng: '',
            resolution: null,
            season: '',
            slug: '',
            status: null,
            subtitle: null,
            tags: '',
            thumbnail: '',
            title: '',
            updated_at: null,
            view: null,
            year: ''
        })

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
            this.error = false

            const data = await getPublicMovie(slug)

            if (data && data.success) {
                for (const key in data.movie) {
                    this.movie[key] = data.movie[key]
                }
            } else {
                this.error = true
            }
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
