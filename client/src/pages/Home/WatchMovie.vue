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
                    <li>Xem phim</li>
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
                    <li class="text-secondary">
                        The Seven Deadly Sins: Wrath of the Gods
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-[1240px] mx-auto px-2 mb-10">
            <MoviePlay />
            <div class="grid grid-cols-3 gap-10 mt-16">
                <div class="col-span-2">
                    <Review />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MoviePlay from '../../components/Movie/MoviePlay.vue'
import Review from '../../components/Review/Review.vue'
export default defineComponent({
    components: { MoviePlay, Review },
    mounted() {
        window.scrollTo({ top: 0 })
    }
})
</script>

<style></style>
