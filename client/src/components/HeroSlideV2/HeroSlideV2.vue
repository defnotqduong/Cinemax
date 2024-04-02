<template>
    <div class="mb-24 relative container mx-auto">
        <Swiper
            :loop="true"
            :spaceBetween="20"
            :thumbs="{ swiper: thumbsSwiper }"
            :autoplay="{ delay: 3000, disableOnInteraction: false }"
            :speed="1000"
            :modules="modules"
            class="top-swiper"
        >
            <SwiperSlide v-for="movie in homeStore.heroSlide" :key="movie.id">
                <div class="relative h-[700px]">
                    <div
                        class="bg-cover bg-center bg-no-repeat absolute top-0 left-0 w-full h-full z-[-1] after:absolute after:content after:top-0 after:left-0 after:w-full after:h-full after:bg-blurV3 before:absolute before:content before:bottom-0 before:left-0 before:w-full before:h-full before:bg-blurV2"
                        :style="{ backgroundImage: `url('${movie.poster_url}')` }"
                    ></div>
                    <div class="max-w-[1220px] mx-auto py-[140px]">
                        <div class="flex items-center justify-start">
                            <div class="w-[56%] pl-10">
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
                                            class="px-6 py-2 flex items-center justify-center gap-2 bg-primary rounded-full text-white text-xl font-bold border-2 border-primary hover:bg-primary hover:text-white transiton-all duration-[300ms]"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M16.6582 9.28638C18.098 10.1862 18.8178 10.6361 19.0647 11.2122C19.2803 11.7152 19.2803 12.2847 19.0647 12.7878C18.8178 13.3638 18.098 13.8137 16.6582 14.7136L9.896 18.94C8.29805 19.9387 7.49907 20.4381 6.83973 20.385C6.26501 20.3388 5.73818 20.0469 5.3944 19.584C5 19.053 5 18.1108 5 16.2264V7.77357C5 5.88919 5 4.94701 5.3944 4.41598C5.73818 3.9531 6.26501 3.66111 6.83973 3.6149C7.49907 3.5619 8.29805 4.06126 9.896 5.05998L16.6582 9.28638Z"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                            <span>Xem phim</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </SwiperSlide>
        </Swiper>

        <div class="absolute left-0 bottom-8 px-10" :style="{ width: thumbsContainerWidth + '%' }">
            <Swiper
                @swiper="setThumbsSwiper"
                :loop="true"
                :spaceBetween="12"
                :slidesPerView="heroSlideLength > 8 ? 8 : heroSlideLength"
                :freeMode="true"
                :watchSlidesProgress="true"
                :modules="modules"
                class="thumbs-swiper"
            >
                <SwiperSlide v-for="movie in homeStore.heroSlide" :key="movie.id">
                    <div class="slide-item">
                        <img :src="movie.thumb_url" alt="Thumb" />
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import { Autoplay, Navigation, Pagination, EffectFade, Thumbs, FreeMode } from 'Swiper'
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

        const heroSlideLength = homeStore.heroSlide.length

        const thumbsContainerWidth = heroSlideLength > 8 ? 100 : (100 / 8) * heroSlideLength

        const thumbsSwiper = ref(null)

        const setThumbsSwiper = swiper => {
            thumbsSwiper.value = swiper
        }

        return {
            modules: [Autoplay, Pagination, Navigation, EffectFade, Thumbs, FreeMode],
            heroSlideLength,
            thumbsContainerWidth,
            thumbsSwiper,
            setThumbsSwiper,
            homeStore
        }
    }
})
</script>

<style scoped>
.thumbs-swiper .slide-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    height: 180px;
    cursor: pointer;
}

.thumbs-swiper .slide-item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.thumbs-swiper .slide-item::after {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(15, 23, 42, 0.6);
}

.swiper-slide-thumb-active .slide-item::after {
    background-color: transparent;
}
</style>
