<template>
    <div
        :class="{
            'bg-transparent h-[5.5rem]': !isScrolled,
            'bg-base-300 h-[4.5rem]': isScrolled
        }"
        class="fixed top-0 left-0 z-[9999] w-full transition-all duration-[400ms]"
    >
        <div
            class="navbar h-full justify-between max-w-[1240px] mx-auto py-0 font-medium text-white"
        >
            <div class="navbar-start w-auto">
                <div class="dropdown">
                    <div
                        tabindex="0"
                        role="button"
                        class="btn btn-ghost lg:hidden"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16"
                            />
                        </svg>
                    </div>
                    <ul
                        tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52"
                    >
                        <li>
                            <a>Home</a>
                        </li>
                        <li>
                            <a>Thể loại</a>
                            <ul class="p-2">
                                <li><a>Anime</a></li>
                                <li><a>Kinh dị</a></li>
                                <li><a>Viễn tưởng khoa học</a></li>
                            </ul>
                        </li>
                        <li><a>Quốc gia</a></li>
                        <li><a>Sắp chiếu</a></li>
                    </ul>
                </div>
                <router-link :to="{ name: 'home-homepage' }" class="w-[160px]"
                    ><img
                        src="../../assets/images/logo.png"
                        alt="Logo"
                        class="object-contain object-center w-full"
                /></router-link>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul
                    class="menu menu-horizontal px-1 gap-1 text-base font-semibold"
                >
                    <li>
                        <router-link
                            :to="{ name: 'home-homepage' }"
                            class="hover:bg-transparent hover:text-primary"
                            >Home</router-link
                        >
                    </li>
                    <li>
                        <div
                            class="dropdown dropdown-hover dropdown-bottom group hover:bg-transparent hover:text-primary"
                        >
                            <div tabindex="0" role="button">
                                Thể loại
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
                                class="dropdown-content grid grid-cols-3 z-[1] menu p-2 shadow bg-base-200 rounded-box w-[460px] max-h-[200px] overflow-y-auto before:w-0 text-white"
                            >
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'anime' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                    >
                                        <p class="line-clamp-1">
                                            Anime
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'kinh-di' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Kinh dị
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: {
                                                slug: 'khoa-hoc-vien-tuong'
                                            }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Khoa học viễn tưởng
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'gia-dinh' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Gia đình
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'chien-tranh' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Chiến tranh
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: {
                                                slug: 'du-hanh-thoi-gian'
                                            }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Du hành thời gian
                                        </p></router-link
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div
                            class="dropdown dropdown-hover dropdown-bottom group hover:bg-transparent hover:text-primary"
                        >
                            <div tabindex="0" role="button">
                                Năm sản xuất
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
                                class="dropdown-content grid grid-cols-3 z-[1] menu p-2 shadow bg-base-200 rounded-box w-[460px] max-h-[200px] overflow-y-auto before:w-0 text-white"
                            >
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'anime' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                    >
                                        <p class="line-clamp-1">
                                            Anime
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'kinh-di' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Kinh dị
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: {
                                                slug: 'khoa-hoc-vien-tuong'
                                            }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Khoa học viễn tưởng
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'gia-dinh' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Gia đình
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'chien-tranh' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Chiến tranh
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: {
                                                slug: 'du-hanh-thoi-gian'
                                            }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Du hành thời gian
                                        </p></router-link
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div
                            class="dropdown dropdown-hover dropdown-bottom group hover:bg-transparent hover:text-primary"
                        >
                            <div tabindex="0" role="button">
                                Quốc gia
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
                                class="dropdown-content grid grid-cols-3 z-[1] menu p-2 shadow bg-base-200 rounded-box w-[460px] max-h-[200px] overflow-y-auto before:w-0 text-white"
                            >
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'anime' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                    >
                                        <p class="line-clamp-1">
                                            Anime
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'kinh-di' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Kinh dị
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: {
                                                slug: 'khoa-hoc-vien-tuong'
                                            }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Khoa học viễn tưởng
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'gia-dinh' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Gia đình
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: { slug: 'chien-tranh' }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Chiến tranh
                                        </p></router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'home-category',
                                            params: {
                                                slug: 'du-hanh-thoi-gian'
                                            }
                                        }"
                                        class="hover:bg-transparent hover:text-primary"
                                        ><p class="line-clamp-1">
                                            Du hành thời gian
                                        </p></router-link
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class="hover:bg-transparent hover:text-primary"
                            >Sắp chiếu</a
                        >
                    </li>
                </ul>
            </div>
            <div
                class="navbar-end w-auto flex items-center justify-center gap-5"
            >
                <label
                    class="input bg-transparent input-bordered h-10 flex items-center gap-2 text-sm"
                >
                    <input type="text" class="grow" placeholder="Tìm kiếm" />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                        class="w-4 h-4 opacity-70"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </label>
                <router-link
                    :to="{ name: 'auth-login' }"
                    class="h-10 px-3 flex items-center justify-center border-[1px] border-primary rounded-lg text-primary hover:text-white hover:bg-primary transition-all duration-[400ms]"
                    >Đăng nhập</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
export default defineComponent({
    setup() {
        const isScrolled = ref(false)

        return { isScrolled }
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
    }
})
</script>

<style></style>
