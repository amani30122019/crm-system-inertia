<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
   roles: {
      type: Object,
      default: () => ({}),
   },
   can: {
      type: Object,
      default: () => ({}),
   },
})
const destroy = (id) => {
   Inertia.delete(route('roles.destroy', id))
}
</script>

<template>

   <Head title="Roles" />

   <AuthenticatedLayout>
      <template #header>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles
         </h2>
      </template>

      <div class="py-12">
         <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div v-if="props.roles.data.length" class="flex flex-col">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                  <div class="flex bg-gray-800 justify-between items=center p-5">
                     <div class="flex space-x-2 items-center text-white">
                        Roles Available in the Database
                     </div>
                     <div class="flex space-x-2 items-center" v-if="can.create">
                        <Link :href="route('roles.create')"
                           class="px-4 py-2 bg-green-500 uppercase text-white rounded focus:outline-none flex items-center">
                        <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> Add new Role
                        </Link>
                     </div>
                  </div>
               </div>
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                     <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                           <th scope="col" class="py-3 px-6">Name</th>
                           <th v-if="can.edit || can.delete" scope="col" class="py-3 px-6">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="role in roles.data" :key="role.id"
                           class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                           <td data-label="Title" class="py-4 px-6">
                              {{ role.name }}
                           </td>
                           <td v-if="can.edit || can.delete" class="py-4 px-6 w-48">
                              <div type="justify-start lg:justify-end" no-wrap>
                                 <Link :href="route('roles.edit', role.id)"
                                    class="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer"
                                    v-if="can.edit">
                                 Edit
                                 </Link>
                                 <BreezeButton @click="destroy(role.id)"
                                    class="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer"
                                    v-if="can.delete">
                                    Delete
                                 </BreezeButton>

                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div v-else class=" text-center bg-gray-100 shadow-none rounded-none">
               <p class="text-3xl font-normal text-red-600"> No any Role at the moment!!!!!
                  <span class="bg-gray-300 px-2 py-1 rounded-lg mx-3 hover:bg-gray-400 cursor-pointer text-black">
                     <Link :href="route('roles.create')">Create new role from here</Link>
                  </span>
               </p>
            </div>
         </div>
      </div>
   </AuthenticatedLayout>
</template>