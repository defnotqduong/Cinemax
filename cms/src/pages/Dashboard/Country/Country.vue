<template>
    <div class="py-20 mr-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">Quốc gia:</h3>
            <button class="px-3 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300">
                <router-link
                    :to="{
                        name: 'dashboard-create-country'
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
        <div v-if="!loading" class="overflow-x-auto mt-10">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Quốc gia</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(country, index) in countries" :key="country.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ country.title }}</td>
                        <td>{{ country.slug }}</td>
                        <td>{{ country.description }}</td>
                        <td>
                            {{ country.status == 1 ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td class="flex items-center justify-center gap-3">
                            <button class="text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300">
                                <router-link
                                    :to="{
                                        name: 'dashboard-edit-country',
                                        params: {
                                            slug: country.slug
                                        }
                                    }"
                                    class="w-full h-full px-3 py-2 block"
                                >
                                    Sửa
                                </router-link>
                            </button>
                            <label
                                :for="'modal_delete_' + country.id"
                                class="px-3 py-2 text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                >Xóa</label
                            >
                            <input type="checkbox" :id="'modal_delete_' + country.id" class="modal-toggle" />
                            <div class="modal" role="dialog">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Xác nhận!</h3>
                                    <p class="py-4">
                                        Xóa quốc gia
                                        <span class="font-bold">{{ country.title }}</span>
                                    </p>
                                    <div class="modal-action">
                                        <label
                                            @click="deleteGen(country.id)"
                                            :for="'modal_delete_' + country.id"
                                            class="btn text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                        >
                                            Xóa
                                        </label>
                                        <label :for="'modal_delete_' + country.id" class="btn">Hủy!</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'
import { getAllCountry, deleteCountry } from '../../../webServices/countryService'

export default defineComponent({
    setup() {
        const router = useRouter()
        const countries = ref([])
        const loading = ref(false)

        const getCountryList = async () => {
            loading.value = true
            const data = await getAllCountry()
            countries.value = data.countries.data
            loading.value = false
        }

        const deleteCoun = async id => {
            const data = await deleteCountry(id)
            if (data.status === 401) {
                router.push({ name: 'auth-login' })
                return
            }

            if (data.success) {
                getCountryList()
            }
        }

        getCountryList()

        return { loading, countries, deleteCoun }
    }
})
</script>

<style></style>
