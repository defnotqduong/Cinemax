<template>
    <div class="mt-[8px] mb-24 pr-6 pl-8">
        <div class="text-sm breadcrumbs">
            <ul class="justify-start">
                <li><router-link :to="{ name: 'dashboard-homepage' }" class="text-primary">Quản trị</router-link></li>
                <li><router-link :to="{ name: 'dashboard-movie' }" class="text-primary">Phim</router-link></li>
                <li>Crawler</li>
            </ul>
        </div>
        <form>
            <div v-if="loading" class="flex items-center justify-center min-h-[30vh]">
                <span class="loading loading-spinner text-primary"></span>
            </div>
            <div v-if="!loading && !isCrawling" class="w-[75%] mt-5 text-[15px]">
                <div class="py-10 px-6 border-[1px] border-gray-300 rounded bg-white">
                    <div class="mb-4">
                        <h6 class="mb-2 text-gray-700">Link crawler phim</h6>
                        <textarea v-model="link" class="textarea border-gray-300 rounded-md resize-none w-full min-h-[160px] focus:outline-none focus:border-gray-400"></textarea>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2 text-red-500">Loại trừ định dạng</h6>
                        <label for="">
                            <ul
                                class="p-1 border-[1px] rounded-md flex items-center justify-start flex-wrap gap-2"
                                :class="isShowType ? 'border-gray-400 rounded-none rounded-t-md' : 'border-gray-300'"
                            >
                                <li v-for="type in typesSelected" :key="type" class="px-2 py-1 flex items-center justify-center gap-2 bg-gray-200 border-[1px] border-gray-400 rounded text-sm">
                                    <span @click="changeTypesSelected(type)" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z"
                                                fill="currentColor"
                                            /></svg></span
                                    >{{ type }}
                                </li>
                                <input
                                    type="text"
                                    @focus="isShowType = true"
                                    @blur="
                                        () => {
                                            isShowType = false
                                            searchTypeText = ''
                                        }
                                    "
                                    v-model="searchTypeText"
                                    class="input flex-1 rounded-none h-8 p-0 outline-none focus:outline-none focus:border-none"
                                />
                            </ul>
                            <select
                                v-if="isShowType"
                                class="w-full border-[1px] border-r-gray-400 border-b-gray-400 border-l-gray-400 rounded-b-md custom-scrollbar overflow-y-auto focus:outline-none"
                                multiple
                            >
                                <option
                                    v-for="type in filteredTypes()"
                                    :key="type.id"
                                    :value="type.type"
                                    @mousedown="changeTypesSelected(type.type)"
                                    class="px-3 py-1 text-gray-700 cursor-pointer hover:bg-blue hover:text-white"
                                    :class="{ 'bg-gray-300 text-white': typesSelected.includes(type.type) }"
                                >
                                    {{ type.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2 text-red-500">Loại trừ thể loại</h6>
                        <label for="">
                            <ul
                                class="p-1 border-[1px] rounded-md flex items-center justify-start flex-wrap gap-2"
                                :class="isShowCategory ? 'border-gray-400 rounded-none rounded-t-md' : 'border-gray-300'"
                            >
                                <li
                                    v-for="category in categoriesSelected"
                                    :key="category"
                                    class="px-2 py-1 flex items-center justify-center gap-2 bg-gray-200 border-[1px] border-gray-400 rounded text-sm"
                                >
                                    <span @click="changeCategoriesSelected(category)" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z"
                                                fill="currentColor"
                                            /></svg></span
                                    >{{ category }}
                                </li>
                                <input
                                    type="text"
                                    @focus="isShowCategory = true"
                                    @blur="
                                        () => {
                                            isShowCategory = false
                                            searchCategoryText = ''
                                        }
                                    "
                                    v-model="searchCategoryText"
                                    class="input flex-1 rounded-none h-8 p-0 outline-none focus:outline-none focus:border-none"
                                />
                            </ul>
                            <select
                                v-if="isShowCategory"
                                class="w-full border-[1px] border-r-gray-400 border-b-gray-400 border-l-gray-400 rounded-b-md custom-scrollbar overflow-y-auto focus:outline-none"
                                multiple
                            >
                                <option
                                    v-for="category in filteredCategories()"
                                    :key="category.id"
                                    :value="category.slug"
                                    @mousedown="changeCategoriesSelected(category.name)"
                                    class="px-3 py-1 text-gray-700 cursor-pointer hover:bg-blue hover:text-white"
                                    :class="{ 'bg-gray-300 text-white': categoriesSelected.includes(category.name) }"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-2 text-red-500">Loại trừ quốc gia</h6>
                        <label for="">
                            <ul
                                class="p-1 border-[1px] rounded-md flex items-center justify-start flex-wrap gap-2"
                                :class="isShowRegion ? 'border-gray-400 rounded-none rounded-t-md' : 'border-gray-300'"
                            >
                                <li
                                    v-for="region in regionsSelected"
                                    :key="region.id"
                                    class="px-2 py-1 flex items-center justify-center gap-2 bg-gray-200 border-[1px] border-gray-400 rounded text-sm"
                                >
                                    <span @click="changeRegionsSelected(region)" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z"
                                                fill="currentColor"
                                            /></svg></span
                                    >{{ region }}
                                </li>
                                <input
                                    type="text"
                                    @focus="isShowRegion = true"
                                    @blur="
                                        () => {
                                            isShowRegion = false
                                            searchRegionText = ''
                                        }
                                    "
                                    v-model="searchRegionText"
                                    class="input flex-1 rounded-none h-8 p-0 outline-none focus:outline-none focus:border-none"
                                />
                            </ul>
                            <select
                                v-if="isShowRegion"
                                class="w-full border-[1px] border-r-gray-400 border-b-gray-400 border-l-gray-400 rounded-b-md custom-scrollbar overflow-y-auto focus:outline-none"
                                multiple
                            >
                                <option
                                    v-for="region in filteredRegions()"
                                    :key="region.id"
                                    :value="region.slug"
                                    @mousedown="changeRegionsSelected(region.name)"
                                    class="px-3 py-1 text-gray-700 cursor-pointer hover:bg-blue hover:text-white"
                                    :class="{ 'bg-gray-300 text-white': regionsSelected.includes(region.name) }"
                                >
                                    {{ region.name }}
                                </option>
                            </select>
                        </label>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-end justify-start gap-4">
                            <div>
                                <h6 class="mb-2 text-gray-700">Từ page</h6>
                                <input
                                    type="text"
                                    v-model="fromPage"
                                    placeholder=""
                                    class="input rounded-md text-sm border-gray-300 outline-none bg-white h-10 focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </div>
                            <div>
                                <h6 class="mb-2 text-gray-700">Tới page</h6>
                                <input
                                    type="text"
                                    v-model="toPage"
                                    placeholder=""
                                    class="input rounded-md text-sm border-gray-300 outline-none bg-white h-10 focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </div>
                        </div>
                        <div class="mt-4">
                            <button @click.prevent="fetchData" class="btn h-10 min-h-10 px-4 rounded bg-purple-500 hover:bg-purple-700 text-white text-sm">
                                <span v-if="!loadingSubmit">Lấy danh sách</span>
                                <div v-if="loadingSubmit" class="flex items-center justify-center gap-2">
                                    <span class="loading loading-spinner text-white text-sm"></span>
                                    Đang tải: {{ pagesLoaded }}/{{ totalPages }} page
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="isCrawling" class="w-[75%] mt-5 text-[15px]">
                <div v-if="process === 1" class="py-10 px-6 border-[1px] border-gray-300 rounded bg-white">
                    <h5 class="text-xl text-gray-700 font-medium">Danh sách phim</h5>
                    <div class="mt-1 text-gray-600">Đã chọn {{ selectedMovies.length }} / {{ movies.length }} phim</div>
                    <label class="mt-3 w-auto cursor-pointer flex items-center justify-start gap-2">
                        <input type="checkbox" :checked="isCheckAll" @change="selectAll" class="h-3 w-3" />
                        <span class="text-gray-700 text-base">Chọn tất cả</span>
                    </label>
                    <div class="mt-4 px-5 py-2 bg-[#e9f1fa] max-h-[400px] overflow-y-auto custom-scrollbar">
                        <label v-for="(movie, index) in movies" :key="index" class="mt-2 cursor-pointer flex items-center justify-start gap-2 text-gray-600 text-base">
                            <input type="checkbox" :checked="selectedMovies.includes(movie)" @change="toggleSelection(movie)" class="h-3 w-3" />
                            <span>{{ movie.name }}</span>
                        </label>
                    </div>
                    <div class="mt-4 flex items-center justify-start gap-2">
                        <button @click.prevent="rollbackProcess" class="btn h-10 min-h-10 px-4 rounded bg-gray-400 hover:bg-gray-500 hover:opacity-80 text-white text-sm">Trước</button>
                        <button @click.prevent="proceedToNextStep" class="btn h-10 min-h-10 px-4 rounded bg-purple-500 hover:bg-purple-700 text-white text-sm">Tiếp</button>
                    </div>
                </div>
                <div v-if="process === 2" class="py-10 px-6 border-[1px] border-gray-300 rounded bg-white">
                    <h5 class="text-xl text-gray-700 font-medium">Cập nhật phim</h5>
                    <div class="mt-4">
                        <h6 class="mb-1 text-gray-700 text-lg">Tiến độ phim</h6>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('status')" @change="toggleField('status')" />
                                <span class="text-gray-700 text-base">Trạng thái phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('episodes')" @change="toggleField('episodes')" />
                                <span class="text-gray-700 text-base">Tập mới</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('episode_time')" @change="toggleField('episode_time')" />
                                <span class="text-gray-700 text-base">Thời lượng phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('episode_current')" @change="toggleField('episode_current')" />
                                <span class="text-gray-700 text-base">Tập phim hiện tại</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('episode_total')" @change="toggleField('episode_total')" />
                                <span class="text-gray-700 text-base">Tổng số tập phim</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-1 text-gray-700 text-lg">Thông tin phim</h6>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('name')" @change="toggleField('name')" />
                                <span class="text-gray-700 text-base">Tên phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('origin_name')" @change="toggleField('origin_name')" />
                                <span class="text-gray-700 text-base">Tập tiếng anh</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('content')" @change="toggleField('content')" />
                                <span class="text-gray-700 text-base">Nội dung phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('thumb_url')" @change="toggleField('thumb_url')" />
                                <span class="text-gray-700 text-base">Ảnh thumbnail</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('poster_url')" @change="toggleField('poster_url')" />
                                <span class="text-gray-700 text-base">Ảnh poster</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('trailer_url')" @change="toggleField('trailer_url')" />
                                <span class="text-gray-700 text-base">Link trailer</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('quality')" @change="toggleField('quality')" />
                                <span class="text-gray-700 text-base">Chất lượng phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('language')" @change="toggleField('language')" />
                                <span class="text-gray-700 text-base">Ngôn ngữ</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('notify')" @change="toggleField('notify')" />
                                <span class="text-gray-700 text-base">Nội dung thông báo</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('showtimes')" @change="toggleField('showtimes')" />
                                <span class="text-gray-700 text-base">Giờ chiếu phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('year')" @change="toggleField('year')" />
                                <span class="text-gray-700 text-base">Năm sản xuất</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-1 text-gray-700 text-lg">Phân loại phim</h6>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('type')" @change="toggleField('type')" />
                                <span class="text-gray-700 text-base">Định dạng phim</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('is_show_in_theater')" @change="toggleField('is_show_in_theater')" />
                                <span class="text-gray-700 text-base">Đánh dấu phim chiếu rạp</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('categories')" @change="toggleField('categories')" />
                                <span class="text-gray-700 text-base">Thể loại</span>
                            </label>
                            <label class="w-auto cursor-pointer flex items-center justify-start gap-2">
                                <input type="checkbox" class="h-3 w-3" :checked="fields.includes('regions')" @change="toggleField('regions')" />
                                <span class="text-gray-700 text-base">Khu vực</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-start gap-2">
                        <button @click.prevent="rollbackProcess" class="btn h-10 min-h-10 px-4 rounded bg-gray-400 hover:bg-gray-500 hover:opacity-80 text-white text-sm">Trước</button>
                        <button @click.prevent="proceedToNextStep" class="btn h-10 min-h-10 px-4 rounded bg-purple-500 hover:bg-purple-700 text-white text-sm">Tiếp</button>
                    </div>
                </div>
                <div v-if="process === 3" class="py-10 px-6 border-[1px] border-gray-300 rounded bg-white">
                    <h5 class="text-xl text-gray-700 font-medium">Đang tiến hành crawl...</h5>
                    <div class="mt-1 text-gray-600">Crawl {{ totalCount }} / {{ selectedMovies.length }} phim (Thành công: {{ successCount }}, Thất bại: {{ failureCount }})</div>
                    <div v-if="moviesCrawler.length > 0" class="mt-4 px-5 py-2 bg-[#e9f1fa] max-h-[400px] overflow-y-auto custom-scrollbar">
                        <label
                            v-for="(movie, index) in moviesCrawler"
                            :key="index"
                            class="mt-2 cursor-pointer flex items-center justify-start gap-2 text-base"
                            :class="movie.status ? 'text-green' : 'text-red-500'"
                        >
                            <span>{{ index + 1 }}.</span>
                            <span>{{ movie.name }}</span>
                            <span class="ml-auto">{{ movie.message }}</span>
                        </label>
                    </div>
                    <div class="mt-4 flex items-center justify-start gap-2">
                        <button @click.prevent="rollbackProcess" class="btn h-10 min-h-10 px-4 rounded bg-gray-400 hover:bg-gray-500 hover:opacity-80 text-white text-sm">Trước</button>
                        <button @click.prevent="proceedToNextStep" class="btn h-10 min-h-10 px-4 rounded bg-purple-500 hover:bg-purple-700 text-white text-sm">Xong</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { getAllCategory } from '../../../webServices/categoryService'
import { getAllRegion } from '../../../webServices/regionService'
import { getAllMovieType } from '../../../webServices/movieTypeService'
import { fetch, crawler } from '../../../webServices/crawlerService'
export default defineComponent({
    setup() {
        const loading = ref(false)
        const loadingSubmit = ref(false)
        const isCrawling = ref(false)
        const process = ref(1)
        const isCheckAll = ref(true)
        const link = ref('https://ophim1.com/danh-sach/phim-moi-cap-nhat')

        const types = ref([])
        const typesSelected = ref([])
        const isShowType = ref(false)
        const searchTypeText = ref('')

        const categories = ref([])
        const categoriesSelected = ref([])
        const isShowCategory = ref(false)
        const searchCategoryText = ref('')

        const regions = ref([])
        const regionsSelected = ref([])
        const isShowRegion = ref(false)
        const searchRegionText = ref('')

        const movies = ref([])
        const selectedMovies = ref([])
        const fromPage = ref(1)
        const toPage = ref(10)
        const totalPages = ref(null)
        const pagesLoaded = ref(null)

        const totalCount = ref(0)
        const successCount = ref(0)
        const failureCount = ref(0)
        const moviesCrawler = ref([])

        const fields = ref([
            'status',
            'episodes',
            'episode_time',
            'episode_current',
            'episode_total',
            'name',
            'origin_name',
            'content',
            'thumb_url',
            'poster_url',
            'trailer_url',
            'quality',
            'language',
            'notify',
            'showtimes',
            'year',
            'type',
            'is_show_in_theater',
            'categories',
            'regions'
        ])

        return {
            loading,
            loadingSubmit,
            isCrawling,
            process,
            isCheckAll,
            link,
            types,
            isShowType,
            typesSelected,
            searchTypeText,
            categories,
            categoriesSelected,
            isShowCategory,
            searchCategoryText,
            regions,
            regionsSelected,
            isShowRegion,
            searchRegionText,
            fromPage,
            toPage,
            totalPages,
            pagesLoaded,
            movies,
            selectedMovies,
            fields,
            totalCount,
            successCount,
            failureCount,
            moviesCrawler
        }
    },
    methods: {
        async getData() {
            this.loading = true

            const [types, categories, regions] = await Promise.all([getAllMovieType(), getAllCategory(), getAllRegion()])

            if (types && types.success) this.types = types.types
            if (categories && categories.success) this.categories = categories.categories
            if (regions && regions.success) this.regions = regions.regions

            this.loading = false
        },

        changeTypesSelected(type) {
            const index = this.typesSelected.indexOf(type)
            if (index === -1) {
                this.typesSelected.push(type)
            } else {
                this.typesSelected.splice(index, 1)
            }
        },
        changeCategoriesSelected(category) {
            const index = this.categoriesSelected.indexOf(category)
            if (index === -1) {
                this.categoriesSelected.push(category)
            } else {
                this.categoriesSelected.splice(index, 1)
            }
        },
        changeRegionsSelected(region) {
            const index = this.regionsSelected.indexOf(region)
            if (index === -1) {
                this.regionsSelected.push(region)
            } else {
                this.regionsSelected.splice(index, 1)
            }
        },
        filteredTypes() {
            const searchText = this.searchTypeText.trim().toLowerCase()
            if (!searchText) {
                return this.types
            } else {
                return this.types.filter(type => type.name.toLowerCase().includes(searchText))
            }
        },
        filteredCategories() {
            const searchText = this.searchCategoryText.trim().toLowerCase()
            if (!searchText) {
                return this.categories
            } else {
                return this.categories.filter(category => category.name.toLowerCase().includes(searchText))
            }
        },
        filteredRegions() {
            const searchText = this.searchRegionText.trim().toLowerCase()
            if (!searchText) {
                return this.regions
            } else {
                return this.regions.filter(region => region.name.toLowerCase().includes(searchText))
            }
        },
        async fetchData() {
            this.loadingSubmit = true

            let from = parseInt(this.fromPage)
            let to = parseInt(this.toPage)

            if (to < from) [from, to] = [to, from]

            this.pagesLoaded = 0
            this.totalPages = to - from + 1
            this.movies = []
            this.selectedMovies = []

            const promises = []

            for (let i = from; i <= to; i++) {
                promises.push(this.fetchDataForPage(i))
            }

            await Promise.all(
                promises.map(promise => {
                    return promise.then(() => {
                        this.pagesLoaded++
                    })
                })
            )

            promises.forEach(promise => {
                promise.then(data => {
                    if (data && data.success) {
                        this.movies = [...this.movies, ...data.movies]
                        this.selectedMovies = [...this.selectedMovies, ...data.movies]
                    }
                })
            })

            this.isCrawling = true
            this.isCheckAll = true
            this.loadingSubmit = false
        },

        fetchDataForPage(page) {
            return new Promise((resolve, reject) => {
                fetch({ link: this.link, from: page, to: page })
                    .then(data => {
                        resolve(data)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },

        rollbackProcess() {
            switch (this.process) {
                case 1:
                    this.isCrawling = false
                    break
                case 2:
                    this.process = 1
                    break
                case 3:
                    this.process = 2
                    break
                default:
                    break
            }
        },
        proceedToNextStep() {
            switch (this.process) {
                case 1:
                    this.process = 2
                    break
                case 2:
                    this.process = 3
                    this.crawlMovie()
                    break
                case 3:
                    this.process = 1
                    this.isCrawling = false
                    break
                default:
                    break
            }
        },
        selectAll() {
            this.isCheckAll = !this.isCheckAll
            if (this.isCheckAll) {
                this.selectedMovies = [...this.movies]
            } else {
                this.selectedMovies = []
            }
        },
        toggleSelection(movie) {
            const index = this.selectedMovies.indexOf(movie)
            if (index > -1) {
                this.selectedMovies.splice(index, 1)
            } else {
                this.selectedMovies.push(movie)
            }
        },
        toggleField(field) {
            const index = this.fields.indexOf(field)
            if (index !== -1) {
                this.fields.splice(index, 1)
            } else {
                this.fields.push(field)
            }
        },
        async crawlMovie() {
            this.totalCount = 0
            this.successCount = 0
            this.failureCount = 0
            this.moviesCrawler = []

            for (const movie of this.selectedMovies) {
                const data = {
                    excludedType: this.typesSelected,
                    excludedCategories: this.categoriesSelected,
                    excludedRegions: this.regionsSelected,
                    fields: this.fields,
                    slug: movie.slug
                }

                const res = await crawler(data)

                console.log(res)

                this.totalCount++

                if (res && res.success) {
                    this.successCount++
                } else {
                    this.failureCount++
                }

                this.moviesCrawler.push({
                    name: movie.name,
                    status: res && res.success,
                    message: res ? (res.success ? res.message : res.data.message) : 'Không nhận được phản hồi từ server'
                })
            }
        }
    },
    created() {
        this.getData()
    }
})
</script>

<style></style>
