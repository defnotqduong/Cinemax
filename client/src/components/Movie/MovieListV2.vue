<template>
    <div>
        <div v-for="i in 3" :key="i" class="mb-7">
            <MovieCardV2 />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import MovieCardV2 from './MovieCardV2.vue'

export default defineComponent({
    components: { MovieCardV2 },
    props: {
        type: String
    }
})
</script>

<style></style>
