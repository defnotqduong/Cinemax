<template>
    <div class="py-20">
        <div>
            <h3 class="text-2xl font-bold mb-10">Chỉnh sửa Tập phim:</h3>
            <div v-if="loading" class="flex items-center justify-center min-h-[50vh]">
                <span class="loading loading-spinner text-white"></span>
            </div>
            <div v-if="success" role="alert" class="alert bg-green-400 text-white w-[20%] fixed top-10 right-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Chỉnh sửa thành công</span>
            </div>
            <form v-if="!loading" class="w-[50%] mx-auto" @submit.prevent="edit">
                <h4 class="font-bold text-xl text-white mb-6">Phim: {{ title }}</h4>
                <label for="title" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Id phim:</div>
                    <input id="title" type="text" v-model="movie_id" placeholder="Tập" class="input input-bordered h-10 input-secondary w-full" readonly />
                    <div v-if="errors && errors.movie_id" class="mt-2 text-primary">
                        {{ errors.movie_id[0] }}
                    </div>
                </label>
                <label for="title" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Tập:</div>
                    <input id="title" type="text" v-model="episode" placeholder="Tập" class="input input-bordered h-10 input-secondary w-full" />
                    <div v-if="errors && errors.episode" class="mt-2 text-primary">
                        {{ errors.episode[0] }}
                    </div>
                </label>
                <label for="title" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Server:</div>
                    <input id="title" type="text" v-model="server_name" placeholder="Tên server" class="input input-bordered h-10 input-secondary w-full" />
                    <div v-if="errors && errors.server_name" class="mt-2 text-primary">
                        {{ errors.server_name[0] }}
                    </div>
                </label>
                <label for="description" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Link phim:</div>
                    <input id="description" type="text" v-model="link" placeholder="Link phim" class="input input-bordered h-10 input-secondary w-full" />
                    <div v-if="errors && errors.link" class="mt-2 text-primary">
                        {{ errors.link[0] }}
                    </div>
                </label>
                <button class="px-6 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300">
                    <span v-if="loadingSubmit" class="loading loading-spinner text-white"></span>
                    <span v-if="!loadingSubmit">Sửa</span>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue'
import { useRouter } from 'vue-router'
import { findMovieById } from '../../../webServices/movieService'
import { editEpisode, getEpisodeById } from '../../../webServices/episodeService'
export default defineComponent({
    setup() {
        const movie = reactive({
            id: null,
            title: '',
            thumbnail: ''
        })

        const episode = reactive({
            episode_id: null,
            movie_id: null,
            server_name: '',
            episode: null,
            link: ''
        })

        const errors = ref([])
        const success = ref(false)
        const loading = ref(false)
        const loadingSubmit = ref(false)

        const router = useRouter()

        const edit = async () => {
            loadingSubmit.value = true
            const data = await editEpisode(episode.episode_id, episode)

            console.log(data)

            if (data && data.status === 401) {
                router.push({ name: 'auth-login' })
                return
            }

            if (data && data.success) {
                success.value = true
                errors.value = []
                loadingSubmit.value = false
                setTimeout(() => {
                    success.value = false
                }, 2000)

                return
            }

            errors.value = data && data.data.errors
            loadingSubmit.value = false
        }

        return {
            ...toRefs(movie),
            ...toRefs(episode),
            edit,
            success,
            errors,
            loading,
            loadingSubmit
        }
    },
    methods: {
        async loadData() {
            this.loading = true

            const id = this.$route.params.id
            const epId = this.$route.params.epId

            const [episodeData, movieData] = await Promise.all([getEpisodeById(epId), findMovieById(id)])

            if (episodeData && episodeData.success) {
                this.episode_id = episodeData.episode.id
                this.movie_id = episodeData.episode.movie_id
                this.server_name = episodeData.episode.server_name
                this.episode = episodeData.episode.episode
                this.link = episodeData.episode.link
            }
            if (movieData && movieData.success) {
                const movie = movieData.movie
                this.id = movie.id
                this.movie_id = movie.id
                this.title = movie.title
                this.thumbnail = movie.thumbnail
                this.loading = false
            }
        }
    },
    created() {
        this.loadData()
    }
})
</script>

<style></style>
