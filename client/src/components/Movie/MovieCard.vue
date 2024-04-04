<template>
    <div class="mb-6 text-white">
        <router-link
            :to="{
                name: 'home-details',
                params: { slug: movie.slug }
            }"
        >
            <div class="h-[280px] relative">
                <img :src="movie.thumb_url" alt="thumb" class="w-full h-full object-cover object-center rounded-lg" />
            </div>
            <div class="pt-5">
                <h6 class="mb-1 text-sm line-clamp-1 text-white opacity-60">{{ movie.origin_name }}</h6>
                <h5 class="text-lg font-semibold text-white cursor-pointer hover:text-primary transitio-all duration-[400ms] line-clamp-2">
                    {{ movie.name }}
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
