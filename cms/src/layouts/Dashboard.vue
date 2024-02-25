<template>
    <div class="relative">
        <SideBar />
        <div class="ml-[220px]">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import SideBar from '../components/SideBar/SideBar.vue'
export default defineComponent({
    components: { SideBar }
})
</script>

<style></style>
