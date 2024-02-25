<template>
    <div class="fixed top-0 left-0 h-[100vh] overflow-y-auto">
        <ul
            class="menu bg-base-200 w-[200px] min-h-[100vh] font-bold rounded-box py-8 gap-2"
        >
            <div class="w-[140px] mb-4">
                <img
                    src="../../assets/images/logo.png"
                    alt="Logo"
                    class="w-full object-cover object-center"
                />
            </div>
            <li>
                <router-link :to="{ name: 'dashboard-category' }"
                    >Danh mục</router-link
                >
            </li>
            <li>
                <router-link :to="{ name: 'dashboard-genre' }"
                    >Thể loại</router-link
                >
            </li>
            <li>
                <router-link :to="{ name: 'dashboard-country' }"
                    >Quốc gia</router-link
                >
            </li>
            <li>
                <details open>
                    <summary>Phim</summary>
                    <ul>
                        <li>
                            <router-link :to="{ name: 'dashboard-movie' }"
                                >Phim</router-link
                            >
                        </li>
                        <li><a>Tập phim</a></li>
                    </ul>
                </details>
            </li>
            <div class="mt-auto px-2">
                <div class="dropdown dropdown-top">
                    <div
                        tabindex="0"
                        role="button"
                        class="flex items-center justify-start pl-4"
                    >
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img
                                    src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"
                                />
                            </div>
                        </div>
                        <div class="pl-5 font-bold">Admin</div>
                    </div>
                    <ul
                        tabindex="0"
                        class="dropdown-content mb-2 z-[1] menu p-2 shadow bg-base-300 rounded-box w-[160px]"
                    >
                        <li>
                            <router-link
                                :to="{ name: 'auth-login' }"
                                class="font-bold"
                                >Logout</router-link
                            >
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
