<template>
    <div class="py-20 mr-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">Danh sách Phim:</h3>
            <button class="px-3 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300">
                <router-link
                    :to="{
                        name: 'dashboard-create-movie'
                    }"
                    class="w-full h-full block"
                >
                    Thêm mới
                </router-link>
            </button>
        </div>
        <div class="w-full flex items-center justify-center min-h-[50vh]" v-if="loading">
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
                            <th>DS Phim</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(movie, index) in movies" :key="movie.id">
                            <th>{{ index + 1 }}</th>
                            <td>
                                <img :src="movie.thumbnail" alt="thumbnail" class="w-20 h-24 object-cover object-center rounded" />
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
                                    {{ movie.subtitle == 1 ? 'Vietsub' : 'Thuyết minh' }}
                                </p>
                            </td>
                            <td>
                                <p class="line-clamp-3">
                                    {{ movie.status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                </p>
                            </td>
                            <td>
                                <div class="flex flex-col items-center justify-center">
                                    <button class="text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300">
                                        <router-link
                                            :to="{
                                                name: 'dashboard-movie-episode',
                                                params: {
                                                    id: movie.id
                                                }
                                            }"
                                            class="w-full h-full px-3 py-2 block"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M8 6.00067L21 6.00139M8 12.0007L21 12.0015M8 18.0007L21 18.0015M3.5 6H3.51M3.5 12H3.51M3.5 18H3.51M4 6C4 6.27614 3.77614 6.5 3.5 6.5C3.22386 6.5 3 6.27614 3 6C3 5.72386 3.22386 5.5 3.5 5.5C3.77614 5.5 4 5.72386 4 6ZM4 12C4 12.2761 3.77614 12.5 3.5 12.5C3.22386 12.5 3 12.2761 3 12C3 11.7239 3.22386 11.5 3.5 11.5C3.77614 11.5 4 11.7239 4 12ZM4 18C4 18.2761 3.77614 18.5 3.5 18.5C3.22386 18.5 3 18.2761 3 18C3 17.7239 3.22386 17.5 3.5 17.5C3.77614 17.5 4 17.7239 4 18Z"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </router-link>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <button class="text-white bg-orange-500 rounded font-bold hover:bg-orange-400 transition-all duration-300">
                                        <router-link
                                            :to="{
                                                name: 'dashboard-edit-movie',
                                                params: {
                                                    slug: movie.slug
                                                }
                                            }"
                                            class="w-full h-full px-3 py-2 block"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z"
                                                    fill="currentColor"
                                                />
                                            </svg>
                                        </router-link>
                                    </button>
                                    <label
                                        :for="'modal_delete_' + movie.id"
                                        class="px-3 py-2 text-center text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                        ><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            /></svg
                                    ></label>
                                    <input type="checkbox" :id="'modal_delete_' + movie.id" class="modal-toggle" />
                                    <div class="modal" role="dialog">
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg">Xác nhận!</h3>
                                            <p class="py-4">
                                                Xóa phim
                                                <span class="font-bold">{{ movie.title }}</span>
                                            </p>
                                            <div class="modal-action">
                                                <label
                                                    @click="deleteMov(movie.id)"
                                                    :for="'modal_delete_' + movie.id"
                                                    class="btn text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                                >
                                                    Xóa
                                                </label>
                                                <label :for="'modal_delete_' + movie.id" class="btn">Hủy!</label>
                                            </div>
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
import { useRouter } from 'vue-router'
import { getInitialMovie, deleteMovie } from '../../../webServices/movieService'

export default defineComponent({
    setup() {
        const movies = ref([])
        const loading = ref(false)

        const router = useRouter()

        const getMovieList = async () => {
            loading.value = true
            const data = await getInitialMovie()
            if (data && data.success) {
                movies.value = data.movies.data
                loading.value = false
            }
        }

        const deleteMov = async id => {
            const data = await deleteMovie(id)
            if (data && data.status === 401) {
                router.push({ name: 'auth-login' })
                return
            }
            if (data && data.success) {
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
