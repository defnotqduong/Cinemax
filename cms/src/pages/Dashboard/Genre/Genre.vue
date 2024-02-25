<template>
    <div class="py-20 mr-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">Thể loại:</h3>
            <button
                class="px-3 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
            >
                <router-link
                    :to="{
                        name: 'dashboard-create-genre'
                    }"
                    class="w-full h-full block"
                >
                    Thêm mới
                </router-link>
            </button>
        </div>
        <div
            class="w-full flex items-center justify-center min-h-[50vh]"
            v-if="loading"
        >
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading" class="overflow-x-auto mt-10">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Thể loại</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(genre, index) in genres" :key="genre.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ genre.title }}</td>
                        <td>{{ genre.slug }}</td>
                        <td>{{ genre.description }}</td>
                        <td>
                            {{ genre.status == 1 ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td class="flex items-center justify-center gap-3">
                            <button
                                class="text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
                            >
                                <router-link
                                    :to="{
                                        name: 'dashboard-edit-genre',
                                        params: {
                                            slug: genre.slug
                                        }
                                    }"
                                    class="w-full h-full px-3 py-2 block"
                                >
                                    Sửa
                                </router-link>
                            </button>
                            <label
                                :for="'modal_delete_' + genre.id"
                                class="px-3 py-2 text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                >Xóa</label
                            >
                            <input
                                type="checkbox"
                                :id="'modal_delete_' + genre.id"
                                class="modal-toggle"
                            />
                            <div class="modal" role="dialog">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Xác nhận!</h3>
                                    <p class="py-4">
                                        Xóa thể loại
                                        <span class="font-bold">{{
                                            genre.title
                                        }}</span>
                                    </p>
                                    <div class="modal-action">
                                        <label
                                            @click="deleteGen(genre.id)"
                                            :for="'modal_delete_' + genre.id"
                                            class="btn text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                        >
                                            Xóa
                                        </label>
                                        <label
                                            :for="'modal_delete_' + genre.id"
                                            class="btn"
                                            >Hủy!</label
                                        >
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { getAllGenre, deleteGenre } from '../../../webServices/genreService'

export default defineComponent({
    setup() {
        const genres = ref([])
        const loading = ref(false)

        const getGenreList = async () => {
            loading.value = true
            const data = await getAllGenre()
            console.log(data)
            genres.value = data.genres.data
            loading.value = false
        }

        const deleteGen = async id => {
            const data = await deleteGenre(id)
            if (data.success) {
                getGenreList()
            }
        }

        getGenreList()

        return { loading, genres, deleteGen }
    }
})
</script>

<style></style>
