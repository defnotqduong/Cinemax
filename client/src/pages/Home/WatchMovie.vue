<template>
    <div class="mt-[140px]">
        <div v-if="loading" class="flex items-center justify-center min-h-[60vh]">
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
                        <li class="text-white">{{ movie.name }}</li>
                    </ul>
                </div>
            </div>

            <div class="max-w-[1200px] mx-auto px-2 mb-10">
                <div class="pt-4">
                    <div class="mb-20 flex items-center justify-center">
                        <iframe width="90%" height="520" :src="episode && episode.link" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div>
                        <div class="mb-6 flex items-center justify-between">
                            <h4
                                class="text-xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                            >
                                Danh sách tập phim
                            </h4>
                        </div>
                        <div v-if="episodes.length > 0">
                            <div v-for="(data, index) in episodes" :key="index" class="mb-8">
                                <h6 class="mb-3 flex items-center justify-start gap-1 text-lg text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M2.25 6C2.25 5.58579 2.58579 5.25 3 5.25H20C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75H3C2.58579 6.75 2.25 6.41421 2.25 6ZM2.25 11C2.25 10.5858 2.58579 10.25 3 10.25H9C9.41421 10.25 9.75 10.5858 9.75 11C9.75 11.4142 9.41421 11.75 9 11.75H3C2.58579 11.75 2.25 11.4142 2.25 11ZM2.25 16C2.25 15.5858 2.58579 15.25 3 15.25H10C10.4142 15.25 10.75 15.5858 10.75 16C10.75 16.4142 10.4142 16.75 10 16.75H3C2.58579 16.75 2.25 16.4142 2.25 16Z"
                                            fill="currentColor"
                                        />
                                        <path
                                            d="M13 11.7148C13 13.4673 15.1633 15.3304 16.4901 16.3082C16.9442 16.643 17.1713 16.8103 17.5 16.8103C17.8287 16.8103 18.0558 16.643 18.5099 16.3082C19.8367 15.3304 22 13.4674 22 11.7147C22 9.03758 19.5249 8.03806 17.5 10.1061C15.4751 8.03806 13 9.03758 13 11.7148Z"
                                            fill="currentColor"
                                        /></svg
                                    >{{ data.server_name }}
                                </h6>
                                <ul class="grid grid-cols-12 gap-4 max-h-[250px] overflow-y-auto">
                                    <li v-for="ep in data.server_data" :key="ep.id">
                                        <button
                                            @click="getEp(data.server_name, ep.name)"
                                            class="py-2 w-full text-center rounded-md hover:bg-white hover:text-black transition-all duration-200"
                                            :class="ep.id === episode.id ? 'bg-white text-black' : 'bg-base-300 text-white'"
                                        >
                                            {{ ep.name }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
import Review from '../../components/Review/Review.vue'

import { getEpisodes } from '../../webServices/movieService'
export default defineComponent({
    components: { Review, Error },
    setup() {
        const movie = ref({
            id: null,
            title: '',
            slug: ''
        })

        const episode = ref(null)

        const episodes = ref([])

        const loading = ref(false)

        return { movie, episodes, episode, loading }
    },
    watch: {},
    methods: {
        async getData() {
            const slug = this.$route.params.slug

            window.scrollTo({ top: 0 })
            this.loading = true
            const [data] = await Promise.all([getEpisodes(slug)])

            if (data && data.status === 404) this.$router.push({ name: 'home-homepage' })

            if (data && data.success) {
                this.movie = data.movie
                this.episodes = [...data.episodes]
                this.episode = data?.episodes[0]?.server_data[0]

                this.episodes.sort((a, b) => a.server_name.localeCompare(b.server_name))
            }

            this.loading = false
        },
        getEp(server_name, ep) {
            this.episodes.forEach(data => {
                if (data.server_name === server_name) {
                    data.server_data.forEach(item => {
                        if (item.name === ep) {
                            this.episode = item
                        }
                    })
                }
            })
            window.scrollTo({ top: 0 })
        }
    },
    created() {
        window.scrollTo({ top: 0 })
        this.getData()
    }
})
</script>

<style></style>
