<template>
    <div class="py-20">
        <h3 class="text-2xl font-bold mb-10">Thêm Phim:</h3>
        <div
            class="w-[50%] px-4 py-2 mb-3 mx-auto text-center text-lg font-semibold text-white bg-green-400 rounded-md"
            v-if="success"
        >
            Thêm thành công
        </div>
        <form
            class="w-[100%] mx-auto px-8 grid grid-cols-2 gap-x-6"
            @submit.prevent="create"
        >
            <div class="block mb-6">
                <div class="text-lg font-semibold mb-3">Thumbnail:</div>
                <label
                    class="w-[50%] h-[300px] flex items-center justify-center relative mx-auto border-[1px] border-[#6793fa] rounded-md overflow-hidden cursor-pointer"
                    for="thumbnail"
                >
                    <!-- <img
                        src="https://rare-gallery.com/uploads/posts/400745-animegirl-wallpaper.png"
                        alt="Thumbnail"
                    /> -->
                    <span
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[-1]"
                        >Upload Image</span
                    >
                </label>
                <input
                    id="thumbnail"
                    type="file"
                    placeholder="Hình ảnh"
                    class="input input-bordered h-10 input-secondary hidden"
                />
                <div
                    v-if="errors && errors.thumbnail"
                    class="mt-2 text-primary"
                >
                    {{ errors.thumbnail[0] }}
                </div>
            </div>
            <div>
                <label for="title" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Tiều đề:</div>
                    <input
                        id="title"
                        type="text"
                        v-model="title"
                        placeholder="Tiêu đề"
                        class="input input-bordered h-10 input-secondary w-full"
                    />
                    <div
                        v-if="errors && errors.title"
                        class="mt-2 text-primary"
                    >
                        {{ errors.title[0] }}
                    </div>
                </label>
                <label for="name_eng" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Tên tiếng anh:</div>
                    <input
                        id="name_eng"
                        type="text"
                        v-model="name_eng"
                        placeholder="Tên tiếng anh"
                        class="input input-bordered h-10 input-secondary w-full"
                    />
                    <div
                        v-if="errors && errors.name_eng"
                        class="mt-2 text-primary"
                    >
                        {{ errors.name_eng[0] }}
                    </div>
                </label>
                <label for="season" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Season:</div>
                    <input
                        id="season"
                        type="text"
                        v-model="season"
                        placeholder="Season"
                        class="input input-bordered h-10 input-secondary w-full"
                    />
                    <div
                        v-if="errors && errors.season"
                        class="mt-2 text-primary"
                    >
                        {{ errors.season[0] }}
                    </div>
                </label>
                <label for="eps" class="block mb-6">
                    <div class="text-lg font-semibold mb-3">Số tập phim:</div>
                    <input
                        id="eps"
                        type="text"
                        v-model="eps"
                        placeholder="Số tập phim"
                        class="input input-bordered h-10 input-secondary w-full"
                    />
                    <div v-if="errors && errors.eps" class="mt-2 text-primary">
                        {{ errors.eps[0] }}
                    </div>
                </label>
            </div>
            <label for="year" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Năm sản xuất:</div>
                <input
                    id="year"
                    type="text"
                    v-model="year"
                    placeholder="Năm sản xuất"
                    class="input input-bordered h-10 input-secondary w-full"
                />
                <div v-if="errors && errors.year" class="mt-2 text-primary">
                    {{ errors.year[0] }}
                </div>
            </label>
            <label for="duration" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Thời lượng phim:</div>
                <input
                    id="duration"
                    type="text"
                    v-model="duration"
                    placeholder="Thời lượng phim"
                    class="input input-bordered h-10 input-secondary w-full"
                />
                <div v-if="errors && errors.duration" class="mt-2 text-primary">
                    {{ errors.duration[0] }}
                </div>
            </label>
            <label for="resolution" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Độ phân giải:</div>
                <select
                    class="select select-secondary w-full h-10"
                    id="resolution"
                    v-model="resolution"
                >
                    <option value="0">FullHD</option>
                    <option value="1">HD</option>
                    <option value="2">SD</option>
                    <option value="3">HDCam</option>
                    <option value="4">Cam</option>
                    <option value="5">Trailer</option>
                </select>
                <div
                    v-if="errors && errors.resolution"
                    class="mt-2 text-primary"
                >
                    {{ errors.resolution[0] }}
                </div>
            </label>
            <label for="subtitle" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Phụ đề:</div>
                <select
                    class="select select-secondary w-full h-10"
                    id="subtitle"
                    v-model="subtitle"
                >
                    <option value="1">Vietsub</option>
                    <option value="0">Thuyết minh</option>
                </select>
                <div v-if="errors && errors.subtitle" class="mt-2 text-primary">
                    {{ errors.subtitle[0] }}
                </div>
            </label>
            <label for="category_id" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Danh mục:</div>
                <select
                    class="select select-secondary w-full h-10"
                    id="category_id"
                    v-model="category_id"
                >
                    <option value="0">Phim bộ</option>
                    <option value="1">Phim lẻ</option>
                </select>
                <div
                    v-if="errors && errors.category_id"
                    class="mt-2 text-primary"
                >
                    {{ errors.category_id[0] }}
                </div>
            </label>
            <label for="genre_id" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Thể loại:</div>
                <select
                    class="select select-secondary w-full h-10"
                    id="genre_id"
                    v-model="genre_id"
                >
                    <option value="0">Hành động</option>
                    <option value="1">Gia đình</option>
                </select>
                <div v-if="errors && errors.genre_id" class="mt-2 text-primary">
                    {{ errors.genre_id[0] }}
                </div>
            </label>
            <label for="country_id" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Quốc gia:</div>
                <select
                    class="select select-secondary w-full h-10"
                    id="country_id"
                    v-model="country_id"
                >
                    <option value="0">Nhật bản</option>
                    <option value="1">Hàn quốc</option>
                </select>
                <div
                    v-if="errors && errors.country_id"
                    class="mt-2 text-primary"
                >
                    {{ errors.country_id[0] }}
                </div>
            </label>
            <label for="status" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Trạng thái:</div>
                <select
                    class="select select-secondary w-full h-10"
                    id="status"
                    v-model="status"
                >
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
                <div v-if="errors && errors.status" class="mt-2 text-primary">
                    {{ errors.status[0] }}
                </div>
            </label>
            <label for="description" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Mô tả:</div>
                <textarea
                    v-model="description"
                    class="min-h-[200px] textarea textarea-secondary w-full resize-none"
                    placeholder="Mô tả"
                ></textarea>
                <div
                    v-if="errors && errors.description"
                    class="mt-2 text-primary"
                >
                    {{ errors.description[0] }}
                </div>
            </label>
            <label for="tags" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Từ khóa:</div>
                <textarea
                    v-model="tags"
                    class="textarea min-h-[200px] textarea-secondary w-full resize-none"
                    placeholder="Từ khóa"
                ></textarea>
                <div v-if="errors && errors.tags" class="mt-2 text-primary">
                    {{ errors.tags[0] }}
                </div>
            </label>
            <button
                class="px-6 py-2 w-24 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
            >
                <span
                    v-if="loading"
                    class="loading loading-spinner text-white"
                ></span>
                <span v-if="!loading">Thêm</span>
            </button>
        </form>
    </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue'
import { createGenre } from '../../../webServices/genreService'
export default defineComponent({
    setup() {
        const genre = reactive({
            title: '',
            name_eng: '',
            description: '',
            season: '',
            eps: null,
            year: '',
            duration: '',
            resolution: 0,
            subtitle: 1,
            category_id: null,
            genre_id: null,
            country_id: null,
            tags: '',
            status: 1
        })

        const errors = ref([])
        const success = ref(false)
        const loading = ref(false)

        const create = async () => {
            loading.value = true
            const data = await createGenre(genre)
            if (data.success) {
                success.value = true
                errors.value = []
                loading.value = false
                setTimeout(() => {
                    success.value = false
                }, 2000)
                genre.title = ''
                genre.description = ''
                genre.status = 1
            } else {
                errors.value = data.data.errors
                loading.value = false
            }
        }

        return {
            ...toRefs(genre),
            create,
            success,
            errors,
            loading
        }
    }
})
</script>

<style></style>
