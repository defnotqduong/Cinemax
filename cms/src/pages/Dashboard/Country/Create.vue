<template>
    <div class="py-20 px-10">
        <h3 class="text-2xl font-bold mb-10">Thêm quốc gia:</h3>
        <div v-if="success" role="alert" class="alert bg-green-400 text-white w-[20%] fixed top-10 right-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Thêm thành công</span>
        </div>
        <form class="w-[50%] mx-auto" @submit.prevent="create">
            <label for="title" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Tiều đề:</div>
                <input id="title" type="text" v-model="title" placeholder="Tiêu đề" class="input input-bordered h-10 input-secondary w-full" />
                <div v-if="errors && errors.title" class="mt-2 text-primary">
                    {{ errors.title[0] }}
                </div>
            </label>
            <label for="description" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Mô tả:</div>
                <input id="description" type="text" v-model="description" placeholder="Mô tả" class="input input-bordered h-10 input-secondary w-full" />
                <div v-if="errors && errors.description" class="mt-2 text-primary">
                    {{ errors.description[0] }}
                </div>
            </label>
            <label for="status" class="block mb-6">
                <div class="text-lg font-semibold mb-3">Trạng thái:</div>
                <select class="select select-secondary w-full h-10" id="status" v-model="status">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
                <div v-if="errors && errors.status" class="mt-2 text-primary">
                    {{ errors.status[0] }}
                </div>
            </label>
            <button class="px-6 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300">
                <span v-if="loading" class="loading loading-spinner text-white"></span>
                <span v-if="!loading">Thêm</span>
            </button>
        </form>
    </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue'
import { useRouter } from 'vue-router'
import { createCountry } from '../../../webServices/countryService'
export default defineComponent({
    setup() {
        const country = reactive({
            title: '',
            description: '',
            status: 1
        })

        const router = useRouter()
        const errors = ref([])
        const success = ref(false)
        const loading = ref(false)

        const create = async () => {
            loading.value = true
            const data = await createCountry(country)

            if (data && data.status === 401) {
                router.push({ name: 'auth-login' })
                return
            }

            if (data && data.success) {
                success.value = true
                errors.value = []
                loading.value = false
                setTimeout(() => {
                    success.value = false
                }, 2000)
                country.title = ''
                country.description = ''
                country.status = 1
                return
            }

            errors.value = data && data.data.errors
            loadingSubmit.value = false
        }

        return {
            ...toRefs(country),
            create,
            success,
            errors,
            loading
        }
    }
})
</script>

<style></style>
