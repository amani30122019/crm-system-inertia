<template>

   <Head title="Create-Role" />
   <AuthenticatedLayout>

      <template #header>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles-Dashboard
         </h2>
      </template>
      <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-[480px] bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                  <form @submit.prevent="addRole">
                     <div>
                        <InputLabel for="name" value="Role name" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                           autofocus autocomplete="off" />
                        <InputError class="mt-2" :message="form.errors.name" />
                     </div>
                     <div class="flex items-center justify-start mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                           :disabled="form.processing">
                           {{ form.processing ? 'Saving.......' : 'Save' }}
                        </PrimaryButton>
                        <Link :href="route('roles.index')"
                           class="ml-4 inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white  tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray transition ease-in-out duration-150"
                           :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Cancel
                        </Link>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';

const form = useForm({
   name: ''
});
const addRole = () => {
   form.post(route('roles.store'), {
      onSuccess: () => form.reset('name')
   });
};

</script>

