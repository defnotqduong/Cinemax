<template>
    <div class="mt-[160px]">
        <div v-if="loading" class="flex items-center justify-center min-h-[80vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <div class="max-w-[1200px] mx-auto px-2 mb-10">
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
                        <li>Xem phim</li>
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
            <div v-if="error">
                <Error />
            </div>
            <div v-if="!error" class="max-w-[1200px] mx-auto px-2 mb-10">
                <MoviePlay :episodes="episodes" :episode="episode" @changeEpisode="changeEpisode" />
                <div class="grid grid-cols-3 gap-10 mt-16">
                    <div class="col-span-2">
                        <Review />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import MoviePlay from '../../components/Movie/MoviePlay.vue'
import Review from '../../components/Review/Review.vue'
import Error from '../../components/Error/Error.vue'

import { getPublicMovie } from '../../webServices/movieService'
import { getAllEpisodeByMovieId, getEpisodeById, getEpisode } from '../../webServices/episodeService'
export default defineComponent({
    components: { MoviePlay, Review, Error },
    setup() {
        const movie = ref({
            id: null,
            title: '',
            slug: ''
        })

        const episode = ref({
            id: null,
            movie_id: null,
            server_name: '',
            link: ''
        })

        const episodes = ref([])

        const loading = ref(false)
        const error = ref(false)

        return { movie, episodes, episode, loading, error }
    },
    watch: {
        '$route.params.ep'() {
            const ep = this.$route.params.ep || 1
            this.getEp(ep)
        }
    },
    methods: {
        async getData() {
            const slug = this.$route.params.slug
            const ep = this.$route.params.ep

            this.loading = true
            this.error = false

            const [movieData] = await Promise.all([getPublicMovie(slug)])

            if (movieData && !movieData.success) {
                this.error = true
                this.loading = false
                return
            }

            if (movieData && movieData.success) {
                for (const key in movieData.movie) {
                    this.movie[key] = movieData.movie[key]
                }

                const [episodes, episode] = await Promise.all([getAllEpisodeByMovieId(this.movie.id), getEpisode({ movie_id: this.movie.id, ep: ep })])

                if (episodes && episodes.success) this.episodes = episodes.episodes
                if (episode && episode.success) this.episode = episode.episode
            }

            this.loading = false
        },
        async getEp(ep) {
            const [episode] = await Promise.all([getEpisode({ movie_id: this.movie.id, ep: ep })])

            if (episode && episode.success) this.episode = episode.episode

            window.scrollTo({ top: 0 })
        },
        changeEpisode(ep) {
            this.$router.push({ name: 'home-watching', params: { ep } })
        }
    },
    created() {
        window.scrollTo({ top: 0 })
        this.getData()
    }
})
</script>

<style></style>
