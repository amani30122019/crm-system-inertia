<script setup>
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Notifications from '@/Components/Notifications.vue'
import { ref } from 'vue'
const toogleSidebarValue = ref(true)
const toogleSidebarAction = () => toogleSidebarValue.value = !toogleSidebarValue.value
</script>
<template>
    <div class=" flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <Sidebar :isSidebarOpen="toogleSidebarValue" :showSidebar="toogleSidebarAction" />
        <!-- nav and page content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <Navbar :isSidebarOpen="toogleSidebarValue" :showSidebar="toogleSidebarAction" />
            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <!-- notification -->
                    <Notifications :message="$page.props.flash.message" />
                    <slot name="header" />
                </div>
            </header>
            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>


</template>
