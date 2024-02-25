<template>
    <div class="fixed top-0 left-0 h-[100vh] overflow-y-auto">
        <ul class="menu bg-base-200 w-56 min-h-[100vh] rounded-box py-8 gap-2">
            <div class="w-[150px] mb-4">
                <img
                    src="../../assets/images/logo.png"
                    alt="Logo"
                    class="w-full object-cover object-center"
                />
            </div>
            <li><a>Thể loại</a></li>
            <li>
                <router-link :to="{ name: 'dashboard-category' }" class="active"
                    >Danh mục</router-link
                >
            </li>
            <li><a>Quốc gia</a></li>
            <li>
                <details open>
                    <summary>Phim</summary>
                    <ul>
                        <li><a>Thêm phim</a></li>
                        <li><a>Chỉnh sửa phim</a></li>
                        <li><a>Thêm tập phim</a></li>
                    </ul>
                </details>
            </li>
            <div class="mt-auto">Admin</div>
        </ul>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({})
</script>

<style></style>
