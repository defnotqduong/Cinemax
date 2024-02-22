<template>
    <div>
        <div v-for="i in 4" :key="i" class="mb-7">
            <MovieCardV3 />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieCardV3 from './MovieCardV3.vue'
export default defineComponent({
    components: { MovieCardV3 },
    props: { type: String }
})
</script>

<style></style>
