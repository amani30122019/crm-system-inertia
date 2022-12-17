<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
defineProps(['posts'])
</script>

<template>

    <Head title="Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <div class="flex flex-col">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="flex bg-gray-800 justify-between items=center p-5">
                            <div class="flex space-x-2 items-center text-white">
                                <input type="text" name="searchQuery" placeholder="Searching.....">
                            </div>
                            <div class="flex space-x-2 items-center">
                                <Link :href="route('posts.create')"
                                    class="px-4 py-2 bg-green-500 uppercase text-white rounded focus:outline-none flex items-center">
                                <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> Add
                                new Post
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <Table :resource="posts" :striped="true" :prevent-overlapping-requests="false" class="mt-3"
                            :input-debounce-ms="1000" :preserve-scroll="true" />
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>