<template>
    <div>
        <HeroSlide />
        <div class="max-w-[1240px] mx-auto px-2 pb-10 grid grid-cols-3 gap-10">
            <div class="col-span-2">
                <div class="mb-10">
                    <div class="mb-7 flex items-center justify-between">
                        <h4
                            class="text-3xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Xu hướng
                        </h4>
                        <a
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
                        ></a>
                    </div>
                    <MovieList :type="'trending'" />
                </div>
                <div class="mb-10">
                    <div class="mb-7 flex items-center justify-between">
                        <h4
                            class="text-3xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Mới cập nhật
                        </h4>
                        <a
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
                        ></a>
                    </div>
                    <MovieList :type="'update'" />
                </div>
                <div class="mb-10">
                    <div class="mb-7 flex items-center justify-between">
                        <h4
                            class="text-3xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Xem gần đây
                        </h4>
                        <a
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
                        ></a>
                    </div>
                    <MovieList :type="'recently '" />
                </div>
            </div>
            <div class="col-span-1">
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-[30px]">
                        <h4
                            class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Lượt xem hàng đầu
                        </h4>
                        <ul class="flex items-center justify-center gap-[10px] text-sm font-medium text-secondary">
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
                    <MovieListV3 :type="'mostviewed'" />
                </div>
                <div>
                    <div class="mb-[30px]">
                        <h4
                            class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Phim mới cập nhật
                        </h4>
                    </div>
                    <MovieListV2 :type="'update'" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import HeroSlide from '../../components/HeroSlide/HeroSlide.vue'
import MovieList from '../../components/Movie/MovieList.vue'
import MovieListV2 from '../../components/Movie/MovieListV2.vue'
import MovieListV3 from '../../components/Movie/MovieListV3.vue'

export default defineComponent({
    components: { HeroSlide, MovieList, MovieListV2, MovieListV3 },
    setup() {
        const isFilter = ref('day')

        return {
            isFilter
        }
    },
    mounted() {
        window.scrollTo({ top: 0 })
    }
})
</script>

<style></style>
