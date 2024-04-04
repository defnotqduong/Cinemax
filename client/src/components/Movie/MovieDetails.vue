<template>
    <div class="mx-12 grid grid-cols-6 gap-10">
        <div class="col-span-2">
            <div>
                <img :src="movie.thumb_url" alt="thumb" class="w-full object-cover object-center rounded-3xl" />
            </div>
        </div>
        <div class="col-span-4">
            <h4 class="text-5xl font-bold mb-6 text-white leading-[1.1]">{{ movie.name }}</h4>
            <ul class="w-[80%] grid grid-cols-6 gap-x-2 gap-y-3 mb-6">
                <li
                    v-for="category in movie.categories"
                    :key="category.id"
                    class="py-2 border-2 border-white rounded-full bg-base-300 text-white text-center text-sm font-semibold hover:bg-base-200 transiton-all duration-[300ms]"
                >
                    <router-link
                        :to="{
                            name: 'home-category',
                            params: { slug: category.slug }
                        }"
                        class="inline-block w-full h-full"
                    >
                        {{ category.name }}
                    </router-link>
                </li>
            </ul>
            <ul class="flex items-center justify-start gap-10 mb-4">
                <li>
                    Năm: <span class="text-white">{{ movie.year }}</span>
                </li>
                <li>
                    Thời lượng: <span class="text-white">{{ movie.episode_total }}</span>
                </li>
                <li>
                    Trạng thái: <span class="text-white">{{ movie.episode_current }}</span>
                </li>
            </ul>
            <div class="flex items-start justify-start gap-2 mb-4">
                Quốc gia:
                <router-link
                    :to="{
                        name: 'home-region',
                        params: { slug: region.slug }
                    }"
                    v-for="(region, index) in movie.regions"
                    :key="index"
                    class="text-white underline"
                    >{{ region.name }}{{ index < movie.regions.length - 1 ? ',' : '' }}
                </router-link>
            </div>
            <div class="mb-8 flex items-center justify-start gap-3">
                <button
                    class="pl-4 pr-2 py-1 h-10 min-w-[150px] bg-primary rounded-full text-white text-base font-semibold hover:bg-primaryHover transiton-all duration-[300ms]"
                >
                    <router-link
                        :to="{
                            name: 'home-details',
                            params: { slug: movie.slug }
                        }"
                        class="w-full h-full flex items-center justify-between gap-3"
                    >
                        <span>Xem phim</span>
                        <span class="px-[14px] py-[6px] rounded-full bg-black bg-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                <rect width="24" height="24" fill="none" />
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M3 5.49686C3 3.17662 5.52116 1.73465 7.52106 2.91106L18.5764 9.41423C20.5484 10.5742 20.5484 13.4259 18.5764 14.5858L7.52106 21.089C5.52116 22.2654 3 20.8234 3 18.5032V5.49686Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </span>
                    </router-link>
                </button>
                <button
                    class="pl-4 pr-2 py-1 h-10 min-w-[150px] flex items-center justify-between gap-3 rounded-full text-white text-base font-semibold bg-base-300 hover:bg-base-200 transiton-all duration-[300ms]"
                >
                    <span> Add to list</span>
                    <span class="px-[14px] py-[6px] rounded-full bg-white bg-opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 64 64" fill="none">
                            <path
                                d="M45.35 6.1709H19.41C16.8178 6.17618 14.3333 7.20827 12.5003 9.04123C10.6674 10.8742 9.63528 13.3587 9.62999 15.9509V52.2709C9.6272 53.3655 9.92973 54.4392 10.5036 55.3713C11.0775 56.3034 11.9 57.057 12.8787 57.5474C13.8573 58.0377 14.9533 58.2454 16.0435 58.1471C17.1337 58.0488 18.1748 57.6484 19.05 56.9909L31.25 47.8509C31.5783 47.6074 31.9762 47.4759 32.385 47.4759C32.7938 47.4759 33.1917 47.6074 33.52 47.8509L45.71 56.9809C46.5842 57.6387 47.6246 58.0397 48.7142 58.1387C49.8038 58.2378 50.8994 58.0311 51.8779 57.5418C52.8565 57.0525 53.6793 56.3001 54.2537 55.3689C54.8282 54.4378 55.1317 53.365 55.13 52.2709V15.9509C55.1247 13.3587 54.0926 10.8742 52.2597 9.04123C50.4267 7.20827 47.9422 6.17618 45.35 6.1709Z"
                                fill="currentColor"
                            />
                        </svg>
                    </span>
                </button>
            </div>
            <div
                class="mb-1 relative opacity-70 after:absolute after:content after:bottom-0 after:left-0 after:w-full after:h-10"
                :class="isLearnMore ? 'line-clamp-none after:bg-transparent' : 'line-clamp-3 after:bg-blur'"
                v-html="movie.content"
            ></div>
            <button class="py-2 text-white flex items-center justify-center gap-2" @click="isLearnMore = !isLearnMore">
                {{ isLearnMore ? 'Ẩn bớt' : 'Xem thêm' }}
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16px"
                    height="16px"
                    viewBox="0 0 24 24"
                    fill="none"
                    class="inline-block transition-all duration-[350ms]"
                    :class="{ 'rotate-180': isLearnMore }"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z"
                        fill="currentColor"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
export default defineComponent({
    props: { movie: Object },
    setup() {
        const isLearnMore = ref(false)

        return {
            isLearnMore
        }
    },
    methods: {}
})
</script>

<style></style>
