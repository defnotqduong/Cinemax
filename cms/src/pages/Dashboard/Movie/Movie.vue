<template>
    <div class="py-20 mr-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">Danh sách Phim:</h3>
            <button
                class="px-3 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
            >
                <router-link
                    :to="{
                        name: 'dashboard-create-category'
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
        <div class="max-w-[100vw] overflow-x-auto">
            <div v-if="!loading" class="overflow-x-auto mt-10 w-[120vw]">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Thumnail Phim</th>
                            <th>Tên phim</th>
                            <th>Tên T.Anh</th>
                            <th>Năm SX</th>
                            <th>Slug</th>
                            <th>Danh mục</th>
                            <th>Thể loại</th>
                            <th>Quốc gia</th>
                            <th>Mô tả phim</th>
                            <th>Thời lượng</th>
                            <th>Số tập</th>
                            <th>Độ P.Giải</th>
                            <th>Phụ đề</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(movie, index) in movies" :key="movie.id">
                            <th>{{ index + 1 }}</th>
                            <td>
                                <img
                                    :src="movie.thumbnail"
                                    alt="thumbnail"
                                    class="w-20 h-24 object-cover object-center rounded"
                                />
                            </td>
                            <td>
                                <p class="line-clamp-3">{{ movie.title }}</p>
                            </td>
                            <td>
                                <p class="line-clamp-3">{{ movie.name_eng }}</p>
                            </td>
                            <td>
                                <p class="line-clamp-3">{{ movie.year }}</p>
                            </td>
                            <td>
                                <p class="line-clamp-3">{{ movie.slug }}</p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ movie.category_title }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ movie.genre_title }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ movie.country_title }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ movie.description }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">{{ movie.duration }}</p>
                            </td>
                            <td>
                                <p class="line-clamp-3">{{ movie.eps }}</p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ getResolutionText(movie.resolution) }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{
                                        movie.subtitle == 1
                                            ? 'Vietsub'
                                            : 'Thuyết minh'
                                    }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ movie.status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                </p>
                            </td>
                            <td
                                class="px-2 py-1 flex flex-col items-center justify-center gap-3"
                            >
                                <button
                                    class="text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
                                >
                                    <router-link
                                        :to="{
                                            name: 'dashboard-edit-category',
                                            params: {
                                                slug: movie.slug
                                            }
                                        }"
                                        class="w-full h-full px-3 py-2 block"
                                    >
                                        Sửa
                                    </router-link>
                                </button>
                                <label
                                    :for="'modal_delete_' + movie.id"
                                    class="px-3 py-2 text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                    >Xóa</label
                                >
                                <input
                                    type="checkbox"
                                    :id="'modal_delete_' + movie.id"
                                    class="modal-toggle"
                                />
                                <div class="modal" role="dialog">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">
                                            Xác nhận!
                                        </h3>
                                        <p class="py-4">
                                            Xóa phim
                                            <span class="font-bold">{{
                                                movie.title
                                            }}</span>
                                        </p>
                                        <div class="modal-action">
                                            <label
                                                @click="deleteCat(movie.id)"
                                                :for="
                                                    'modal_delete_' + movie.id
                                                "
                                                class="btn text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                            >
                                                Xóa
                                            </label>
                                            <label
                                                :for="
                                                    'modal_delete_' + movie.id
                                                "
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
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { getAllMovie, deleteMovie } from '../../../webServices/movieService'

export default defineComponent({
    setup() {
        const movies = ref([])
        const loading = ref(false)

        const getMovieList = async () => {
            loading.value = true
            const data = await getAllMovie()
            movies.value = data.movies.data
            loading.value = false
        }

        const deleteMov = async id => {
            const data = await deleteMovie(id)
            if (data.success) {
                getMovieList()
            }
        }

        getMovieList()

        return { loading, movies, deleteMov }
    },
    methods: {
        getResolutionText(resolution) {
            switch (resolution) {
                case 0:
                    return 'FullHD'
                case 1:
                    return 'HD'
                case 2:
                    return 'SD'
                case 3:
                    return 'HDCam'
                case 4:
                    return 'Cam'
                case 5:
                    return 'Trailer'
                default:
                    return ''
            }
        }
    }
})
</script>

<style></style>
