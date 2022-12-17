<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce'
const props = defineProps({
   posts: {
      type: Object,
      default: () => ({}),
   },
   filters: {
      type: Object,
      default: () => ({}),
   },
   can: {
      type: Object,
      default: () => ({}),
   },
})
const destroy = (id) => {
   Inertia.delete(route('posts.destroy', id))
}
let searchQuery = ref(props.filters.searchQuery)
watch(searchQuery, debounce(function (value) {
   Inertia.get('/posts', { searchQuery: value }, { preserveState: true, replace: true })
}, 500));
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
         <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="flex flex-col">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                  <div class="flex bg-gray-400 justify-between items=center p-5">
                     <div class="flex space-x-2 items-center text-white">
                        <input v-model="searchQuery"
                           class=" text-black px-3 py-2 border-2 rounded-lg focus:border-gray-300 focus:ring-gray-600"
                           type="text" placeholder="Searching.....">
                     </div>
                     <div class="flex space-x-2 items-center" v-if="can.create">
                        <Link :href="route('posts.create')"
                           class="px-4 py-2 bg-green-500 uppercase text-white rounded-lg focus:outline-none flex items-center">
                        <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> new Post
                        </Link>
                     </div>
                  </div>
               </div>
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div v-if="props.posts.data.length">
                     <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                           <tr>
                              <th scope="col" class="py-3 px-6">Title</th>
                              <th scope="col" class="py-3 px-6">Description</th>
                              <th v-if="can.edit || can.delete" scope="col" class="py-3 px-6">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="post in posts.data" :key="post.id"
                              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                              <td data-label="Title" class="py-4 px-6">
                                 {{ post.title }}
                              </td>
                              <td data-label="Title" class="py-4 px-6">
                                 {{ post.description }}
                              </td>
                              <td v-if="can.edit || can.delete" class="py-4 px-6 w-48">
                                 <div type="justify-start lg:justify-end" no-wrap>
                                    <Link :href="route('posts.edit', post.id)"
                                       class="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer"
                                       v-if="can.edit">
                                    Edit
                                    </Link>
                                    <Link :href="route('posts.destroy', post.id)" method="delete" as="button"
                                       type="button" class="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer"
                                       v-if="can.delete">
                                    Delete
                                    </Link>
                                    <!-- <BreezeButton @click="destroy(post.id)"
                                       class="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer"
                                       v-if="can.delete">
                                       Delete
                                    </BreezeButton> -->
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="m-2 p-3 flex justify-center">
                        <Pagination :links="posts.links" />
                     </div>
                  </div>
                  <div v-else class=" text-center bg-gray-100 shadow-none rounded-none my-4 mx-3 py-3 px-2">
                     <p class="text-2xl font-normal text-red-600"> No any Post at the moment!!!!!
                        or Not found
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </AuthenticatedLayout>
</template>