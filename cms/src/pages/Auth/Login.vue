<template>
    <div>
        <div
            class="container min-h-[100vh] mx-auto py-[220px] bg-cover bg-center bg-no-repeat"
            :style="{
                backgroundImage: `url('https://c.wallhere.com/photos/1a/29/portrait_anime_anime_girls_digital_art_artwork_2D-1946437.jpg!d')`
            }"
        >
            <div class="w-[35%] mx-auto">
                <form class="py-8 px-10 rounded-xl border-[1px] border-bagde text-white backdrop-blur">
                    <h4 class="text-3xl font-bold text-center mb-8">Đăng nhập</h4>
                    <div class="relative mb-6 px-4 rounded-full border-[1px] border-bagde">
                        <input type="text" id="email" v-model="email" placeholder="Email" class="w-full py-2 pr-6 bg-transparent outline-none" />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            width="16px"
                            height="16px"
                            viewBox="0 0 24 24"
                            class="absolute right-4 top-1/2 -translate-y-1/2"
                        >
                            <path d="M22,5V9L12,13,2,9V5A1,1,0,0,1,3,4H21A1,1,0,0,1,22,5ZM2,11.154V19a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V11.154l-10,4Z" />
                        </svg>
                    </div>
                    <div class="relative mb-6 px-4 rounded-full border-[1px] border-bagde">
                        <input type="password" id="password" v-model="password" placeholder="Mật khẩu" class="w-full py-2 pr-6 bg-transparent outline-none" />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16px"
                            height="16px"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="absolute right-4 top-1/2 -translate-y-1/2"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.5 10V7C5.5 5.27609 6.18482 3.62279 7.40381 2.40381C8.62279 1.18482 10.2761 0.5 12 0.5C13.7239 0.5 15.3772 1.18482 16.5962 2.40381C17.8152 3.62279 18.5 5.27609 18.5 7V10H19C20.6569 10 22 11.3431 22 13V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V13C2 11.3431 3.34315 10 5 10H5.5ZM9.52513 4.52513C10.1815 3.86875 11.0717 3.5 12 3.5C12.9283 3.5 13.8185 3.86875 14.4749 4.52513C15.1313 5.1815 15.5 6.07174 15.5 7V10H8.5V7C8.5 6.07174 8.86875 5.1815 9.52513 4.52513Z"
                                fill="currentColor"
                            />
                        </svg>
                    </div>
                    <!-- <div class="flex items-center justify-end mr-1 mb-4">
                        <a
                            class="hover:text-primary transition-all duration-200"
                            >Quên mật khẩu?</a
                        >
                    </div> -->
                    <button
                        class="w-full py-3 bg-white text-black font-bold rounded-full hover:bg-primary hover:text-white transition-all duration-[400ms]"
                        @click="login"
                    >
                        Đăng nhập
                    </button>
                    <!-- <div class="mt-6 flex items-center justify-center gap-1">
                        <p>Bạn chưa có tài khoản?</p>
                        <a
                            class="font-bold hover:text-primary-alpha transition-all duration-200"
                            >Đăng ký</a
                        >
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'

import { loginUser } from '../../webServices/authorizationService'
import { localEnUserStore } from '../../configs/connectServer'

export default defineComponent({
    setup() {
        const email = ref('')
        const password = ref('')
        const router = useRouter()

        const login = async e => {
            e.preventDefault()

            const data = await loginUser({
                email: email.value,
                password: password.value
            })

            if (data.success) {
                localEnUserStore(data.access_token)

                router.push({ name: 'dashboard-homepage' })
            }
        }

        return {
            email,
            password,
            login
        }
    },
    methods: {},
    mounted() {
        window.scrollTo({ top: 0 })
    }
})
</script>

<style></style>
