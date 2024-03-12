<template>
    <div class="flex items-center justify-end gap-1 text-gray-600 text-sm font-medium">
        <button
            class="w-8 h-8 rounded-full hover:text-gray-400 transition-all duration-[400ms]"
            :class="{ 'btn-disabled opacity-60': meta.current_page === 1 }"
            @click="$emit('getData', meta.current_page - 1)"
        >
            «
        </button>
        <button
            v-if="meta.current_page >= 3"
            class="w-8 h-8 border-[1px] border-transparent rounded-full hover:text-gray-400 transition-all duration-[400ms]"
            @click="$emit('getData', 1)"
        >
            1
        </button>
        <button
            v-if="meta.current_page >= 4"
            class="w-8 h-8 btn-disabled opacity-60 border-[1px] border-transparent rounded-full hover:text-gray-400 transition-all duration-[400ms]"
        >
            ...
        </button>
        <button
            v-if="meta.current_page > 1"
            class="w-8 h-8 border-[1px] border-transparent rounded-full hover:text-gray-400 transition-all duration-[400ms]"
            @click="$emit('getData', meta.current_page - 1)"
        >
            {{ meta.current_page - 1 }}
        </button>
        <button class="w-8 h-8 text-white rounded bg-primary transition-all duration-[400ms]">
            {{ meta.current_page }}
        </button>
        <button
            v-if="meta.current_page < meta.last_page - 1"
            class="w-8 h-8 border-[1px] border-transparent rounded-full hover:text-gray-400 transition-all duration-[400ms]"
            @click="$emit('getData', meta.current_page + 1)"
        >
            {{ meta.current_page + 1 }}
        </button>
        <button
            v-if="meta.last_page - meta.current_page >= 3"
            class="w-8 h-8 btn-disabled opacity-60 border-[1px] border-transparent rounded-full hover:text-gray-400 transition-all duration-[400ms]"
        >
            ...
        </button>
        <button
            v-if="meta.current_page !== meta.last_page"
            class="w-8 h-8 border-[1px] border-transparent rounded-full hover:text-gray-400 transition-all duration-[400ms]"
            @click="$emit('getData', meta.last_page)"
        >
            {{ meta.last_page }}
        </button>
        <button
            class="w-8 h-8 rounded-full hover:text-gray-400 transition-all duration-[400ms]"
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
