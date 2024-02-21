<template>
    <div class="grid grid-cols-3 items-center justify-start gap-7">
        <div v-for="i in 5" :key="i">
            <MovieCard />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieCard from './MovieCard.vue'
export default defineComponent({
    components: { MovieCard },
    props: { type: String }
})
</script>

<style></style>
