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
                        <!-- <router-link
                            :to="{
                                name: 'home-category',
                                params: { slug: data.slug }
                            }"
                            class="cssbuttons-io-button bg-primary"
                        >
                            Xem thêm
                            <div class="icon">
                                <svg height="20" width="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                                </svg>
                            </div>
                        </router-link> -->
                    </div>
                    <MovieListV3 :movies="data.movies" />
                </div>
            </div>
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

<style scoped>
.cssbuttons-io-button {
    color: white;
    font-family: inherit;
    padding: 0.35em;
    padding-left: 1.2em;
    font-size: 15px;
    font-weight: 400;
    border-radius: 0.9em;
    border: none;
    display: flex;
    align-items: center;
    box-shadow: inset 0 0 1.6em -0.6em #714da6;
    overflow: hidden;
    position: relative;
    height: 2.4em;
    padding-right: 3.3em;
    cursor: pointer;
}

.cssbuttons-io-button .icon {
    background: white;
    margin-left: 1em;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 1.8em;
    width: 1.8em;
    border-radius: 0.7em;
    box-shadow: 0.1em 0.1em 0.6em 0.2em #ff961b;
    right: 0.3em;
    transition: all 0.3s;
}

.cssbuttons-io-button:hover .icon {
    width: calc(100% - 0.6em);
}

.cssbuttons-io-button .icon svg {
    width: 1.1em;
    transition: transform 0.3s;
    color: #ff961b;
}

.cssbuttons-io-button:hover .icon svg {
    transform: translateX(0.1em);
}

.cssbuttons-io-button:active .icon {
    transform: scale(0.95);
}
</style>
