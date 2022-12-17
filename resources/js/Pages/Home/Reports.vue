<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
</script>

<template>

   <Head title="Reports" />

   <AuthenticatedLayout>
      <template #header>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
         </h2>
      </template>
      <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">                 
                <a :href="route('reports.users')" target=_blank  class="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer">
                                    User report in pdf
                </a>              
               <a :href="route('reports.posts')" target=_blank  class="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer">
                                    Posts report in pdf
               </a>               
               </div>
            </div>
         </div>
      </div>
   </AuthenticatedLayout>
</template>
