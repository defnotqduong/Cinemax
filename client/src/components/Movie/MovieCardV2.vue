<template>
    <div class="flex items-center justify-start">
        <div class="mr-4 w-[90px]">
            <router-link
                :to="{
                    name: 'home-details',
                    params: { slug: 'the-seven-deadly-sins-wrath-of-the-gods' }
                }"
            >
                <img
                    src="https://w0.peakpx.com/wallpaper/73/146/HD-wallpaper-pretty-anime-girl-hand-gesture-posing-anime.jpg"
                    alt="thumb"
                    class="w-full h-full object-cover object-center"
                />
            </router-link>
        </div>
        <div class="flex-1">
            <div class="mb-[10px] flex items-center justify-start gap-2">
                <div class="badge bg-badge text-white text-xs font-semibold">Active</div>
                <div class="badge bg-badge text-white text-xs font-semibold">Movie</div>
            </div>
            <h5 class="mr-4 text-lg font-semibold cursor-pointer line-clamp-2">
                <router-link
                    :to="{
                        name: 'home-details',
                        params: {
                            slug: 'the-seven-deadly-sins-wrath-of-the-gods'
                        }
                    }"
                >
                    The Seven Deadly Sins: Wrath of the Gods
                </router-link>
            </h5>
            <div class="flex items-center justify-start gap-2 text-xs text-secondary mt-1">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    height="16px"
                    width="16px"
                    version="1.1"
                    id="Layer_1"
                    viewBox="0 0 512 512"
                    enable-background="new 0 0 512 512"
                    xml:space="preserve"
                >
                    <path
                        d="M0,226v32c128,192,384,192,512,0v-32C384,34,128,34,0,226z M256,370c-70.7,0-128-57.3-128-128s57.3-128,128-128  s128,57.3,128,128S326.7,370,256,370z M256,170c0-8.3,1.7-16.1,4.3-23.6c-1.5-0.1-2.8-0.4-4.3-0.4c-53,0-96,43-96,96s43,96,96,96  c53,0,96-43,96-96c0-1.5-0.4-2.8-0.4-4.3c-7.4,2.6-15.3,4.3-23.6,4.3C288.2,242,256,209.8,256,170z"
                    />
                </svg>
                <span>19.141</span> Viewes
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({})
</script>

<style></style>
