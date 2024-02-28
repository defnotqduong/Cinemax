<template>
    <div class="mt-[120px]">
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
                    <li>Chi tiết</li>
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
                    <li class="text-secondary">The Seven Deadly Sins: Wrath of the Gods</li>
                </ul>
            </div>
        </div>
        <div class="max-w-[1240px] mx-auto px-2 mb-10">
            <MovieDetails />
            <div class="grid grid-cols-3 gap-10 mt-16">
                <div class="col-span-2">
                    <Review />
                </div>
                <div class="col-span-1">
                    <div class="mb-[30px]">
                        <h4
                            class="text-base font-bold uppercase text-white pl-3 mt-1 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                        >
                            Có thể bạn muốn xem...
                        </h4>
                    </div>
                    <MovieListV3 :type="'update'" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieDetails from '../../components/Movie/MovieDetails.vue'
import MovieListV2 from '../../components/Movie/MovieListV2.vue'
import MovieListV3 from '../../components/Movie/MovieListV3.vue'
import Review from '../../components/Review/Review.vue'

export default defineComponent({
    components: { MovieDetails, Review, MovieListV2, MovieListV3 },
    setup() {},
    created() {
        window.scrollTo({ top: 0 })
    }
})
</script>

<style></style>
