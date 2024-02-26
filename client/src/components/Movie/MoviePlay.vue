<template>
    <div class="pt-8">
        <div class="mb-20 flex items-center justify-center">
            <iframe width="90%" height="500" src="https://www.youtube.com/embed/PsVEpKthrcg" frameborder="0" allowfullscreen></iframe>
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
                <li v-for="i in 500" :key="i">
                    <button class="py-2 w-full text-center rounded-md bg-ep text-white hover:bg-white hover:text-black transition-all duration-200">
                        <router-link
                            :to="{
                                name: 'home-watching',
                                params: {
                                    slug: 'fate-stay-night-unlimited-blade',
                                    ep: i
                                }
                            }"
                            class="block"
                        >
                            Tập {{ i }}</router-link
                        >
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({})
</script>

<style></style>
