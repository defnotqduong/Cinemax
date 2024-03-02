<template>
    <Swiper
        :modules="modules"
        :allow-touch-move="true"
        :slides-per-view="1"
        :grab-cursor="true"
        :loop="true"
        :autoplay="{ delay: 3000, disableOnInteraction: false }"
        :speed="1000"
    >
        <SwiperSlide v-for="movie in homeStore.newMovies" :key="movie.id">
            <div class="relative mb-[100px] container mx-auto">
                <div
                    class="bg-cover bg-center bg-no-repeat absolute top-0 left-0 w-full h-full z-[-1] after:absolute after:content after:top-0 after:left-0 after:w-full after:h-full after:bg-overlay before:absolute before:content before:bottom-0 before:left-0 before:w-full before:h-[100px] before:bg-blur"
                    :style="{ backgroundImage: `url('${movie.poster}')` }"
                ></div>
                <div class="max-w-[1220px] mx-auto py-[160px]">
                    <div class="flex items-center justify-center gap-20">
                        <div class="flex-1 px-10">
                            <h3 class="text-[60px] font-extrabold text-white line-clamp-1">{{ movie.title }}</h3>
                            <div class="mt-2 text-white font-bold line-clamp-3" v-html="movie.description"></div>
                            <div class="mt-6">
                                <router-link
                                    :to="{
                                        name: 'home-watching',
                                        params: {
                                            slug: movie.slug,
                                            ep: '1'
                                        }
                                    }"
                                >
                                    <Button :content="'Xem phim'" />
                                </router-link>
                            </div>
                        </div>
                        <div class="w-[360px] h-[500px] rounded-3xl overflow-hidden shadow mr-10">
                            <img :src="movie.thumbnail" alt="Thumbnail" class="w-full h-full object-cover object-center" />
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
        console.log(homeStore.newMovies)
        return {
            modules: [Autoplay],
            homeStore
        }
    }
})
</script>

<style></style>
