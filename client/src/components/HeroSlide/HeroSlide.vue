<template>
    <div class="relative mb-16">
        <div
            class="bg-cover bg-center bg-no-repeat absolute top-0 left-0 w-full h-full z-[-1] after:absolute after:content after:top-0 after:left-0 after:w-full after:h-full after:bg-overlay before:absolute before:content before:bottom-0 before:left-0 before:w-full before:h-[100px] before:bg-blur"
            :style="{
                backgroundImage: `url('https://rare-gallery.com/uploads/posts/400745-animegirl-wallpaper.png')`
            }"
        ></div>
        <div class="max-w-[1240px] mx-auto py-[160px]">
            <div class="flex items-center justify-center gap-6">
                <div class="flex-1 px-10">
                    <h3 class="text-[80px] font-bold text-white line-clamp-1">
                        The Seven Deadly Sins: Wrath of the Gods
                    </h3>
                    <p class="mt-10 text-white font-bold line-clamp-3">
                        Mười năm trước, "Cổng" xuất hiện và kết nối thế giới
                        thực với vương quốc ma thuật và quái vật. Để chiến đấu
                        với những con thú hèn hạ này, những người bình thường đã
                        nhận được sức mạnh siêu phàm và được gọi là "Thợ săn".
                    </p>
                    <div class="mt-10">
                        <Button :content="'Xem phim'" />
                    </div>
                </div>
                <div
                    class="w-[400px] h-[560px] rounded-3xl overflow-hidden shadow mr-10"
                >
                    <img
                        src="https://rare-gallery.com/uploads/posts/400745-animegirl-wallpaper.png"
                        alt="Poster"
                        class="w-full h-full object-cover object-center"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Button from '../Button/Button.vue'
export default defineComponent({
    components: { Button }
})
</script>

<style></style>
