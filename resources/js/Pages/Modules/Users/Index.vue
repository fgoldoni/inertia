<template>
    <AppLayout title="Users">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Users</h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <Link :href="route('admin.users.create')" class="uppercase inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                        Create
                    </Link>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 py-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="col-span-1">
                            <SearchFilter v-model="form.search" @reset="reset"/>
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="col-span-1 sm:col-span-2 lg:col-start-3">
                            <select v-model="form.perPage" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="5">05</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="relative overflow-hidden shadow">
                            <div v-if="selectedUsers.length > 0" class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16">
                                <button type="button" class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Bulk edit</button>
                                <button type="button" class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Delete all</button>
                            </div>
                            <table class="min-w-full table-fixed divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                        <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :checked="indeterminate || selectedUsers.length === users.data.length" :indeterminate="indeterminate" @change="selectedUsers = $event.target.checked ? users.data.map((p) => p.id) : []" />
                                    </th>
                                    <th scope="col" class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="user in users.data" :key="user.id" :class="[selectedUsers.includes(user.id) && 'bg-gray-50']">
                                    <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                        <div v-if="selectedUsers.includes(user.id)" class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                                        <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :value="user.id" v-model="selectedUsers" />
                                    </td>
                                    <td :class="['whitespace-nowrap py-4 pr-3 text-sm font-medium', selectedUsers.includes(user.email) ? 'text-indigo-600' : 'text-gray-900']">
                                        {{ user.name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ user.title }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ user.email }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ user.role }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <Link :href="route('admin.users.edit', {'user': user.id})" preserve-state class="text-indigo-600 hover:text-indigo-900">
                                            Edit<span class="sr-only">, {{ user.name }}</span>
                                        </Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <pagination :data="users"></pagination>
        </div>
    </AppLayout>
</template>

<script setup>

import { computed, ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia'

import AppLayout from '@/Layouts/App.vue';
import SearchFilter from '@/Components/SearchFilter'
import Pagination from '@/Components/Pagination'
import {useForm, Link} from "@inertiajs/inertia-vue3";
import pickBy from 'lodash/pickBy'
import debounce from 'lodash/debounce'
import { PlusIcon } from '@heroicons/vue/solid'

const props = defineProps({
    filters: Object,
    users: Object,
});

const selectedUsers = ref([])
const checked = ref(false)
const indeterminate = computed(() => selectedUsers.value.length > 0 && selectedUsers.value.length < props.users.data.length)

const form = useForm({
    perPage: props.filters.perPage,
    search: props.filters.search,
    role: props.filters.role,
    trashed: props.filters.trashed,
});

watch(form,  debounce((value) => {
    Inertia.get(route('admin.users.index'), pickBy(value), { replace: true, preserveState: true })
}, 300), { deep: true });

const reset = () => {
    form.reset()
};
</script>
