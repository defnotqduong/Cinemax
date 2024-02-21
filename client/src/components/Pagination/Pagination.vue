<template>
    <div
        class="flex items-center justify-start text-secondary gap-1 text-base font-medium"
    >
        <button
            class="w-12 h-12 rounded-full hover:text-white transition-all duration-[400ms]"
        >
            «
        </button>
        <button
            class="w-12 h-12 border-[1px] border-white rounded-full hover:text-white transition-all duration-[400ms]"
            :class="{ 'text-white border-white': 1 }"
        >
            1
        </button>
        <button
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
        >
            2
        </button>
        <button
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
        >
            3
        </button>
        <button
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
        >
            4
        </button>
        <button
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
        >
            5
        </button>
        <button
            class="w-12 h-12 rounded-full hover:text-white transition-all duration-[400ms]"
        >
            »
        </button>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({})
</script>

<style></style>
