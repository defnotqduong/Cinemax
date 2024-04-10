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
                                <li v-for="type in typesSelected" :key="type.id" class="px-2 py-1 flex items-center justify-center gap-2 bg-gray-200 border-[1px] border-gray-400 rounded text-sm">
                                    <span @click="changeTypesSelected(type)" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z"
                                                fill="currentColor"
                                            /></svg></span
                                    >{{ type.name }}
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
                                    @mousedown="changeTypesSelected(type)"
                                    class="px-3 py-1 text-gray-700 cursor-pointer hover:bg-blue hover:text-white"
                                    :class="{ 'bg-gray-300 text-white': typesSelected.includes(type) }"
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
                                    :key="category.id"
                                    class="px-2 py-1 flex items-center justify-center gap-2 bg-gray-200 border-[1px] border-gray-400 rounded text-sm"
                                >
                                    <span @click="changeCategoriesSelected(category)" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z"
                                                fill="currentColor"
                                            /></svg></span
                                    >{{ category.name }}
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
                                    @mousedown="changeCategoriesSelected(category)"
                                    class="px-3 py-1 text-gray-700 cursor-pointer hover:bg-blue hover:text-white"
                                    :class="{ 'bg-gray-300 text-white': categoriesSelected.includes(category) }"
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
                                    >{{ region.name }}
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
                                    @mousedown="changeRegionsSelected(region)"
                                    class="px-3 py-1 text-gray-700 cursor-pointer hover:bg-blue hover:text-white"
                                    :class="{ 'bg-gray-300 text-white': regionsSelected.includes(region) }"
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
                            <button @click.prevent="fetchData" class="btn h-10 min-h-10 px-4 rounded bg-green hover:bg-green hover:opacity-80 text-white text-sm">
                                <span v-if="!loadingSubmit">Lấy danh sách</span>
                                <div v-if="loadingSubmit" class="flex items-center justify-center gap-2">
                                    <span class="loading loading-spinner text-white text-sm"></span>
                                    Đang tải
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="isCrawling" class="w-[75%] mt-5 text-[15px]">
                <div class="py-10 px-6 border-[1px] border-gray-300 rounded bg-white">
                    <h5 class="text-xl text-gray-700 font-medium">Danh sách phim</h5>
                    <div class="mt-1 text-gray-600">Đã chọn {{ selectedMovies.length }} / {{ movies.length }} phim</div>
                    <label class="mt-3 w-auto cursor-pointer flex items-center justify-start gap-2">
                        <input type="checkbox" @change="selectAll" class="h-3 w-3" />
                        <span class="text-gray-700 text-base">Chọn tất cả</span>
                    </label>
                    <div class="mt-4 px-5 py-2 bg-[#e9f1fa] max-h-[400px] overflow-y-auto custom-scrollbar">
                        <label v-for="(movie, index) in movies" :key="index" class="mt-2 cursor-pointer flex items-center justify-start gap-2">
                            <input type="checkbox" :checked="selectedMovies.includes(movie)" @change="toggleSelection(movie)" class="h-3 w-3" />
                            <span class="text-gray-700 text-base">{{ movie.name }}</span>
                        </label>
                    </div>
                    <div class="mt-4 flex items-center justify-start gap-2">
                        <button class="btn h-10 min-h-10 px-4 rounded bg-gray-400 hover:bg-gray-500 hover:opacity-80 text-white text-sm">Trước</button>
                        <button class="btn h-10 min-h-10 px-4 rounded bg-green hover:bg-green hover:opacity-80 text-white text-sm">Tiếp</button>
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
import { fetch } from '../../../webServices/crawlerService'
export default defineComponent({
    setup() {
        const loading = ref(false)
        const loadingSubmit = ref(false)
        const isCrawling = ref(false)
        const isCheckAll = ref(false)
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

        return {
            loading,
            loadingSubmit,
            isCrawling,
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
            movies,
            selectedMovies
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

            const data = await fetch({ link: this.link, from: this.fromPage, to: this.toPage })

            console.log(data)

            if (data && data.success) {
                this.movies = data.movies
                this.selectedMovies = data.movies
                this.isCrawling = true
                this.isCheckAll = true
            }

            this.loadingSubmit = false
        },
        selectAll() {
            if (this.isCheckAll) {
                this.selectedMovies = [...this.movies]
            } else {
                this.selectedMovies = []
            }
            this.isCheckAll = !this.isCheckAll
        },
        toggleSelection(movie) {
            const index = this.selectedMovies.indexOf(movie)
            if (index > -1) {
                this.selectedMovies.splice(index, 1)
            } else {
                this.selectedMovies.push(movie)
            }
        }
    },
    created() {
        this.getData()
    }
})
</script>

<style></style>
