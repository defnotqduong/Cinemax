<template>
    <div class="grid grid-cols-4 items-start justify-start gap-8">
        <div v-for="movie in movies" :key="movie.id">
            <MovieCardV3 :movie="movie" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieCardV3 from './MovieCardV3.vue'
export default defineComponent({
    components: { MovieCardV3 },
    props: { movies: Array }
})
</script>

<style></style>
