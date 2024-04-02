<template>
    <!-- <div class="grid grid-cols-6 items-start justify-start gap-4">
        <div v-for="movie in movies" :key="movie.id">
            <MovieCardV3 :movie="movie" />
        </div>
    </div> -->
    <div>
        <Swiper :spaceBetween="20" :slidesPerView="6" :modules="modules" class="thumbs-swiper">
            <SwiperSlide v-for="movie in movies" :key="movie.id">
                <MovieCardV3 :movie="movie" />
            </SwiperSlide>
        </Swiper>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import { Autoplay, Navigation, Pagination, EffectFade, Thumbs, FreeMode } from 'Swiper'
import MovieCardV3 from './MovieCardV3.vue'
export default defineComponent({
    components: { MovieCardV3 },
    props: { movies: Array },
    setup() {
        return {
            modules: []
        }
    }
})
</script>

<style></style>
