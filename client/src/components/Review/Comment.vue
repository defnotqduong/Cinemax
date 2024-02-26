<template>
    <div class="flex items-start justify-start gap-7 mb-5">
        <div class="avatar">
            <div class="w-[50px] rounded-full">
                <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
            </div>
        </div>
        <div
            class="flex-1 py-4 pl-5 pr-7 bg-comment rounded-lg relative after:absolute after:content after:top-4 after:-left-2 after:border-t-[16px] after:border-t-transparent after:border-l-[16px] after:border-l-comment after:rotate-45"
        >
            <div class="flex flex-col text-secondary">
                <div class="mb-2">
                    <span class="font-bold text-white">Chris Curry</span> -
                    <span>1 Hour ago</span>
                </div>
                <p>whachikan Just noticed that someone categorized this as belonging to the genre "demons" LOL</p>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({})
</script>

<style></style>
