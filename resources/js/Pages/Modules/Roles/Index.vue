<script setup>
import {Link, Head} from "@inertiajs/inertia-vue3";
import {ArrowNarrowRightIcon, PlusIcon } from '@heroicons/vue/solid'


const props = defineProps({
    rowData: Object,
});

</script>

<template>
    <AppLayout title="Roles">
        <div class="px-4 sm:px-6 lg:px-8">

            <div class="sm:flex sm:items-center">

                <div class="sm:flex-auto">

                    <h1 class="text-xl font-semibold text-gray-900">Roles</h1>

                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

                    <Link :href="route('admin.roles.create')"
                          preserve-state
                          preserve-scroll
                          :only="['basePageRoute', 'editing', 'modal']"
                          class="uppercase inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">

                        <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true"/>

                        {{ __('Create') }}

                    </Link>

                </div>

            </div>

            <ul role="list" class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <li v-for="role in props.rowData" :key="role.id" class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                    <Link :href="route('admin.roles.edit', role.id)"  :only="['editing', 'permissions', 'basePageRoute', 'modal']" preserve-state preserve-scroll class="group flex flex-col justify-between bg-white border border-secondary-200 dark:border-secondary-700 p-4 rounded-md overflow-hidden hover:shadow-md">
                        <div class="flex items-center justify-between">
                            <span class="text-xs leading-4 text-secondary-400 dark:text-secondary-500 font-semibold uppercase tracking-wider">{{ role.users_count }} {{ __('Account') }}</span>
                            <div class="flex -space-x-1 overflow-hidden">
                                <img v-for="user in role.users" :key="'user' + user.id" class="inline-block h-6 w-6 rounded-full ring-2 ring-white shadow-solid" :src="user.image" :alt="user.name"  loading="lazy"/>
                            </div>
                        </div>
                        <div>
                            <h3 class="mt-4 flex items-center justify-between">
                                <span class="text-lg leading-6 font-medium text-secondary-900 dark:text-white"> {{ role.display_name }}</span>
                                <span class="uppercase text-xs leading-6 font-medium text-primary-500 dark:text-white float-right"> {{ role.access }}</span>
                            </h3>
                            <p class="mt-1 flex items-center text-sm text-primary-600 group-hover:text-primary-500">
                                {{ __('View details') }}
                                <span class="ml-2">
                                    <ArrowNarrowRightIcon class="w-5 h-5" />
                                </span>
                            </p>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
