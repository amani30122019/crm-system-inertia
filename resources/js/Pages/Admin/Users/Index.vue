<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { onMounted } from 'vue';


const props = defineProps({
   users: {
      type: Object,
      default: () => ({}),
   },
   can: {
      type: Object,
      default: () => ({}),
   },
})
onMounted(() => console.log('object', props.can))
const destroy = (id) => {
   Inertia.delete(route('users.destroy', id))
}
</script>
<template>

   <Head title="Users" />
   <AuthenticatedLayout>
      <template #header>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
         </h2>
      </template>
      <div class="py-12">
         <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div v-if="props.users.data.length" class="flex flex-col">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                  <div class="flex bg-gray-300 justify-between items=center p-5">
                     <div class="flex space-x-2 items-center text-black">
                        Users Available in the Database
                     </div>
                     <div class="flex space-x-2 items-center" v-if="can.create">
                        <Link :href="route('users.create')"
                           class="px-4 py-2 bg-green-500 uppercase text-white rounded-lg focus:outline-none flex items-center">
                        <span class="iconify mr-1" data-icon="gridicons:create" data-inline="false"></span> New user
                        </Link>
                     </div>
                  </div>
               </div>
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                     <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-black font-bold">
                           <th scope="col" class="py-3 px-6">Name</th>
                           <th scope="col" class="py-3 px-6">Email</th>
                           <th scope="col" class="py-3 px-6">Roles</th>
                           <th v-if="can.edit || can.delete" scope="col" class="py-3 px-6 text-center">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="user in users.data" :key="user.id"
                           :class="user.role.toString() == 'super-admin' ? 'hidden' : ''"
                           class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                           <td data-label="Name" class="py-4 px-6">
                              {{ user.name }}
                           </td>
                           <td data-label="Email" class="py-4 px-6">
                              {{ user.email }}
                           </td>
                           <td data-label="Email" class="py-4 px-6">
                              <h3 class="bg-slate-900 text-white text-center rounded-b-full font-bold">
                                 {{ user.role.toString() }}
                              </h3>
                           </td>
                           <td v-if="can.edit || can.delete" class="py-4 px-6">
                              <div type="justify-start lg:justify-end" no-wrap>
                                 <Link :href="route('users.edit', user.id)"
                                    class="ml-4 bg-green-500 px-2 py-1 rounded text-white hover:bg-green-700 cursor-pointer"
                                    v-if="can.edit">
                                 Edit
                                 </Link>
                                 <BreezeButton @click="destroy(user.id)"
                                    class="ml-4 bg-red-500 px-2 py-1 rounded hover:bg-red-700 text-white cursor-pointer"
                                    v-if="can.delete">
                                    Delete
                                 </BreezeButton>
                                 <Link :href="route('users.show', user.id)"
                                    class="ml-4 bg-sky-500 px-2 py-1 rounded hover:bg-sky-700 text-white cursor-pointer"
                                    v-if="can.delete">
                                 Profile
                                 </Link>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div v-else class=" text-center bg-gray-100 shadow-none rounded-none sm:block">
               <p class="text-3xl font-normal text-red-600"> No any User at the moment!!!!!
                  <span class="bg-gray-300 px-2 py-1 rounded-lg mx-3 hover:bg-gray-400 cursor-pointer text-black">
                     <Link :href="route('users.create')">Create new user from here</Link>
                  </span>
               </p>
            </div>
         </div>
      </div>
   </AuthenticatedLayout>
</template>