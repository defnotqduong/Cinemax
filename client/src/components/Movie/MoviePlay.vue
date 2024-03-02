<template>
    <div class="pt-8">
        <div class="mb-20 flex items-center justify-center">
            <iframe width="90%" height="500" :src="episode.link" frameborder="0" allowfullscreen></iframe>
        </div>
        <div>
            <div class="mb-7 flex items-center justify-between">
                <h4
                    class="text-xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
                >
                    Danh sách tập phim
                </h4>
            </div>
            <ul class="grid grid-cols-11 gap-4 max-h-[250px] overflow-y-auto">
                <li v-for="ep in episodes" :key="ep.id">
                    <button
                        class="py-2 w-full text-center rounded-md hover:bg-white hover:text-black transition-all duration-200"
                        :class="ep.episode === episode.episode ? 'bg-white text-black' : 'bg-ep text-white'"
                        @click="$emit('changeEpisode', ep.episode)"
                    >
                        {{ ep.episode }}
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props: {
        episodes: Array,
        episode: Object,
        changeEpisode: Function
    }
})
</script>

<style></style>
