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
                        <li>Thể loại</li>
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
                        <li class="text-secondary">{{ category.title }}</li>
                    </ul>
                </div>
            </div>
            <div v-if="!error" class="max-w-[1200px] mx-auto px-2 pb-10 grid grid-cols-3 gap-12">
                <div class="col-span-3">
                    <div class="mb-10">
                        <div class="mb-14 flex items-start justify-between">
                            <h4
                                class="text-3xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                            >
                                {{ category.title }}
                            </h4>
                            <!-- <div class="relative flex items-center justify-center gap-3 py-[2px]">
                                Sắp xếp theo :
                                <select class="select select-bordered select-sm w-[90px] max-w-xs">
                                    <option class="line-clamp-1">A-Z</option>
                                    <option class="line-clamp-1">1-10</option>
                                    <option class="line-clamp-1">10-20</option>
                                </select>
                            </div> -->
                        </div>
                        <div>
                            <div v-if="movies.length === 0" class="min-h-[30vh]"></div>
                            <div v-if="movies.length > 0">
                                <div class="grid grid-cols-5 items-start justify-start gap-8">
                                    <div v-for="movie in movies" :key="movie.id">
                                        <MovieCard :movie="movie" />
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <Pagination :meta="meta" :links="links" @getData="changePage" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="error" class="max-w-[1200px] min-h-[70vh] mx-auto flex items-center justify-center">
                <Error />
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue'
import Pagination from '../../components/Pagination/Pagination.vue'
import MovieCard from '../../components/Movie/MovieCard.vue'
import Error from '../../components/Error/Error.vue'

import { getCategory } from '../../webServices/categoryService'
import { getMovieByCategory } from '../../webServices/movieService'
export default defineComponent({
    components: { MovieCard, Pagination, Error },
    setup() {
        const category = ref({
            id: null,
            title: '',
            slug: ''
        })

        const meta = ref({
            current_page: 1,
            last_page: 1
        })

        const links = ref({
            first_page_url: '',
            last_page_url: '',
            prev_page_url: '',
            next_page_url: ''
        })

        const movies = ref([])
        const loading = ref(false)
        const loadingPage = ref(false)
        const error = ref(false)

        return {
            category,
            meta,
            links,
            movies,
            loading,
            loadingPage,
            error
        }
    },
    watch: {
        '$route.params.slug'() {
            this.getData()
        },
        '$route.query.page'() {
            const page = this.$route.query.page || 1
            this.getMoviesByPage(page)
        }
    },
    methods: {
        async getData() {
            this.loading = true
            this.error = false

            const slug = this.$route.params.slug
            const page = this.$route.query.page || 1

            const [categoryData] = await Promise.all([getCategory(slug)])

            if (categoryData && categoryData.success) {
                this.category.id = categoryData.category.id
                this.category.title = categoryData.category.title
                this.category.slug = categoryData.category.slug

                const data = await getMovieByCategory({ category_id: this.category.id, page: page })

                console.log(data)

                if (data && data.success) {
                    this.movies = data.movies.data

                    this.meta.current_page = data.movies.current_page
                    this.meta.last_page = data.movies.last_page

                    this.links.first_page_url = data.movies.first_page_url
                    this.links.last_page_url = data.movies.last_page_url
                    this.links.prev_page_url = data.movies.prev_page_url
                    this.links.next_page_url = data.movies.next_page_url
                }
            } else {
                this.error = true
            }
            this.loading = false
        },

        async getMoviesByPage(page) {
            const data = await getMovieByCategory({ category_id: this.category.id, page: page })

            if (data && data.success) {
                this.movies = data.movies.data

                this.meta.current_page = data.movies.current_page
                this.meta.last_page = data.movies.last_page

                this.links.first_page_url = data.movies.first_page_url
                this.links.last_page_url = data.movies.last_page_url
                this.links.prev_page_url = data.movies.prev_page_url
                this.links.next_page_url = data.movies.next_page_url
            }
        },
        async changePage(page) {
            this.$router.push({ name: 'home-category', query: { page: page || 1 } })
        }
    },
    updated() {},
    created() {
        window.scrollTo({ top: 0 })
        this.getData()
    }
})
</script>

<style></style>
