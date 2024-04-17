<template>
    <div class="fixed top-0 left-0 bottom-0 overflow-y-auto">
        <ul class="menu bg-sideBar w-56 min-h-[100vh] pt-6 pb-16 px-3 font-semibold text-white gap-3 border-r-[1px] border-[#2e303e]">
            <div class="w-[160px]">
                <div class="uppercase text-3xl" style="font-family: 'Moonkids', sans-serif"><span class="text-white">CINE</span><span class="text-[#FF961B]">MAX</span></div>
            </div>
            <li v-for="(item, index) in menu" :key="index">
                <router-link v-if="item.items.length === 0" :to="{ name: item.link }" :class="{ active: isActive === item.active }">
                    <img :src="'./src/assets/icons/' + item.icon + '.svg'" :alt="item.name" />
                    {{ item.name }}</router-link
                >
                <details v-if="item.items.length > 0" :open="item.open">
                    <summary><img :src="'./src/assets/icons/' + item.icon + '.svg'" :alt="item.name" /> {{ item.name }}</summary>
                    <ul class="mt-1 flex flex-col gap-2">
                        <li v-for="(subItem, index) in item.items" :key="index">
                            <router-link :to="{ name: subItem.link }" :class="{ active: isActive === subItem.active }">
                                <img :src="'./src/assets/icons/' + subItem.icon + '.svg'" :alt="subItem.name" /> {{ subItem.name }}</router-link
                            >
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
export default defineComponent({
    setup() {
        const isActive = ref('')

        const menu = ref([
            { name: 'Dashboard', icon: 'dashboard', link: 'dashboard-homepage', active: '', open: false, items: [] },
            {
                name: 'Quản lý phim',
                icon: 'movie',
                link: 'dashboard-movie',
                active: 'movie',
                open: false,
                items: []
            },
            {
                name: 'Phân loại',
                icon: 'classify',
                open: false,
                items: [
                    {
                        name: 'Danh mục',
                        icon: 'catalog',
                        link: 'dashboard-homepage',
                        active: 'catalog'
                    },
                    {
                        name: 'Thể loại',
                        icon: 'category',
                        link: 'dashboard-category',
                        active: 'category'
                    },
                    { name: 'Khu vực', icon: 'region', link: 'dashboard-region', active: 'region' },
                    { name: 'Tags', icon: 'tags', link: 'dashboard-homepage', active: 'tags' },
                    { name: 'Đạo diễn', icon: 'director', link: 'dashboard-homepage', active: 'director' },
                    { name: 'Diễn viên', icon: 'actor', link: 'dashboard-homepage', active: 'actor' },
                    { name: 'Studio', icon: 'studio', link: 'dashboard-homepage', active: 'studio' }
                ]
            },
            {
                name: 'Tùy chỉnh',
                icon: 'custom',
                open: true,
                items: [
                    { name: 'Menu', icon: 'menu', link: 'dashboard-menu', active: 'menu' },
                    { name: 'Cài đặt', icon: 'settings', link: 'dashboard-homepage', active: 'settings' }
                ]
            },
            { name: 'Mở rộng', icon: 'extend', open: true, items: [{ name: 'Crawler Ophim', icon: 'crawler', link: 'dashboard-crawler', active: 'crawler' }] }
        ])

        return {
            isActive,
            menu
        }
    },
    watch: {
        $route(to, from) {
            this.setActiveRoute(to.path)
        }
    },
    created() {
        this.setActiveRoute(this.$route.path)
    },
    methods: {
        setActiveRoute(path) {
            switch (true) {
                case path.startsWith('/movie'):
                    this.isActive = 'movie'
                    break
                case path.startsWith('/catalog'):
                    this.isActive = 'catalog'
                    break
                case path.startsWith('/category'):
                    this.isActive = 'category'
                    break
                case path.startsWith('/region'):
                    this.isActive = 'region'
                    break
                case path.startsWith('/tags'):
                    this.isActive = 'tags'
                    break
                case path.startsWith('/director'):
                    this.isActive = 'director'
                    break
                case path.startsWith('/actor'):
                    this.isActive = 'actor'
                    break
                case path.startsWith('/studio'):
                    this.isActive = 'studio'
                    break
                case path.startsWith('/menu'):
                    this.isActive = 'menu'
                    break
                case path.startsWith('/settings'):
                    this.isActive = 'settings'
                    break
                case path.startsWith('/crawler'):
                    this.isActive = 'crawler'
                    break
                default:
                    this.isActive = ''
                    break
            }
        }
    }
})
</script>

<style></style>
