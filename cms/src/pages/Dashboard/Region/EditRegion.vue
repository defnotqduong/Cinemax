<template>
    <div class="mt-[8px] mb-24 pr-6 pl-8">
        <div class="text-sm breadcrumbs">
            <ul class="justify-start">
                <li><router-link :to="{ name: 'dashboard-homepage' }" class="text-primary">Quản trị</router-link></li>
                <li><router-link :to="{ name: 'dashboard-region' }" class="text-primary">Khu vực</router-link></li>
                <li>Chỉnh sửa khu vực</li>
            </ul>
        </div>
        <form>
            <div v-if="loading" class="flex items-center justify-center min-h-[30vh]">
                <span class="loading loading-spinner text-primary"></span>
            </div>
            <div v-if="!loading" class="w-[75%] mt-5 text-[15px]">
                <div class="p-6 bg-white border-[1px] border-gray-400 rounded-lg">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-4">
                        <label for="name">
                            <div class="mb-2 text-gray-700 font-bold" :class="errors.hasOwnProperty('name') ? 'text-red-500' : 'text-gray-700'">Tên khu vực <span class="text-red-500">*</span></div>
                            <input
                                type="text"
                                id="name"
                                v-model="name"
                                placeholder="Tên khu vực"
                                class="input rounded-md outline-none bg-white h-10 w-full focus:outline-none placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                                :class="errors.hasOwnProperty('name') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-gray-500'"
                            />
                            <div v-if="errors.hasOwnProperty('name')" class="mt-1">
                                <p v-for="(message, index) in errors.name" :key="index" class="text-red-500">{{ message }}</p>
                            </div>
                        </label>
                        <label for="des">
                            <div class="mb-2 text-gray-700 font-bold">Description</div>
                            <input
                                type="text"
                                id="des"
                                v-model="des"
                                placeholder=""
                                class="input rounded-md border-gray-300 outline-none bg-white h-10 w-full focus:outline-none focus:border-gray-500 placeholder:text-sm placeholder:text-gray-400 transition-all duration-300"
                            />
                        </label>
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
import { defineComponent, ref, toRefs, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { getRegion, editRegion } from '../../../webServices/regionService'
export default defineComponent({
    setup() {
        const router = useRouter()

        const region = reactive({
            id: null,
            name: '',
            des: ''
        })

        const loading = ref(false)

        const loadingSubmit = ref(false)

        const errors = ref({})

        const edit = async e => {
            e.preventDefault()
            loadingSubmit.value = true

            const data = await editRegion(region.id, region)

            if (data && data.status === 422) errors.value = data.data.errors

            if (data && data.success) {
                router.push({ name: 'dashboard-region' })
            }

            loadingSubmit.value = false
        }
        const cancel = e => {
            e.preventDefault()
            router.push({ name: 'dashboard-region' })
        }

        return {
            ...toRefs(region),
            loading,
            loadingSubmit,
            errors,
            edit,
            cancel
        }
    },
    methods: {
        async getData() {
            this.loading = true

            const id = this.$route.params.id

            const [region] = await Promise.all([getRegion(id)])

            if (region && region.status === 404) this.$router.push({ name: 'dashboard-region' })

            if (region && region.success) {
                this.id = region.region.id
                this.name = region.region.name
                this.des = region.region.des
            }

            this.loading = false
        }
    },
    created() {
        this.getData()
    }
})
</script>

<style></style>
