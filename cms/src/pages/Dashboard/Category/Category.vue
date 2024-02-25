<template>
    <div class="py-20 mr-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">Danh mục:</h3>
            <button
                class="px-3 py-2 text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
            >
                <router-link
                    :to="{
                        name: 'dashboard-create-category'
                    }"
                    class="w-full h-full block"
                >
                    Thêm mới
                </router-link>
            </button>
        </div>
        <div
            class="w-full flex items-center justify-center min-h-[50vh]"
            v-if="loading"
        >
            <span class="loading loading-spinner text-white"></span>
        </div>
        <div v-if="!loading" class="overflow-x-auto mt-10">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Danh mục</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(category, index) in categories"
                        :key="category.id"
                    >
                        <th>{{ index + 1 }}</th>
                        <td>{{ category.title }}</td>
                        <td>{{ category.slug }}</td>
                        <td>{{ category.description }}</td>
                        <td>
                            {{ category.status == 1 ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td class="flex items-center justify-center gap-3">
                            <button
                                class="text-white bg-green-500 rounded font-bold hover:bg-green-400 transition-all duration-300"
                            >
                                <router-link
                                    :to="{
                                        name: 'dashboard-edit-category',
                                        params: {
                                            slug: category.slug
                                        }
                                    }"
                                    class="w-full h-full px-3 py-2 block"
                                >
                                    Chỉnh sửa
                                </router-link>
                            </button>
                            <label
                                :for="'modal_delete_' + category.id"
                                class="px-3 py-2 text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                >Xóa</label
                            >
                            <input
                                type="checkbox"
                                :id="'modal_delete_' + category.id"
                                class="modal-toggle"
                            />
                            <div class="modal" role="dialog">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Xác nhận!</h3>
                                    <p class="py-4">
                                        Xóa danh mục {{ category.title }}
                                    </p>
                                    <div class="modal-action">
                                        <label
                                            @click="deleteCat(category.id)"
                                            :for="'modal_delete_' + category.id"
                                            class="btn text-white bg-primary rounded font-bold cursor-pointer hover:bg-primary-alpha transition-all duration-300"
                                        >
                                            Xóa
                                        </label>
                                        <label
                                            :for="'modal_delete_' + category.id"
                                            class="btn"
                                            >Hủy!</label
                                        >
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
import {
    getAllCategory,
    deleteCategory
} from '../../../webServices/categoryService'

export default defineComponent({
    setup() {
        const categories = ref([])
        const loading = ref(false)

        const getCategoryList = async () => {
            loading.value = true
            const data = await getAllCategory()
            categories.value = data.categories.data
            loading.value = false
        }

        const deleteCat = async id => {
            const data = await deleteCategory(id)
            if (data.success) {
                getCategoryList()
            }
        }

        getCategoryList()

        return { loading, categories, deleteCat }
    }
})
</script>

<style></style>
