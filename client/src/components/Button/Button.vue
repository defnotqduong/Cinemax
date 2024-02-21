<template>
    <button
        class="px-10 py-[10px] bg-transparent rounded-full text-primary text-2xl font-bold border-2 border-primary hover:bg-primary hover:text-white transiton-all duration-[300ms]"
    >
        <span>{{ content }}</span>
    </button>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props: { content: '' }
})
</script>

<style></style>
