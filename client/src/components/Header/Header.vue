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
                <form class="input-container">
                    <input
                        type="text"
                        ref="input"
                        name="text"
                        v-model="searchText"
                        @input="handleDebouncedSearch"
                        class="input"
                        placeholder="Tìm kiếm phim..."
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" class="icon">
                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                        <g id="SVGRepo_iconCarrier">
                            <rect fill="white" height="24" width="24"></rect>
                            <path
                                fill=""
                                d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z"
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                            ></path>
                        </g>
                    </svg>
                    <ul
                        v-if="movies.length > 0"
                        class="absolute top-[50px] left-0 w-full max-h-[300px] overflow-y-auto custom-scrollbar bg-base-300 p-2 rounded-lg"
                    >
                        <li v-for="movie in movies" :key="movie.id" class="mb-2">
                            <div class="flex items-center justify-start">
                                <div class="mr-4 w-12">
                                    <router-link
                                        :to="{
                                            name: 'home-details',
                                            params: { slug: movie.slug }
                                        }"
                                        @click="handleInputSearch"
                                    >
                                        <img :src="movie.thumb_url" alt="thumb" class="w-full h-full object-cover object-center rounded-md" />
                                    </router-link>
                                </div>
                                <div class="flex-1">
                                    <h5 class="mr-4 text-white text-base font-semibold cursor-pointer line-clamp-1">
                                        <router-link
                                            :to="{
                                                name: 'home-details',
                                                params: { slug: movie.slug }
                                            }"
                                            @click="handleInputSearch"
                                        >
                                            {{ movie.name }}
                                        </router-link>
                                    </h5>
                                    <h6 class="mt-1 text-sm line-clamp-1">{{ movie.origin_name }}</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
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
import { searchMovie } from '../../webServices/movieService'
export default defineComponent({
    props: {},
    setup() {
        const homeStore = useHomeStore()

        const isScrolled = ref(false)

        const searchText = ref('')
        const movies = ref([])
        const debounceTimeout = ref(null)

        return { isScrolled, searchText, homeStore, movies, debounceTimeout }
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
        },
        handleDebouncedSearch() {
            clearTimeout(this.debounceTimeout)
            this.debounceTimeout = setTimeout(() => {
                this.searchMovies(this.searchText)
            }, 500)
        },
        async searchMovies(searchText) {
            this.movies = []
            if (searchText.trim() !== '') {
                const movies = await searchMovie({ searchText: searchText })
                this.movies = [...movies.movies]
            }
        },
        handleInputSearch() {
            this.searchText = ''
            this.movies = []
        }
    },
    computed: {}
})
</script>

<style scoped>
.input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.input {
    width: 24px;
    height: 24px;
    border-radius: 20px;
    border: none;
    outline: none;
    padding: 18px 16px;
    color: rgb(58, 57, 57);
    background-color: transparent;
    cursor: pointer;
    transition: all 0.5s ease-in-out;
}

.input::placeholder {
    color: transparent;
    font-size: 14px;
}

.input:focus::placeholder {
    color: rgb(131, 128, 128);
}

.input:focus,
.input:not(:placeholder-shown) {
    background-color: #fff;
    border: 1px solid rgb(91, 107, 255);
    width: 280px;
    cursor: default;
    padding: 18px 16px 18px 50px;
}

.icon {
    position: absolute;
    left: 0;
    height: 40px;
    width: 40px;
    background-color: #fff;
    border-radius: 99px;
    z-index: -1;
    fill: rgb(91, 107, 255);
    border: 1px solid rgb(91, 107, 255);
}

.input:focus + .icon,
.input:not(:placeholder-shown) + .icon {
    z-index: 0;
    background-color: transparent;
    border: none;
    cursor: pointer;
}
</style>
