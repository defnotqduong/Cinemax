<template>
    <div class="mt-[120px]">
        <div class="max-w-[1240px] mx-auto px-2 mb-10">
            <div class="text-sm">
                <ul class="flex items-center justify-start gap-1 font-medium">
                    <li>
                        <router-link :to="{ name: 'home-homepage' }"
                            >Trang chủ</router-link
                        >
                    </li>
                    <li>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="14px"
                            height="14px"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
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
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="14px"
                            height="14px"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
                            <path
                                d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </li>
                    <li class="text-secondary">Anime</li>
                </ul>
            </div>
        </div>
        <div class="max-w-[1240px] mx-auto px-2 pb-10 grid grid-cols-3 gap-10">
            <div class="col-span-2">
                <MovieListCategory />
            </div>
            <div class="col-span-1">
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-[30px]">
                        <h4
                            class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Lượt xem hàng đầu
                        </h4>
                        <ul
                            class="flex items-center justify-center gap-[10px] text-sm font-medium text-secondary"
                        >
                            <li>
                                <button
                                    :class="{
                                        'text-white': isFilter === 'day'
                                    }"
                                    @click="this.isFilter = 'day'"
                                >
                                    Ngày
                                </button>
                            </li>
                            <li>
                                <button
                                    :class="{
                                        'text-white': isFilter === 'week'
                                    }"
                                    @click="this.isFilter = 'week'"
                                >
                                    Tuần
                                </button>
                            </li>
                            <li>
                                <button
                                    :class="{
                                        'text-white': isFilter === 'month'
                                    }"
                                    @click="this.isFilter = 'month'"
                                >
                                    Tháng
                                </button>
                            </li>
                            <li>
                                <button
                                    :class="{
                                        'text-white': isFilter === 'year'
                                    }"
                                    @click="this.isFilter = 'year'"
                                >
                                    Năm
                                </button>
                            </li>
                        </ul>
                    </div>
                    <MovieListViewed :type="isFilter" />
                </div>
                <div>
                    <div class="mb-[30px]">
                        <h4
                            class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Phim mới cập nhật
                        </h4>
                    </div>
                    <MovieListNew />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import HeroSlide from '../../components/HeroSlide/HeroSlide.vue'
import MovieListCategory from '../../components/Movie/MovieListCategory.vue'
import MovieListNew from '../../components/Movie/MovieListNew.vue'
import MovieListViewed from '../../components/Movie/MovieListViewed.vue'
export default defineComponent({
    components: { HeroSlide, MovieListViewed, MovieListNew, MovieListCategory },
    setup() {
        const isFilter = ref('day')
        const category = ref('')

        return {
            isFilter,
            category
        }
    },
    methods: {
        getUrlQueryParam() {
            return this.$route.params.slug
        }
    },
    mounted() {
        window.scrollTo({ top: 0 })
        this.category = this.getUrlQueryParam()
    }
})
</script>

<style></style>
