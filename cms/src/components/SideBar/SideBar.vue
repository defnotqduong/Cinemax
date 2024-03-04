<template>
    <div class="fixed top-0 left-0 h-[100vh] overflow-y-auto">
        <ul class="menu bg-base-200 w-[200px] min-h-[100vh] font-bold rounded-box py-8 gap-2">
            <div class="w-[140px] mb-4">
                <router-link :to="{ name: 'dashboard-homepage' }" class="w-full h-full block">
                    <img src="../../assets/images/logo.png" alt="Logo" class="w-full object-cover object-center" />
                </router-link>
            </div>
            <li>
                <details close>
                    <summary>Danh mục phim</summary>
                    <ul class="menu gap-2">
                        <li>
                            <router-link :to="{ name: 'dashboard-category' }">DS danh mục</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'dashboard-create-category' }">Thêm danh mục</router-link>
                        </li>
                    </ul>
                </details>
            </li>
            <li>
                <details close>
                    <summary>Thể loại phim</summary>
                    <ul class="menu gap-2">
                        <li>
                            <router-link :to="{ name: 'dashboard-genre' }">DS thể loại</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'dashboard-create-genre' }">Thêm thể loại</router-link>
                        </li>
                    </ul>
                </details>
            </li>
            <li>
                <details close>
                    <summary>Quốc gia phim</summary>
                    <ul class="menu gap-2">
                        <li>
                            <router-link :to="{ name: 'dashboard-country' }">DS quốc gia</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'dashboard-create-country' }">Thêm quốc gia</router-link>
                        </li>
                    </ul>
                </details>
            </li>
            <li>
                <details open>
                    <summary>Phim</summary>
                    <ul class="menu gap-2">
                        <li>
                            <router-link :to="{ name: 'dashboard-movie' }">DS phim</router-link>
                        </li>
                        <li>
                            <router-link
                                :to="{
                                    name: 'dashboard-create-movie'
                                }"
                                >Thêm phim</router-link
                            >
                        </li>
                        <li>
                            <router-link :to="{ name: 'dashboard-leech-movie' }">Leech phim</router-link>
                        </li>
                    </ul>
                </details>
            </li>
            <li>
                <details close>
                    <summary>Link phim</summary>
                    <ul class="menu gap-2">
                        <li>
                            <router-link :to="{ name: 'dashboard-link-movie' }">DS link phim</router-link>
                        </li>
                        <li>
                            <a>Thêm link phim</a>
                        </li>
                    </ul>
                </details>
            </li>
            <div class="mt-auto px-2">
                <div class="dropdown dropdown-top">
                    <div tabindex="0" role="button" class="flex items-center justify-start pl-4">
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </div>
                        </div>
                        <div class="pl-5 font-bold">Admin</div>
                    </div>
                    <ul tabindex="0" class="dropdown-content mb-2 z-[1] menu p-2 shadow bg-base-300 rounded-box w-[160px]">
                        <li>
                            <router-link :to="{ name: 'auth-login' }" class="font-bold">Logout</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </ul>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({})
</script>

<style></style>
