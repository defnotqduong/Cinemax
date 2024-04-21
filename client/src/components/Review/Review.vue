<template>
    <div>
        <div class="mb-7 flex items-center justify-between">
            <h4
                class="text-xl font-bold uppercase text-white pl-3 relative after:absolute after:content after:top-0 after:left-0 after:h-full after:w-1 after:rounded-md after:bg-primary"
            >
                Bình luận
            </h4>
        </div>
        <form @submit.prevent="">
            <textarea
                class="w-full min-h-[110px] resize-none bg-white rounded-md pt-4 pl-4 pr-1 pb-1 mb-6 text-black"
                placeholder="Bình luận của bạn"
            ></textarea>
            <button class="bg-secondary text-white">
                <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path
                                fill="currentColor"
                                d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                            ></path>
                        </svg>
                    </div>
                </div>
                <span>Bình luận</span>
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

<style scoped>
button {
    font-family: inherit;
    font-size: 15px;
    padding: 0.6em 1em;
    padding-left: 0.9em;
    display: flex;
    align-items: center;
    border: none;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.2s;
    cursor: pointer;
}

button span {
    display: block;
    margin-left: 0.3em;
    transition: all 0.4s ease-in-out;
}

button svg {
    display: block;
    transform-origin: center center;
    transition: transform 0.4s ease-in-out;
}

button:hover .svg-wrapper {
    animation: fly-1 0.6s ease-in-out infinite alternate;
}

button:hover svg {
    transform: translateX(2em) rotate(45deg) scale(1.1);
}

button:hover span {
    transform: translateX(6em);
}

button:active {
    transform: scale(0.95);
}

@keyframes fly-1 {
    from {
        transform: translateY(0.1em);
    }

    to {
        transform: translateY(-0.1em);
    }
}
</style>
