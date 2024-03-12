<template>
    <div class="mt-[8px] mb-24 pr-6 pl-8">
        <div class="text-sm breadcrumbs">
            <ul class="justify-start">
                <li><router-link :to="{ name: 'dashboard-homepage' }" class="text-primary">Quản trị</router-link></li>
                <li><router-link :to="{ name: 'dashboard-movie' }" class="text-primary">Phim</router-link></li>
                <li>Chỉnh sửa phim</li>
            </ul>
        </div>
        <form>
            <div v-if="loading" class="flex items-center justify-center min-h-[30vh]">
                <span class="loading loading-spinner text-primary"></span>
            </div>
            <div v-if="!loading" class="w-[75%] mt-5 text-[15px]">
                <div role="tablist" class="tabs tabs-lifted">
                    <a role="tab" class="tab text-gray-400 font-bold opacity-60" :class="tapActive === 1 && 'tab-active'" @click="tapActive = 1"
                        >Thông tin phim</a
                    >
                    <a role="tab" class="tab text-gray-400 font-bold opacity-60" :class="tapActive === 2 && 'tab-active'" @click="tapActive = 2">Phân loại</a>
                    <a role="tab" class="tab text-gray-400 font-bold opacity-60" :class="tapActive === 3 && 'tab-active'" @click="tapActive = 3"
                        >Danh sách tập phim</a
                    >
                    <a role="tab" class="tab text-gray-400 font-bold opacity-60" :class="tapActive === 4 && 'tab-active'" @click="tapActive = 4"
                        >Cập nhật phim</a
                    >
                    <a role="tab" class="tab text-gray-400 font-bold opacity-60" :class="tapActive === 5 && 'tab-active'" @click="tapActive = 5">Khác</a>
                </div>
                <div v-if="tapActive === 1" class="p-6 bg-white border-r-[1px] border-l-[1px] border-b-[1px] border-gray-400 rounded-b-lg">
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <label for="name">
                            <div class="mb-2 text-gray-700 font-bold">Tên phim <span class="text-red-500">*</span></div>
                            <input
                                type="text"
                                id="name"
                                v-model="name"
                                placeholder="Tên phim"
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <label for="origin_name">
                            <div class="mb-2 text-gray-700 font-bold">Tên tiếng anh <span class="text-red-500">*</span></div>
                            <input
                                type="text"
                                id="origin_name"
                                v-model="origin_name"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <label for="thumb_url" class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Thumbnail</div>
                            <input
                                type="text"
                                id="thumb_url"
                                v-model="thumb_url"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <label for="poster_url" class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Poster</div>
                            <input
                                type="text"
                                id="poster_url"
                                v-model="poster_url"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <!-- <div class="col-span-2 grid grid-cols-5 gap-10">
                            <div class="col-span-2">
                                <div class="mb-2 text-primary font-bold">Ảnh thumb</div>
                                <label for="thumb" class="block w-[180px] h-[260px] border-[1px] border-table rounded overflow-hidden">
                                    <img :src="thumbUrl" alt="thumb" class="w-full h-full object-cover object-center" />
                                </label>
                                <input
                                    type="file"
                                    @change="handleFileThumbnail"
                                    id="thumb"
                                    class="hidden input h-10 border-input outline-none rounded w-full focus:outline-none focus:border-input-focus placeholder:text-sm placeholder:opacity-70"
                                />
                            </div>
                            <div class="col-span-3">
                                <div class="mb-2 text-primary font-bold">Ảnh poster</div>
                                <label for="poster" class="block w-full h-[260px] border-[1px] border-table rounded">
                                    <img :src="posterUrl" alt="poster" class="w-full h-full object-cover object-center" />
                                </label>
                                <input
                                    type="file"
                                    id="poster"
                                    @change="handleFilePoster"
                                    class="hidden input h-10 border-input outline-none rounded w-full focus:outline-none focus:border-input-focus placeholder:text-sm placeholder:opacity-70"
                                />
                            </div>
                        </div> -->
                        <label for="content" class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Nội dung</div>
                            <ckeditor :editor="editor" v-model="content" :config="editorConfig"></ckeditor>
                        </label>
                        <label for="notify" class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Thông báo / ghi chú</div>
                            <input
                                type="text"
                                id="notify"
                                v-model="notify"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <label for="showtimes" class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Lịch chiếu phim</div>
                            <input
                                type="text"
                                id="showtimes"
                                v-model="showtimes"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <label for="trailer_url" class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Trailer URL</div>
                            <input
                                type="text"
                                id="trailer_url"
                                v-model="trailer_url"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
                        <div class="col-span-2 grid grid-cols-3 gap-x-6 gap-y-4">
                            <label for="episode_time" class="">
                                <div class="mb-2 text-gray-700 font-bold">Thời lượng tập phim</div>
                                <input
                                    type="text"
                                    id="episode_time"
                                    v-model="episode_time"
                                    placeholder=""
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </label>
                            <label for="episode_current" class="">
                                <div class="mb-2 text-gray-700 font-bold">Tập phim hiện tại</div>
                                <input
                                    type="text"
                                    id="episode_current"
                                    v-model="episode_current"
                                    placeholder=""
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </label>
                            <label for="episode_total" class="">
                                <div class="mb-2 text-gray-700 font-bold">Tổng số tập phim</div>
                                <input
                                    type="text"
                                    id="episode_total"
                                    v-model="episode_total"
                                    placeholder=""
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </label>
                            <label for="language" class="">
                                <div class="mb-2 text-gray-700 font-bold">Ngôn ngữ</div>
                                <input
                                    type="text"
                                    id="language"
                                    v-model="language"
                                    placeholder="Vietsub"
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </label>
                            <label for="quality" class="">
                                <div class="mb-2 text-gray-700 font-bold">Chất lượng</div>
                                <input
                                    type="text"
                                    id="quality"
                                    v-model="quality"
                                    placeholder="HD"
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </label>
                            <label for="year" class="">
                                <div class="mb-2 text-gray-700 font-bold">Năm sản xuất</div>
                                <input
                                    type="text"
                                    id="year"
                                    v-model="year"
                                    placeholder=""
                                    class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                />
                            </label>
                        </div>
                    </div>
                </div>
                <div v-if="tapActive === 2" class="p-6 bg-white border-r-[1px] border-l-[1px] border-b-[1px] border-gray-400 rounded-b-lg">
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <div class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Định dạng <span class="text-red-500">*</span></div>
                            <label class="w-auto max-w-[160px] flex items-center justify-start gap-2">
                                <input type="radio" name="type" class="" v-model="type" value="single" />
                                <span>Phim lẻ</span>
                            </label>
                            <label class="w-auto max-w-[160px] flex items-center justify-start gap-2">
                                <input type="radio" name="type" class="" v-model="type" value="series" />
                                <span>Phim bộ</span>
                            </label>
                            <label class="w-auto max-w-[160px] flex items-center justify-start gap-2">
                                <input type="radio" name="type" class="" v-model="type" value="cartoon" />
                                <span>Phim hoạt hình</span>
                            </label>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Tình trạng <span class="text-red-500">*</span></div>
                            <label class="w-auto max-w-[160px] flex items-center justify-start gap-2">
                                <input type="radio" name="status" class="" v-model="status" value="trailer" />
                                <span>Sắp chiếu</span>
                            </label>
                            <label class="w-auto max-w-[160px] flex items-center justify-start gap-2">
                                <input type="radio" name="status" class="" v-model="status" value="ongoing" />
                                <span>Đang chiếu</span>
                            </label>
                            <label class="w-auto max-w-[160px] flex items-center justify-start gap-2">
                                <input type="radio" name="status" class="" v-model="status" value="completed" />
                                <span>Hoàn thành</span>
                            </label>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Thể loại</div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="form-control" v-for="category in categories" :key="category.id">
                                    <label class="cursor-pointer label justify-start gap-2 p-0">
                                        <input type="checkbox" @click="toggleCategory(category.id)" :checked="category_ids.includes(category.id)" />
                                        <span class="label-text">{{ category.name }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-2 text-gray-700 font-bold">Khu vực</div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="form-control" v-for="region in regions" :key="region.id">
                                    <label class="cursor-pointer label justify-start gap-2 p-0">
                                        <input type="checkbox" @click="toggleRegion(region.id)" :checked="region_ids.includes(region.id)" />
                                        <span class="label-text">{{ region.name }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="tapActive === 3" class="p-6 bg-white border-r-[1px] border-l-[1px] border-b-[1px] border-gray-400 rounded-b-lg">DS tập phim</div>
                <div v-if="tapActive === 4" class="p-6 bg-white border-r-[1px] border-l-[1px] border-b-[1px] border-gray-400 rounded-b-lg">Cập nhật phim</div>
                <div v-if="tapActive === 5" class="p-6 bg-white border-r-[1px] border-l-[1px] border-b-[1px] border-gray-400 rounded-b-lg">
                    <div class="flex flex-col gap-2">
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-2 p-0">
                                <input type="checkbox" v-model="is_show_in_theater" :checked="Boolean(is_show_in_theater)" />
                                <span class="label-text">Phim chiếu rạp</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-2 p-0">
                                <input type="checkbox" v-model="is_copyright" :checked="is_copyright == 1" />
                                <span class="label-text">Có bản quyền</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-2 p-0">
                                <input type="checkbox" v-model="is_sensitive_content" :checked="is_sensitive_content == 1" />
                                <span class="label-text">Phim có nội dung 18+</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="cursor-pointer label justify-start gap-2 p-0">
                                <input type="checkbox" v-model="is_recommended" :checked="is_recommended == 1" />
                                <span class="label-text">Phim đề cử</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex items-center justify-start gap-3">
                    <button @click="edit" class="btn h-10 min-h-10 px-6 bg-green hover:bg-green hover:opacity-80 text-white text-base">
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
import { defineComponent, ref, reactive, toRefs } from 'vue'
import { useRouter } from 'vue-router'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

import { getAllCategory } from '../../../webServices/categoryService'
import { getAllRegion } from '../../../webServices/regionService'
import { getMovie, editMovie } from '../../../webServices/movieService'

export default defineComponent({
    setup() {
        const router = useRouter()

        const tapActive = ref(1)

        const loading = ref(false)

        const loadingSubmit = ref(false)

        const categories = ref([])
        const regions = ref([])

        const fileThumbnail = ref(null)
        const thumbUrl = ref(null)

        const filePoster = ref(null)
        const posterUrl = ref(null)

        const movie = reactive({
            id: null,
            name: '',
            origin_name: '',
            thumb_url: '',
            poster_url: '',
            content: '',
            notify: '',
            showtimes: '',
            trailer_url: '',
            episode_time: '',
            episode_current: '',
            episode_total: '',
            language: '',
            quality: '',
            year: '',
            type: '',
            status: '',
            episode_server_count: 0,
            episode_data_count: 0,
            view_total: 0,
            view_day: 0,
            view_week: 0,
            view_month: 0,
            rating_count: 0,
            rating_star: 0,
            category_ids: [],
            region_ids: [],
            is_show_in_theater: false,
            is_recommended: false,
            is_copyright: false,
            is_sensitive_content: false
        })

        const handleFileThumbnail = async e => {
            fileThumbnail.value = e.target.files[0]

            thumbUrl.value = URL.createObjectURL(fileThumbnail.value)
        }

        const handleFilePoster = async e => {
            filePoster.value = e.target.files[0]

            posterUrl.value = URL.createObjectURL(filePoster.value)
        }

        const edit = async e => {
            e.preventDefault()
            loadingSubmit.value = true

            const data = await editMovie(movie.id, movie)

            if (data && data.success) {
                router.push({ name: 'dashboard-movie' })
            }

            loadingSubmit.value = false
        }

        const cancel = e => {
            e.preventDefault()
            router.push({ name: 'dashboard-movie' })
        }

        return {
            tapActive,
            loading,
            loadingSubmit,
            categories,
            regions,
            fileThumbnail,
            thumbUrl,
            filePoster,
            posterUrl,
            ...toRefs(movie),
            handleFileThumbnail,
            handleFilePoster,
            edit,
            cancel,
            editor: ClassicEditor,
            editorConfig: {}
        }
    },
    methods: {
        async getData() {
            this.loading = true

            const id = this.$route.params.id

            const [movie, categories, regions] = await Promise.all([getMovie(id), getAllCategory(), getAllRegion()])

            if (categories && categories.success) this.categories = categories.categories
            if (regions && regions.success) this.regions = regions.regions
            if (movie && movie.success) {
                this.id = movie.movie.id
                this.name = movie.movie.name
                this.origin_name = movie.movie.origin_name
                this.thumb_url = movie.movie.thumb_url
                this.poster_url = movie.movie.poster_url
                this.content = movie.movie.content
                this.notify = movie.movie.notify
                this.showtimes = movie.movie.showtimes
                this.trailer_url = movie.movie.trailer_url
                this.episode_time = movie.movie.episode_time
                this.episode_current = movie.movie.episode_current
                this.episode_total = movie.movie.episode_total
                this.language = movie.movie.language
                this.quality = movie.movie.quality
                this.year = movie.movie.year
                this.type = movie.movie.type
                this.status = movie.movie.status
                this.episode_server_count = movie.movie.episode_server_count
                this.episode_data_count = movie.movie.episode_data_count
                this.view_total = movie.movie.view_total
                this.view_day = movie.movie.view_day
                this.view_week = movie.movie.view_week
                this.view_month = movie.movie.view_month
                this.rating_count = movie.movie.rating_count
                this.rating_star = movie.movie.rating_star
                this.category_ids = movie.movie.categories.map(category => category.id)
                this.region_ids = movie.movie.regions.map(region => region.id)
                this.is_show_in_theater = Boolean(movie.movie.is_show_in_theater)
                this.is_recommended = Boolean(movie.movie.is_recommended)
                this.is_copyright = Boolean(movie.movie.is_copyright)
                this.is_sensitive_content = Boolean(movie.movie.is_sensitive_content)
            }

            this.loading = false
        },
        toggleCategory(id) {
            const index = this.category_ids.indexOf(id)
            if (index !== -1) {
                this.category_ids.splice(index, 1)
            } else {
                this.category_ids.push(id)
            }
        },
        toggleRegion(id) {
            const index = this.region_ids.indexOf(id)
            if (index !== -1) {
                this.region_ids.splice(index, 1)
            } else {
                this.region_ids.push(id)
            }
        }
    },
    computed: {},
    created() {
        this.getData()
    }
})
</script>

<style scoped>
.ck-editor__editable {
    min-height: 500px;
}
</style>
