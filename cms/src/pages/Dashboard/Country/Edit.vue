<template>
    <div class="py-20">
        <h3 class="text-2xl font-bold mb-10">Chỉnh sửa quốc gia:</h3>
        <div
            v-if="loading"
            class="flex items-center justify-center min-h-[50vh]"
        >
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div
            class="w-[50%] mx-auto px-4 py-2 mb-3 text-center text-lg font-semibold text-white bg-green-400 rounded-md"
            v-if="success"
        >
            Chỉnh sửa thành công
        </div>
        <form v-if="!loading" class="w-[50%] mx-auto" @submit.prevent="edit">
            <label for="title" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Tiều đề:</div>
                <input
                    id="title"
                    type="text"
                    v-model="title"
                    placeholder="Tiêu đề"
                    class="input input-bordered h-10 input-secondary w-full"
                />
                <div v-if="errors && errors.title" class="mt-2 text-primary">
                    {{ errors.title[0] }}
                </div>
            </label>
            <label for="description" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Mô tả:</div>
                <input
                    id="description"
                    type="text"
                    v-model="description"
                    placeholder="Mô tả"
                    class="input input-bordered h-10 input-secondary w-full"
                />
                <div
                    v-if="errors && errors.description"
                    class="mt-2 text-primary"
                >
                    {{ errors.description[0] }}
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
            <button
                class="px-6 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
            >
                <span
                    v-if="loadingSubmit"
                    class="loading loading-spinner text-white"
                ></span>
                <span v-if="!loadingSubmit">Sửa</span>
            </button>
        </form>
    </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue'
import { editCountry, getCountry } from '../../../webServices/countryService'
export default defineComponent({
    setup() {
        const country = reactive({
            title: '',
            slug: '',
            description: '',
            status: 1
        })

        const errors = ref([])
        const success = ref(false)
        const loading = ref(false)
        const loadingSubmit = ref(false)

        const edit = async () => {
            loadingSubmit.value = true
            const data = await editCountry(country)
            console.log(data)
            if (data.success) {
                success.value = true
                errors.value = []
                loadingSubmit.value = false
                setTimeout(() => {
                    success.value = false
                }, 2000)
            } else {
                errors.value = data.data.errors
                loadingSubmit.value = false
            }
        }

        return {
            ...toRefs(country),
            edit,
            success,
            errors,
            loading,
            loadingSubmit
        }
    },
    methods: {
        async getCountryDetails() {
            const slug = this.$route.params.slug
            this.loading = true
            const data = await getCountry(slug)

            if (data.success) {
                this.title = data.country.title
                this.slug = data.country.slug
                this.description = data.country.description
                this.status = data.country.status

                this.loading = false
            }
        }
    },
    mounted() {
        this.getCountryDetails()
    }
})
</script>

<style></style>
