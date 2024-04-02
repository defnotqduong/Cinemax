<template>
    <div class="flex items-center justify-start">
        <div class="mr-4 w-14">
            <a>
                <img :src="movie.thumb_url" alt="thumb" class="w-full h-full object-cover object-center rounded-md" />
            </a>
        </div>
        <div class="flex-1">
            <h5 class="mr-4 text-white text-base font-semibold cursor-pointer line-clamp-2">
                <a>
                    {{ movie.name }}
                </a>
            </h5>
            <h6 class="mt-1 text-sm line-clamp-1">{{ movie.origin_name }}</h6>
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
        }
    }
})
</script>

<style></style>
