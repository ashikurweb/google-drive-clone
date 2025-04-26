<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from '@inertiajs/vue3';

const { files } = defineProps({
    files: Object
});

function openFolder ( file ) {
    if ( !file.is_folder ) {
        return;
    }

    router.visit( route( 'myFiles', { folder: file.path } ) );
}
</script>

<template>
    <AuthenticatedLayout>
        <table class="min-w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Name
                    </th>
                    <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Owner
                    </th>
                    <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Last Modified
                    </th>
                    <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                        Size
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file of files.data" :key="file.id"
                    @click="openFolder(file)"
                    class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                >
                    <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                       {{ file.name }} 
                    </td>
                    <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{ file.owner }}
                    </td>
                    <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{ file.updated_at }}
                    </td>
                    <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{ file.size }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-if="!files.data.length" class="py-8 text-center text-lg text-gray-600">
            There are no data in this folder
        </div>
    </AuthenticatedLayout>
</template>