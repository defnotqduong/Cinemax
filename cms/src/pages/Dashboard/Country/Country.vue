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
                            <button class="text-white bg-orange-500 rounded font-bold hover:bg-orange-400 transition-all duration-300">
                                <router-link
                                    :to="{
                                        name: 'dashboard-edit-country',
                                        params: {
                                            slug: country.slug
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
                                :for="'modal_delete_' + country.id"
                                class="px-3 py-2 text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                ><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    /></svg
                            ></label>
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
import { getInitialCountry, deleteCountry } from '../../../webServices/countryService'

export default defineComponent({
    setup() {
        const router = useRouter()
        const countries = ref([])
        const loading = ref(false)

        const getCountryList = async () => {
            loading.value = true
            const data = await getInitialCountry()
            if (data.success) {
                countries.value = data.countries
                loading.value = false
            }
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
