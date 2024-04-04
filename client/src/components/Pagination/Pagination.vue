<template>
    <div class="flex items-center justify-center text-secondary gap-1 text-base font-medium">
        <button
            class="w-12 h-12 rounded-full hover:text-white transition-all duration-[400ms]"
            :class="{ 'btn-disabled opacity-60': meta.current_page === 1 }"
            @click="$emit('getData', meta.current_page - 1)"
        >
            «
        </button>
        <button
            v-if="meta.current_page >= 3"
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
            @click="$emit('getData', 1)"
        >
            1
        </button>
        <button
            v-if="meta.current_page >= 4"
            class="w-12 h-12 btn-disabled opacity-60 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
        >
            ...
        </button>
        <button
            v-if="meta.current_page > 1"
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
            @click="$emit('getData', meta.current_page - 1)"
        >
            {{ meta.current_page - 1 }}
        </button>
        <button class="w-12 h-12 border-[1px] btn-disabled border-white text-white rounded-full hover:text-white transition-all duration-[400ms]">
            {{ meta.current_page }}
        </button>
        <button
            v-if="meta.current_page < meta.last_page - 1"
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
            @click="$emit('getData', meta.current_page + 1)"
        >
            {{ meta.current_page + 1 }}
        </button>
        <button
            v-if="meta.last_page - meta.current_page >= 3"
            class="w-12 h-12 btn-disabled opacity-60 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
        >
            ...
        </button>
        <button
            v-if="meta.current_page !== meta.last_page"
            class="w-12 h-12 border-[1px] border-transparent rounded-full hover:text-white transition-all duration-[400ms]"
            @click="$emit('getData', meta.last_page)"
        >
            {{ meta.last_page }}
        </button>
        <button
            class="w-12 h-12 rounded-full hover:text-white transition-all duration-[400ms]"
            :class="{ 'btn-disabled opacity-60': meta.current_page === meta.last_page }"
            @click="$emit('getData', meta.current_page + 1)"
        >
            »
        </button>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props: { meta: Object, links: Object, getData: Function }
})
</script>

<style></style>
