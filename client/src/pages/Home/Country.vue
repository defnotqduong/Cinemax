<template>
    <div class="mt-[120px]">
        <div v-if="loading" class="flex items-center justify-center min-h-[80vh]">
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading">
            <div class="max-w-[1240px] mx-auto px-2 mb-10">
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
                        <li>Quốc gia</li>
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
                        <li class="text-secondary">{{ country.title }}</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-[1240px] mx-auto px-2 pb-10 grid grid-cols-3 gap-10">
                <div class="col-span-3">
                    <div class="mb-10">
                        <div class="mb-7 flex items-center justify-between">
                            <h4
                                class="text-3xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                            >
                                Xu hướng
                            </h4>
                            <div class="relative flex items-center justify-center gap-3 py-[2px]">
                                Sắp xếp theo :
                                <select class="select select-bordered select-sm w-[90px] max-w-xs">
                                    <option class="line-clamp-1">A-Z</option>
                                    <option class="line-clamp-1">1-10</option>
                                    <option class="line-clamp-1">10-20</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 items-center justify-start gap-7">
                            <div v-for="i in 15" :key="i">
                                <MovieCard />
                            </div>
                        </div>
                        <div class="mt-4">
                            <Pagination />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue'
import Pagination from '../../components/Pagination/Pagination.vue'
import MovieCard from '../../components/Movie/MovieCard.vue'

import { getCountry } from '../../webServices/countryService'
export default defineComponent({
    components: { MovieCard, Pagination },
    setup() {
        const country = ref({
            id: null,
            title: '',
            slug: ''
        })

        const movies = ref([])

        const loading = ref(false)

        const loadingPage = ref(false)

        return {
            country,
            movies,
            loading,
            loadingPage
        }
    },
    watch: {
        '$route.params.slug'() {
            // console.log('watch')
            this.getData()
        }
    },
    methods: {
        async getData() {
            this.loading = true
            const slug = this.$route.params.slug
            const [countryData] = await Promise.all([getCountry(slug)])

            console.log(countryData)

            if (countryData.success) {
                this.country.id = countryData.country.id
                this.country.title = countryData.country.title
                this.country.slug = countryData.country.slug
                this.loading = false
            }
        }
    },
    updated() {},
    created() {
        // console.log('created')
        this.getData()
    }
})
</script>

<style></style>
