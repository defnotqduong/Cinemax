<template>
    <div class="mt-[8px] mb-24 pr-6 pl-8">
        <div class="text-sm breadcrumbs">
            <ul class="justify-start">
                <li><router-link :to="{ name: 'dashboard-homepage' }" class="text-primary">Quản trị</router-link></li>
                <li><router-link :to="{ name: 'dashboard-movie' }" class="text-primary">Phim</router-link></li>
                <li>Danh sách</li>
            </ul>
        </div>
        <div class="my-2 flex items-start justify-between">
            <div class="flex items-end justify-start gap-4">
                <h3 class="text-4xl font-bold">Phim</h3>
                <p v-if="overview.total > 0" class="text-[15px] mb-[2px]">Hiển thị từ {{ overview.from }} đến {{ overview.to }} trong tổng số {{ overview.total }} phim</p>
                <p v-if="overview.total == 0" class="text-[15px] mb-[2px]">Không có bản ghi nào</p>
            </div>
        </div>
        <div class="mb-3 flex items-center justify-between">
            <router-link :to="{ name: 'dashboard-movie-create' }" class="btn px-2 h-10 min-h-10 gap-1 text-sm text-white bg-green hover:bg-green hover:opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                    <g>
                        <path id="Vector" d="M6 12H12M12 12H18M12 12V18M12 12V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </g></svg
                >Thêm phim
            </router-link>
            <input
                type="text"
                placeholder="Tìm kiếm..."
                class="input rounded-full border-gray-300 outline-none bg-white h-10 w-full max-w-[260px] focus:outline-none focus:border-primary focus:shadow-sm focus:shadow-purple-200 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
            />
        </div>
        <div class="mb-3">Bộ lọc</div>

        <div v-if="loading" class="flex items-center justify-center min-h-[30vh]">
            <span class="loading loading-spinner text-primary"></span>
        </div>
        <div v-if="!loading">
            <div class="overflow-x-auto rounded-md mb-6 bg-white border-[1px] border-gray-300">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr class="border-gray-300">
                            <th class="text-base font-bold text-gray-500">Thông tin</th>
                            <th class="text-base font-bold text-gray-500">Thumbnail</th>
                            <th class="text-base font-bold text-gray-500">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="movie in movies" :key="movie.id" class="hover:bg-[rgba(124,105,239,0.1)] border-none">
                            <td class="w-[50%]">
                                <div class="flex flex-col items-start justify-start">
                                    <div class="text-[15px]">
                                        <span class="font-semibold text-primary">{{ movie.name }}</span> <span class="text-green">[{{ movie.year }}]</span>
                                    </div>
                                    <div class="my-2">
                                        <small class="text-gray-500 text-sm">
                                            ({{ movie.origin_name }}) <span class="text-red-500">[{{ movie.episode_current }}]</span></small
                                        >
                                    </div>
                                    <div class="text-xs flex items-center justify-center gap-2">
                                        <span
                                            class="px-2 rounded text-white"
                                            :class="{
                                                'bg-red-500': movie.type === 'cartoon',
                                                'bg-gray-400': movie.type === 'single',
                                                'bg-purple-600': movie.type === 'series'
                                            }"
                                            >{{ getType(movie.type) }}</span
                                        >
                                        <span
                                            class="px-2 rounded text-white"
                                            :class="{
                                                'bg-yellow': movie.status === 'trailer',
                                                'bg-blue': movie.status === 'ongoing',
                                                'bg-green': movie.status === 'completed'
                                            }"
                                        >
                                            {{ getStatus(movie.status) }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <img :src="movie.thumb_url" alt="thumb" class="w-16 h-24 object-cover object-center rounded" />
                            </td>
                            <td>
                                <div class="flex items-center justify-start gap-2">
                                    <div>
                                        <label
                                            :for="'my_modal_' + movie.id"
                                            class="btn px-2 my-2 flex items-center gap-1 justify-center bg-transparent border-none outline-none shadow-none text-primary hover:text-[#495057] hover:bg-transparent"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="14px" height="14px" viewBox="0 0 32 32" version="1.1">
                                                <path
                                                    d="M0 16q0.064 0.128 0.16 0.352t0.48 0.928 0.832 1.344 1.248 1.536 1.664 1.696 2.144 1.568 2.624 1.344 3.136 0.896 3.712 0.352 3.712-0.352 3.168-0.928 2.592-1.312 2.144-1.6 1.664-1.632 1.248-1.6 0.832-1.312 0.48-0.928l0.16-0.352q-0.032-0.128-0.16-0.352t-0.48-0.896-0.832-1.344-1.248-1.568-1.664-1.664-2.144-1.568-2.624-1.344-3.136-0.896-3.712-0.352-3.712 0.352-3.168 0.896-2.592 1.344-2.144 1.568-1.664 1.664-1.248 1.568-0.832 1.344-0.48 0.928zM10.016 16q0-2.464 1.728-4.224t4.256-1.76 4.256 1.76 1.76 4.224-1.76 4.256-4.256 1.76-4.256-1.76-1.728-4.256zM12 16q0 1.664 1.184 2.848t2.816 1.152 2.816-1.152 1.184-2.848-1.184-2.816-2.816-1.184-2.816 1.184l2.816 2.816h-4z"
                                                /></svg
                                            >Chi tiết</label
                                        >
                                        <input type="checkbox" :id="'my_modal_' + movie.id" class="modal-toggle" />
                                        <div class="modal" role="dialog">
                                            <div class="modal-box bg-white p-8 flex flex-col gap-8">
                                                <div class="flex items-start justify-start">
                                                    <h5 class="w-[35%] text-lg font-extrabold">Thông tin:</h5>
                                                    <div class="flex-1 flex flex-col items-start justify-start">
                                                        <div class="text-[15px]">
                                                            <span class="font-semibold text-primary">{{ movie.name }}</span>
                                                            <span class="text-green"> [{{ movie.year }}]</span>
                                                        </div>
                                                        <div class="my-2">
                                                            <small class="text-gray-500 text-sm">
                                                                ({{ movie.origin_name }}) <span class="text-red-500">[{{ movie.episode_current }}]</span></small
                                                            >
                                                        </div>
                                                        <div class="text-xs flex items-center justify-center gap-2">
                                                            <span
                                                                class="px-2 rounded text-white"
                                                                :class="{
                                                                    'bg-red-500': movie.type === 'cartoon',
                                                                    'bg-gray-400': movie.type === 'single',
                                                                    'bg-purple-600': movie.type === 'series'
                                                                }"
                                                                >{{ getType(movie.type) }}</span
                                                            >
                                                            <span
                                                                class="px-2 rounded text-white"
                                                                :class="{
                                                                    'bg-yellow': movie.status === 'trailer',
                                                                    'bg-blue': movie.status === 'ongoing',
                                                                    'bg-green': movie.status === 'completed'
                                                                }"
                                                            >
                                                                {{ getStatus(movie.status) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex items-start justify-start">
                                                    <div class="w-[35%] text-lg font-extrabold">Ảnh thumnail:</div>
                                                    <div class="flex-1">
                                                        <img :src="movie.thumb_url" alt="thumb" class="w-16 h-24 object-cover object-center rounded" />
                                                    </div>
                                                </div>
                                                <div class="flex items-start justify-start">
                                                    <div class="w-[35%] text-lg font-extrabold">Nội dung:</div>
                                                    <div class="flex-1">
                                                        <p v-html="movie.content || '-'"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-start justify-start">
                                                    <div class="w-[35%] text-lg font-extrabold">Thể loại:</div>
                                                    <div class="flex-1 grid grid-cols-3 gap-2">
                                                        <span class="bg-gray-200 px-2 rounded text-center text-sm" v-for="category in movie.categories" :key="category.id">{{ category.name }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-start justify-start">
                                                    <div class="w-[35%] text-lg font-extrabold">Khu vực:</div>
                                                    <div class="flex-1 grid grid-cols-3 gap-2">
                                                        <span class="bg-gray-200 px-2 rounded text-center text-sm" v-for="region in movie.regions" :key="region.id">{{ region.name }}</span>
                                                    </div>
                                                </div>
                                                <div class="modal-action">
                                                    <label :for="'my_modal_' + movie.id" class="btn px-3 h-10 min-h-10 bg-gray-400 text-white hover:bg-gray-500">Đóng</label>
                                                </div>
                                            </div>
                                            <label class="modal-backdrop" :for="'my_modal_' + movie.id">Close</label>
                                        </div>
                                    </div>
                                    <router-link
                                        :to="{ name: 'dashboard-movie-edit', params: { id: movie.id } }"
                                        class="px-2 my-2 flex items-center gap-1 justify-center text-primary hover:text-[#495057]"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M12 21C12 20.4477 12.4477 20 13 20H21C21.5523 20 22 20.4477 22 21C22 21.5523 21.5523 22 21 22H13C12.4477 22 12 21.5523 12 21Z"
                                                fill="currentColor"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M20.7736 8.09994C22.3834 6.48381 22.315 4.36152 21.113 3.06183C20.5268 2.4281 19.6926 2.0233 18.7477 2.00098C17.7993 1.97858 16.8167 2.34127 15.91 3.09985C15.8868 3.11925 15.8645 3.13969 15.8432 3.16111L2.87446 16.1816C2.31443 16.7438 2 17.5051 2 18.2987V19.9922C2 21.0937 2.89197 22 4.00383 22H5.68265C6.48037 22 7.24524 21.6823 7.80819 21.1171L20.7736 8.09994ZM17.2071 5.79295C16.8166 5.40243 16.1834 5.40243 15.7929 5.79295C15.4024 6.18348 15.4024 6.81664 15.7929 7.20717L16.7929 8.20717C17.1834 8.59769 17.8166 8.59769 18.2071 8.20717C18.5976 7.81664 18.5976 7.18348 18.2071 6.79295L17.2071 5.79295Z"
                                                fill="currentColor"
                                            />
                                        </svg>
                                        Sửa
                                    </router-link>
                                    <button class="px-2 my-2 flex items-center gap-1 justify-center text-primary hover:text-[#495057]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="-3 0 32 32">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="Icon-Set-Filled" transform="translate(-261.000000, -205.000000)" fill="currentColor">
                                                    <path
                                                        d="M268,220 C268,219.448 268.448,219 269,219 C269.552,219 270,219.448 270,220 L270,232 C270,232.553 269.552,233 269,233 C268.448,233 268,232.553 268,232 L268,220 L268,220 Z M273,220 C273,219.448 273.448,219 274,219 C274.552,219 275,219.448 275,220 L275,232 C275,232.553 274.552,233 274,233 C273.448,233 273,232.553 273,232 L273,220 L273,220 Z M278,220 C278,219.448 278.448,219 279,219 C279.552,219 280,219.448 280,220 L280,232 C280,232.553 279.552,233 279,233 C278.448,233 278,232.553 278,232 L278,220 L278,220 Z M263,233 C263,235.209 264.791,237 267,237 L281,237 C283.209,237 285,235.209 285,233 L285,217 L263,217 L263,233 L263,233 Z M277,209 L271,209 L271,208 C271,207.447 271.448,207 272,207 L276,207 C276.552,207 277,207.447 277,208 L277,209 L277,209 Z M285,209 L279,209 L279,207 C279,205.896 278.104,205 277,205 L271,205 C269.896,205 269,205.896 269,207 L269,209 L263,209 C261.896,209 261,209.896 261,211 L261,213 C261,214.104 261.895,214.999 262.999,215 L285.002,215 C286.105,214.999 287,214.104 287,213 L287,211 C287,209.896 286.104,209 285,209 L285,209 Z"
                                                    ></path>
                                                </g>
                                            </g>
                                        </svg>
                                        Xóa
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="border-t-[1px] border-gray-300">
                        <tr class="border-gray-300">
                            <th class="text-base font-bold text-gray-500">Thông tin</th>
                            <th class="text-base font-bold text-gray-500">Thumbnail</th>
                            <th class="text-base font-bold text-gray-500">Hành động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div>
                <Pagination :meta="meta" :links="links" @getData="getData" />
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Pagination from '@/components/Pagination/Pagination.vue'

import { getAllMovie } from '../../../webServices/movieService'
export default defineComponent({
    components: { Pagination },
    setup() {
        const meta = ref({
            current_page: 1,
            last_page: 1
        })

        const overview = ref({
            from: null,
            to: null,
            total: null
        })

        const loading = ref(false)

        const links = ref({
            first_page_url: '',
            last_page_url: '',
            prev_page_url: '',
            next_page_url: ''
        })

        const filter = ref({
            category_id: null,
            region_id: null,
            year: null,
            type: null,
            sort: null,
            search: null,
            page: 1,
            limit: 10
        })

        const movies = ref([])

        return { loading, overview, meta, links, filter, movies }
    },
    methods: {
        async getData(page) {
            this.loading = true

            this.filter.page = page || 1

            const data = await getAllMovie(this.filter)

            if (data && data.success) {
                this.movies = data.movies.data

                this.overview.from = data.movies.from
                this.overview.to = data.movies.to
                this.overview.total = data.movies.total

                this.meta.current_page = data.movies.current_page
                this.meta.last_page = data.movies.last_page

                this.links.first_page_url = data.movies.first_page_url
                this.links.last_page_url = data.movies.last_page_url
                this.links.prev_page_url = data.movies.prev_page_url
                this.links.next_page_url = data.movies.next_page_url
            }

            this.loading = false
        },
        getType(type) {
            switch (type) {
                case 'single':
                    return 'Phim lẻ'
                case 'series':
                    return 'Phim bộ'
                case 'cartoon':
                    return 'Phim hoạt hình'
                default:
                    return ''
            }
        },
        getStatus(status) {
            switch (status) {
                case 'trailer':
                    return 'Sắp chiếu'
                case 'ongoing':
                    return 'Đang chiếu'
                case 'completed':
                    return 'Hoàn thành'
                default:
                    return ''
            }
        }
    },
    created() {
        this.getData()
    }
})
</script>

<style></style>
