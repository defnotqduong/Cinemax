<template>
    <div class="mx-14 grid grid-cols-4 gap-10">
        <div class="col-span-1">
            <div>
                <img :src="movie.thumbnail" alt="thumb" class="w-full h-full object-cover object-center rounded-lg" />
            </div>
        </div>
        <div class="col-span-3">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h4 class="text-3xl font-bold mb-2">{{ movie.title }}</h4>
                    <p class="text-secondary">{{ movie.name_eng }}</p>
                </div>
            </div>
            <div>
                <p class="text-secondary text-lg tracking-wide" v-html="movie.description"></p>
                <ul class="mt-6 grid grid-cols-2 gap-x-14 gap-y-4 text-secondary">
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Trạng thái:</div>
                        <div class="text-white font-semibold">{{ movie.episode_current || '??' }} / {{ movie.eps || '??' }} Tập</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Thời lượng:</div>
                        <div class="text-white font-semibold line-clamp-1">{{ movie.duration }}</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Thể loại:</div>
                        <div class="text-white font-semibold line-clamp-1">{{ movie.category_title }}, {{ movie.genre_title }}</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Độ phân giải:</div>
                        <div class="text-white font-semibold line-clamp-1">{{ this.getResolutionText(movie.resolution) }}</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Lượt xem:</div>
                        <div class="text-white font-semibold line-clamp-1">{{ movie.view || 0 }} views</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Phụ đề:</div>
                        <div v-if="movie.resolution !== 5" class="text-white font-semibold line-clamp-1">{{ this.getSubtitle(movie.subtitle) }}</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Quốc gia:</div>
                        <div class="text-white font-semibold line-clamp-1">{{ movie.country_title }}</div>
                    </li>
                    <li
                        class="flex items-center justify-start pl-4 relative after:absolute after:content after:top-1/2 after:left-0 after:-translate-y-1/2 after:w-[6px] after:h-[6px] after:bg-secondary"
                    >
                        <div class="w-[40%]">Năm sản xuất:</div>
                        <div class="text-white font-semibold line-clamp-1">{{ movie.year }}</div>
                    </li>
                </ul>
                <div class="mt-10 flex items-center justify-start gap-4">
                    <button class="px-6 py-2 relative flex items-center justify-center gap-2 rounded bg-primary-alpha text-white text-lg font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none" class="mb-[2px]">
                            <path
                                d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z"
                                stroke="currentColor"
                                stroke-width="2"
                            />
                        </svg>
                        Theo dõi
                    </button>
                    <router-link
                        :to="{
                            name: 'home-watching',
                            params: {
                                slug: movie.slug,
                                ep: '1'
                            }
                        }"
                        class="pl-6 py-2 pr-12 relative rounded bg-primary-alpha text-white text-lg font-semibold after:absolute after:conent after:top-0 after:right-6 after:h-full after:w-2 after:bg-base-100"
                    >
                        Xem phim
                        <span class="absolute right-[2px] top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </span>
                    </router-link>
                </div>
            </div>
        </div>
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
