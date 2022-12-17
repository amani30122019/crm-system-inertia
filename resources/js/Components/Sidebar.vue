<template>
   <div class="relative min-h-screen md:flex">
      <div :class="isSidebarOpen ? 'side-bar-show' : 'side-bar-hide'" id="side-bar"
         class="absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out z-30 w-64 bg-gray-900 overflow-hidden md:inset-0 sm:w-20 md:relative md:translate-x-0">
         <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
               <Link :href="route('dashboard')">
               <span v-show="isSidebarOpen" class="text-gray-500 text-2xl mx-2 font-semibold">Dashboard</span>
               </Link>
            </div>
         </div>
         <nav class="mt-10">
            <Link
               class="flex items-center mt-4 py-2 px-6  hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100"
               :href="route('dashboard')"
               :class="route().current('dashboard') ? 'text-white text-xl bg-gray-700 rounded-sm' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span v-show="isSidebarOpen" class="mx-3">Home </span>
            </Link>
            <Link v-if="isAdmin()"
               class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               :href="route('roles.index')"
               :class="route().current('roles*') ? 'text-white text-xl bg-gray-700 rounded-sm' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9" />
            </svg>

            <span v-show="isSidebarOpen" class="mx-3">Roles</span>
            </Link>
            <Link v-if="isAdmin()"
               class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               :href="route('permissions.index')"
               :class="route().current('permissions*') ? 'text-white text-xl bg-gray-700 rounded-sm' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <span v-show="isSidebarOpen" class="mx-3">Permissions</span>
            </Link>
            <Link v-if="isAdmin()"
               class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               :href="route('users.index')"
               :class="route().current('users*') ? 'text-white text-xl bg-gray-700 rounded-sm' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <span v-show="isSidebarOpen" class="mx-3">Users</span>
            </Link>
            <Link
               class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               :href="route('posts.index')"
               :class="route().current('posts*') ? 'text-white text-xl bg-gray-700 rounded-sm' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
            </svg>

            <span v-show="isSidebarOpen" class="mx-3">Posts</span>
            </Link>
            <Link
               class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               :href="route('reports.index')"
               :class="route().current('reports*') ? 'text-white text-xl bg-gray-700 rounded-sm' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>

            <span v-show="isSidebarOpen" class="mx-3">Reports</span>
            </Link>
         </nav>
      </div>
   </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
const props = defineProps({
   isSidebarOpen: Boolean,
   showSidebar: Function
})
const isAdmin = () => usePage().props.value.auth.role.every(role => ('admin super-admin').includes(role));
</script>

<style>
#side-bar {
   overflow: hidden;
   transition: 300ms;
}

.side-bar-show {
   width: 220px !important;
}

.side-bar-hide {
   width: 80px !important;
   font-size: medium;
   text-align: center;
}
</style>