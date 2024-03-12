<template>
    <div class="navbar py-3">
        <div class="flex-1">
            <router-link :to="{ name: 'dashboard-homepage' }" class="text-xl font-extrabold px-4">Movie</router-link>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end px-4">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-8 rounded-full">
                        <img alt="Tailwind CSS Navbar component" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-[160px]">
                    <li><a>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>

<style></style>
