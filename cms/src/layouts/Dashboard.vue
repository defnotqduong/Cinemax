<template>
    <div class="relative">
        <SideBar />
        <div class="ml-[225px]">
            <Header />
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { useRouter } from 'vue-router'
import { defineComponent } from 'vue'
import Header from '../components/Header/Header.vue'
import SideBar from '../components/SideBar/SideBar.vue'
export default defineComponent({
    components: { SideBar, Header },
    set() {
        const router = useRouter()

        router.push({ name: 'dashboard-homepage' })
    }
})
</script>

<style></style>
