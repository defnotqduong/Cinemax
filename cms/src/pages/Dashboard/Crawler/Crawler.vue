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
            <div v-if="!loading" class="w-[75%] mt-5 text-[15px]">
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
                                    id="name"
                                    placeholder="1"
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-[120px] focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </div>
                            <div>
                                <h6 class="mb-2 text-gray-700">Tới page</h6>
                                <input
                                    type="text"
                                    id="name"
                                    placeholder="10"
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-[120px] focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </div>
                            <div>
                                <button class="btn h-10 min-h-10 px-4 rounded bg-green hover:bg-green hover:opacity-80 text-white text-sm">Lấy danh sách</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex items-center justify-start gap-3">
                    <button @click="create" class="btn h-10 min-h-10 px-6 bg-green hover:bg-green hover:opacity-80 text-white text-base">
                        <span v-if="!loadingSubmit" class="flex-1 flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M18.1716 1C18.702 1 19.2107 1.21071 19.5858 1.58579L22.4142 4.41421C22.7893 4.78929 23 5.29799 23 5.82843V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H18.1716ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21L5 21L5 15C5 13.3431 6.34315 12 8 12L16 12C17.6569 12 19 13.3431 19 15V21H20C20.5523 21 21 20.5523 21 20V6.82843C21 6.29799 20.7893 5.78929 20.4142 5.41421L18.5858 3.58579C18.2107 3.21071 17.702 3 17.1716 3H17V5C17 6.65685 15.6569 8 14 8H10C8.34315 8 7 6.65685 7 5V3H4ZM17 21V15C17 14.4477 16.5523 14 16 14L8 14C7.44772 14 7 14.4477 7 15L7 21L17 21ZM9 3H15V5C15 5.55228 14.5523 6 14 6H10C9.44772 6 9 5.55228 9 5V3Z"
                                    fill="currentColor"
                                /></svg
                            >Lưu
                        </span>
                        <span v-if="loadingSubmit" class="loading loading-spinner text-white text-sm"></span>
                    </button>
                    <button @click="cancel" class="btn h-10 min-h-10 px-6 bg-red-500 hover:bg-red-600 text-white text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                            <path d="M18 18L6 6" stroke="currentColor" stroke-width="2" /></svg
                        >Hủy
                    </button>
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
export default defineComponent({
    setup() {
        const loading = ref(false)
        const loadingSubmit = ref(false)
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

        return {
            loading,
            loadingSubmit,
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
            searchRegionText
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
        }
    },
    created() {
        this.getData()
    }
})
</script>

<style></style>
