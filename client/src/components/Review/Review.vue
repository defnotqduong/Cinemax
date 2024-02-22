<template>
    <div>
        <div class="mb-7 flex items-center justify-between">
            <h4
                class="text-xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
            >
                Bình luận
            </h4>
        </div>
        <div class="mb-16">
            <div v-for="i in 5" :key="i">
                <Comment />
            </div>
        </div>
        <div class="mb-7 flex items-center justify-between">
            <h4
                class="text-xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
            >
                Viết bình luận
            </h4>
        </div>
        <form action="">
            <textarea
                class="w-full min-h-[110px] resize-none bg-white rounded-md pt-4 pl-4 pr-1 pb-1 mb-6 text-black"
                placeholder="Bình luận của bạn"
            ></textarea>
            <button
                class="px-3 py-2 relative flex items-center justify-center gap-2 rounded bg-primary-alpha text-white text-sm font-semibold"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="14px"
                    height="14px"
                    viewBox="0 0 100 100"
                    aria-hidden="true"
                >
                    <path
                        d="M87.13 0a2.386 2.386 0 0 0-.64.088a2.386 2.386 0 0 0-.883.463L11.34 62.373a2.386 2.386 0 0 0 1.619 4.219l37.959-1.479l17.697 33.614a2.386 2.386 0 0 0 4.465-.707L89.486 2.79A2.386 2.386 0 0 0 87.131 0z"
                        fill="currentColor"
                        fill-rule="evenodd"
                    />
                </svg>
                Bình luận
            </button>
        </form>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Comment from './Comment.vue'

export default defineComponent({
    components: { Comment }
})
</script>

<style></style>
