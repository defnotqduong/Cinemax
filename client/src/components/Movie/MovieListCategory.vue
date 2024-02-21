<template>
    <div class="mb-10">
        <div class="mb-7 flex items-center justify-between">
            <h4
                class="text-3xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
            >
                Xu hướng
            </h4>
            <div
                class="relative flex items-center justify-center gap-3 py-[2px]"
            >
                Sắp xếp theo :
                <select
                    class="select select-bordered select-sm w-[90px] max-w-xs"
                >
                    <option class="line-clamp-1">A-Z</option>
                    <option class="line-clamp-1">1-10</option>
                    <option class="line-clamp-1">10-20</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 items-center justify-start gap-7">
            <div v-for="i in 15" :key="i">
                <MovieCard />
            </div>
        </div>
        <div class="mt-4">
            <Pagination />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Pagination from '../Pagination/Pagination.vue'
import MovieCard from './MovieCard.vue'

export default defineComponent({
    components: { MovieCard, Pagination }
})
</script>

<style></style>
