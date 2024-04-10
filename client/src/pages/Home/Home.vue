<template>
    <div>
        <HeroSlideV2 />
        <div class="max-w-[1200px] mx-auto pb-20 grid grid-cols-4 gap-10">
            <div class="col-span-4">
                <div class="mb-10" v-for="(data, index) in homeStore.movieByCatalog" :key="index">
                    <div class="mb-7 flex items-center justify-between">
                        <h4
                            class="text-2xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            {{ data.name }}
                        </h4>
                        <router-link
                            :to="{
                                name: 'home-category',
                                params: { slug: data.slug }
                            }"
                            class="relative flex items-center justify-center gap-3 py-[2px] cursor-pointer hover:text-primary transition-colors duration-[700ms] after:absolute after:content after:bottom-0 after:left-auto after:right-0 after:w-0 after:h-[2px] after:bg-primary after:rounded hover:after:w-full hover:after:right-auto hover:after:left-0 after:transition-width after:duration-[400ms]"
                            >Xem thêm
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                <path d="M2 12.0701H22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 5L21.16 10C21.4324 10.2571 21.6494 10.567 21.7977 10.9109C21.946 11.2548 22.0226 11.6255 22.0226 12C22.0226 12.3745 21.946 12.7452 21.7977 13.0891C21.6494 13.433 21.4324 13.7429 21.16 14L16 19"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                /></svg
                        ></router-link>
                    </div>
                    <MovieListV3 :movies="data.movies" />
                </div>
            </div>
            <!-- <div class="col-span-1">
                <div>
                    <div class="mb-[30px]">
                        <h4
                            class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Phim mới cập nhật
                        </h4>
                    </div>
                    <MovieListV2 :movies="homeStore.heroSlide" />
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import HeroSlide from '../../components/HeroSlide/HeroSlide.vue'
import HeroSlideV2 from '../../components/HeroSlideV2/HeroSlideV2.vue'
import MovieList from '../../components/Movie/MovieList.vue'
import MovieListV2 from '../../components/Movie/MovieListV2.vue'
import MovieListV3 from '../../components/Movie/MovieListV3.vue'

import { useHomeStore } from '../../stores/modules/homeStore'

export default defineComponent({
    components: { HeroSlide, HeroSlideV2, MovieList, MovieListV2, MovieListV3 },
    setup() {
        const isFilter = ref('day')
        const homeStore = useHomeStore()

        return {
            isFilter,
            homeStore
        }
    },
    created() {
        window.scrollTo({ top: 0 })
    }
})
</script>

<style></style>
