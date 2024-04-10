<template>
    <div class="min-h-[100vh]"></div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    created() {
        this.$router.push({ name: 'home-homepage' })
    }
})
</script>

<style></style>
