<template>
    <div>
        <div v-for="movie in movies" :key="movie.id" class="mb-7">
            <MovieCardV2 :movie="movie" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieCardV2 from './MovieCardV2.vue'

export default defineComponent({
    components: { MovieCardV2 },
    props: {
        movies: Array
    }
})
</script>

<style></style>
