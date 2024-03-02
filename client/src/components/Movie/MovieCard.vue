<template>
    <div class="mb-6 text-white">
        <router-link
            :to="{
                name: 'home-details',
                params: { slug: movie.slug }
            }"
        >
            <div class="h-[320px] relative">
                <img :src="movie.thumbnail" alt="thumb" class="w-full h-full object-cover object-center rounded-lg" />
                <span
                    class="absolute top-2 left-2 bg-badge-primary px-2 py-1 text-xs font-bold shadow-md shadow-[rgba(0,0,0,0.75)] after:absolute after:content after:top-[0.2rem] after:-right-[8px] after:w-0 after:h-0 after:border-t-[17.6px] after:border-t-transparent after:border-r-[17.6px] after:border-r-badge-primary after:-rotate-45"
                >
                    <span class="pr-1">{{ movie.episode_current }}</span>
                    <span class="pr-1">{{ this.getSubtitle(movie.subtitle) }}</span>
                </span>
                <!-- <span class="absolute left-[10px] bottom-4 bg-gray rounded px-2 text-sm flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M10.968 18.769C15.495 18.107 19 14.434 19 9.938a8.49 8.49 0 0 0-.216-1.912C20.718 9.178 22 11.188 22 13.475a6.1 6.1 0 0 1-1.113 3.506c.06.949.396 1.781 1.01 2.497a.43.43 0 0 1-.36.71c-1.367-.111-2.485-.426-3.354-.945A7.434 7.434 0 0 1 15 19.95a7.36 7.36 0 0 1-4.032-1.181z"
                            fill="currentColor"
                        />
                        <path
                            d="M7.625 16.657c.6.142 1.228.218 1.875.218 4.142 0 7.5-3.106 7.5-6.938C17 6.107 13.642 3 9.5 3 5.358 3 2 6.106 2 9.938c0 1.946.866 3.705 2.262 4.965a4.406 4.406 0 0 1-1.045 2.29.46.46 0 0 0 .386.76c1.7-.138 3.041-.57 4.022-1.296z"
                            fill="currentColor"
                        />
                    </svg>
                    11</span
                >
                <span class="absolute right-[10px] bottom-4 bg-gray rounded px-2 text-sm flex items-center justify-center gap-1">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        height="16px"
                        width="16px"
                        version="1.1"
                        id="Layer_1"
                        viewBox="0 0 512 512"
                        enable-background="new 0 0 512 512"
                        xml:space="preserve"
                    >
                        <path
                            d="M0,226v32c128,192,384,192,512,0v-32C384,34,128,34,0,226z M256,370c-70.7,0-128-57.3-128-128s57.3-128,128-128  s128,57.3,128,128S326.7,370,256,370z M256,170c0-8.3,1.7-16.1,4.3-23.6c-1.5-0.1-2.8-0.4-4.3-0.4c-53,0-96,43-96,96s43,96,96,96  c53,0,96-43,96-96c0-1.5-0.4-2.8-0.4-4.3c-7.4,2.6-15.3,4.3-23.6,4.3C288.2,242,256,209.8,256,170z"
                        />
                    </svg>
                    {{ movie.view || '0' }}</span
                > -->
            </div>
            <div class="pt-5">
                <!-- <div class="mb-[10px] flex items-center justify-start gap-2">
                    <div class="badge bg-badge text-white text-xs font-semibold">{{ movie.category_title }}</div>
                    <div class="badge bg-badge text-white text-xs font-semibold">{{ movie.genre_title }}</div>
                </div> -->
                <h6 class="mb-1 text-sm line-clamp-1 text-secondary">{{ movie.name_eng }}</h6>
                <h5 class="text-lg font-semibold text-white cursor-pointer hover:text-primary transitio-all duration-[400ms] line-clamp-2">
                    {{ movie.title }}
                </h5>
            </div>
        </router-link>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props: { movie: Object },
    methods: {
        getResolutionText(resolution) {
            switch (resolution) {
                case 0:
                    return 'FullHD'
                case 1:
                    return 'HD'
                case 2:
                    return 'SD'
                case 3:
                    return 'HDCam'
                case 4:
                    return 'Cam'
                case 5:
                    return 'Trailer'
                default:
                    return ''
            }
        },
        getSubtitle(subtitle) {
            switch (subtitle) {
                case 0:
                    return 'Thuyết Minh'
                case 1:
                    return 'VietSub'
                default:
                    return ''
            }
        }
    }
})
</script>

<style></style>
