<template>
    <div class="grid grid-cols-4 items-start justify-start gap-8">
        <div v-for="movie in movies" :key="movie.id">
            <MovieCard :movie="movie" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieCard from './MovieCard.vue'
export default defineComponent({
    components: { MovieCard },
    props: { movies: Array }
})
</script>

<style></style>
