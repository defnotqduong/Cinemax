<template>
    <div>
        <div
            class="py-[200px] bg-cover bg-center bg-no-repeat"
            :style="{
                backgroundImage: `url('https://c.wallhere.com/photos/1a/29/portrait_anime_anime_girls_digital_art_artwork_2D-1946437.jpg!d')`
            }"
        >
            <div class="w-[35%] mx-auto">
                <form
                    class="py-8 px-10 rounded-xl border-[1px] border-bagde text-white backdrop-blur"
                >
                    <h4 class="text-3xl font-bold text-center mb-8">Đăng ký</h4>
                    <div
                        class="relative mb-6 px-4 rounded-full border-[1px] border-bagde"
                    >
                        <input
                            type="text"
                            id="email"
                            placeholder="Email"
                            class="w-full py-2 pr-6 bg-transparent outline-none"
                        />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            width="16px"
                            height="16px"
                            viewBox="0 0 24 24"
                            class="absolute right-4 top-1/2 -translate-y-1/2"
                        >
                            <path
                                d="M22,5V9L12,13,2,9V5A1,1,0,0,1,3,4H21A1,1,0,0,1,22,5ZM2,11.154V19a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V11.154l-10,4Z"
                            />
                        </svg>
                    </div>
                    <div
                        class="relative mb-6 px-4 rounded-full border-[1px] border-bagde"
                    >
                        <input
                            type="text"
                            id="username"
                            placeholder="Tên đăng nhập"
                            class="w-full py-2 pr-6 bg-transparent outline-none"
                        />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16px"
                            height="16px"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="absolute right-4 top-1/2 -translate-y-1/2"
                        >
                            <rect width="24" height="24" fill="transparent" />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M6 8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8C18 11.3137 15.3137 14 12 14C8.68629 14 6 11.3137 6 8Z"
                                fill="currentColor"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.43094 16.9025C7.05587 16.2213 9.2233 16 12 16C14.771 16 16.9351 16.2204 18.5586 16.8981C20.3012 17.6255 21.3708 18.8613 21.941 20.6587C22.1528 21.3267 21.6518 22 20.9592 22H3.03459C2.34482 22 1.84679 21.3297 2.0569 20.6654C2.62537 18.8681 3.69119 17.6318 5.43094 16.9025Z"
                                fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div
                        class="relative mb-6 px-4 rounded-full border-[1px] border-bagde"
                    >
                        <input
                            type="password"
                            id="password"
                            placeholder="Mật khẩu"
                            class="w-full py-2 pr-6 bg-transparent outline-none"
                        />
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
                    <div
                        class="relative mb-6 px-4 rounded-full border-[1px] border-bagde"
                    >
                        <input
                            type="password"
                            id="password_confirmation"
                            placeholder="Xác nhận mật khẩu"
                            class="w-full py-2 pr-6 bg-transparent outline-none"
                        />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16px"
                            height="16px"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="absolute right-4 top-1/2 -translate-y-1/2"
                        >
                            <path
                                d="M9.52513 4.52513C10.1815 3.86875 11.0717 3.5 12 3.5C12.9283 3.5 13.8185 3.86875 14.4749 4.52513C14.7873 4.83751 15.0344 5.20276 15.2078 5.59999L15.4078 6.05825C15.6287 6.56443 16.2181 6.79568 16.7243 6.57477L17.6408 6.17478C18.147 5.95387 18.3783 5.36445 18.1574 4.85827L17.9574 4.40001C17.6355 3.66243 17.1763 2.98389 16.5962 2.40381C15.3772 1.18482 13.7239 0.5 12 0.5C10.2761 0.5 8.62279 1.18482 7.40381 2.40381C6.18482 3.62279 5.5 5.27609 5.5 7V10H5C3.34315 10 2 11.3431 2 13V20C2 21.6569 3.34315 23 5 23H19C20.6569 23 22 21.6569 22 20V13C22 11.3431 20.6569 10 19 10H8.5V7C8.5 6.07174 8.86875 5.1815 9.52513 4.52513Z"
                                fill="currentColor"
                            />
                        </svg>
                    </div>
                    <button
                        class="w-full py-3 bg-white text-black font-bold rounded-full hover:bg-primary hover:text-white transition-all duration-[400ms]"
                    >
                        Đăng ký
                    </button>
                    <div class="mt-6 flex items-center justify-center gap-1">
                        <p>Bạn đã có tài khoản?</p>
                        <router-link
                            :to="{ name: 'auth-login' }"
                            class="font-bold hover:text-primary-alpha transition-all duration-200"
                            >Đăng nhập</router-link
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    mounted() {
        window.scrollTo({ top: 0 })
    }
})
</script>

<style></style>
