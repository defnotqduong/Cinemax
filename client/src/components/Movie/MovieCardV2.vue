<template>
    <div class="flex items-center justify-start">
        <div class="mr-4 w-14">
            <router-link
                :to="{
                    name: 'home-details',
                    params: { slug: movie.slug }
                }"
            >
                <img :src="movie.thumb_url" alt="thumb" class="w-full h-full object-cover object-center rounded-md" />
            </router-link>
        </div>
        <div class="flex-1">
            <h5 class="mr-4 text-white text-base font-semibold cursor-pointer line-clamp-2">
                <router-link
                    :to="{
                        name: 'home-details',
                        params: { slug: movie.slug }
                    }"
                >
                    {{ movie.name }}
                </router-link>
            </h5>
            <h6 class="mt-1 text-sm line-clamp-1">{{ movie.origin_name }}</h6>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props: { movie: Object },
    methods: {}
})
</script>

<style></style>
