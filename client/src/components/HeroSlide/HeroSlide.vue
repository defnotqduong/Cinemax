<template>
    <Swiper
        :modules="modules"
        :allow-touch-move="true"
        :slides-per-view="1"
        :grab-cursor="true"
        :loop="true"
        :autoplay="{ delay: 5000, disableOnInteraction: false }"
        :speed="1500"
    >
        <SwiperSlide v-for="movie in homeStore.heroSlide" :key="movie.id">
            <div class="relative mb-[100px] container mx-auto">
                <div
                    class="bg-cover bg-center bg-no-repeat absolute top-0 left-0 w-full h-full z-[-1] after:absolute after:content after:top-0 after:left-0 after:w-full after:h-full after:bg-overlay before:absolute before:content before:bottom-0 before:left-0 before:w-full before:h-[100px] before:bg-blur"
                    :style="{ backgroundImage: `url('${movie.poster_url}')` }"
                ></div>
                <div class="max-w-[1220px] mx-auto py-[150px]">
                    <div class="flex items-center justify-center gap-24">
                        <div class="flex-1 pl-16 pr-10">
                            <h3 class="text-[60px] font-extrabold text-white line-clamp-2 leading-[1.1]">{{ movie.name }}</h3>
                            <div class="mt-2 text-white font-bold line-clamp-3" v-html="movie.content"></div>
                            <div class="mt-8 flex items-center justify-start gap-3">
                                <a>
                                    <button
                                        class="px-8 py-2 bg-transparent rounded-full text-primary text-xl font-bold border-2 border-primary hover:bg-primary hover:text-white transiton-all duration-[300ms]"
                                    >
                                        <span>Trailer</span>
                                    </button>
                                </a>
                                <a>
                                    <button
                                        class="px-8 py-2 bg-primary rounded-full text-white text-xl font-bold border-2 border-primary hover:bg-primary hover:text-white transiton-all duration-[300ms]"
                                    >
                                        <span>Xem phim</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="w-[360px] h-[460px] rounded-3xl overflow-hidden shadow mr-16">
                            <img :src="movie.thumb_url" alt="Thumbnail" class="w-full h-full object-cover object-center" />
                        </div>
                    </div>
                </div>
            </div>
        </SwiperSlide>
    </Swiper>
</template>

<script>
import { defineComponent } from 'vue'
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import { Autoplay } from 'Swiper'
import Button from '../Button/Button.vue'

import { useHomeStore } from '../../stores/modules/homeStore'
export default defineComponent({
    components: {
        Swiper,
        SwiperSlide,
        Button
    },
    setup() {
        const homeStore = useHomeStore()
        return {
            modules: [Autoplay],
            homeStore
        }
    }
})
</script>

<style></style>
