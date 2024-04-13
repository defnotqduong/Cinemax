<template>
    <div
        :class="{
            'bg-transparent h-[6.5rem]': !isScrolled,
            'bg-base-300 h-[4.5rem]': isScrolled
        }"
        class="fixed top-0 left-0 z-[9999] w-full transition-all duration-[400ms]"
    >
        <div class="navbar h-full justify-between max-w-[1220px] mx-auto py-0 font-medium text-white">
            <div class="navbar-start w-auto mr-20">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                </div>
                <router-link :to="{ name: 'home-homepage' }" class="w-[160px]">
                    <div class="uppercase text-3xl" style="font-family: 'Moonkids', sans-serif">
                        <span class="text-white">CINE</span><span class="text-primary">MAX</span>
                    </div>
                </router-link>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 gap-1 text-base font-semibold">
                    <li v-for="item in homeStore.menu" :key="item.id">
                        <router-link
                            :to="item.link"
                            v-if="item.children.length === 0"
                            class="hover:bg-transparent hover:text-primary focus:bg-transparent focus-within:bg-transparent focus:text-white focus-within:text-white"
                            >{{ item.name }}</router-link
                        >
                        <div v-if="item.children.length > 0" class="dropdown dropdown-hover dropdown-bottom group hover:bg-transparent hover:text-primary">
                            <div tabindex="0" role="button">
                                {{ item.name }}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18px"
                                    height="18px"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    class="inline-block group-hover:rotate-180 transition-all duration-[350ms]"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </div>
                            <ul
                                tabindex="0"
                                class="dropdown-content grid grid-cols-3 z-[1] menu p-2 shadow bg-base-200 rounded-box w-[460px] max-h-[200px] overflow-y-auto before:w-0 text-white custom-scrollbar"
                            >
                                <li v-for="subItem in item.children" :key="subItem.id">
                                    <router-link :to="subItem.link" class="hover:bg-transparent hover:text-primary">
                                        <p class="line-clamp-1">{{ subItem.name }}</p></router-link
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="navbar-end flex items-center justify-end gap-2">
                <!-- <label class="input input-bordered rounded-full bg-transparent text-white h-10 flex items-center gap-2">
                    <input type="text" class="grow" placeholder="Tìm kiếm" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5">
                        <path
                            fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </label> -->
                <label class="relative flex items-center justify-center h-9 transition-all duration-[400ms] ease" :class="isChecked ? 'w-[280px]' : 'w-9'">
                    <input type="checkbox" v-model="isChecked" class="hidden" />
                    <div
                        class="w-9 h-9 absolute top-0 left-0 z-10 bg-primary text-white flex items-center justify-center cursor-pointer border-[1px] border-primary"
                        :class="isChecked ? 'rounded-l-full' : 'rounded-full'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5">
                            <path
                                fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <input
                        type="text"
                        v-model="searchText"
                        class="bg-white rounded-full focus:border-none focus:outline-none absolute w-full h-full text-black placeholder:text-sm transition-all duration-[400ms] ease"
                        :class="isChecked ? 'pr-4 pl-12' : 'p-0'"
                        placeholder="Tìm kiếm"
                    />
                </label>
                <!-- <router-link :to="{ name: 'auth-login' }" class="h-10 px-4 flex items-center justify-center rounded-full text-white text-sm bg-primary"
                    >Log in</router-link
                > -->
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { useHomeStore } from '../../stores/modules/homeStore'
export default defineComponent({
    props: {},
    setup() {
        const homeStore = useHomeStore()

        const isScrolled = ref(false)

        const isChecked = ref(false)

        const searchText = ref('')

        return { isScrolled, isChecked, searchText, homeStore }
    },
    mounted() {
        window.addEventListener('scroll', this.shrinkHeader)
    },
    destroyed() {
        window.removeEventListener('scroll', this.shrinkHeader)
    },
    methods: {
        shrinkHeader() {
            if (window.scrollY > 80) {
                this.isScrolled = true
            } else {
                this.isScrolled = false
            }
        }
    },
    computed: {}
})
</script>

<style></style>
