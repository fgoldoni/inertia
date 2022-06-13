<script setup>
import {ref, computed, watch, onMounted, reactive, defineComponent, defineAsyncComponent} from 'vue'
import {SortDescendingIcon} from '@heroicons/vue/outline';
import debounce from "lodash/debounce";
import Pagination from '@/Components/Pagination';
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    config: Object,
    rowData: Object,
});


const apiUrl = props.config.apiUrl
const fields = props.config.fields
const perPage = props.config.perPage


onMounted(() => {
})

const selectedRow = ref([])
const checked = ref(false)
const indeterminate = computed(() => selectedRow.value.length > 0 && selectedRow.value.length < rowData.data.length)

const setDefineAsyncComponent = (path) => defineAsyncComponent(() =>import(`@modules/${path}.vue`))

</script>
<template>
    <div class="px-4 sm:px-0">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Users</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add user</button>
            </div>
        </div>
        <div v-if="rowData" class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div v-if="selectedRow.length > 0" class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16">
                            <button type="button" class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Bulk edit</button>
                            <button type="button" class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Delete all</button>
                        </div>
                        <table class="min-w-full table-fixed divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <template v-for="(value, key) in fields">

                                        <th v-if="value['name'] === '__checkbox'" scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                            <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :checked="indeterminate || selectedRow.length === rowData.data.length" :indeterminate="indeterminate" @change="selectedRow = $event.target.checked ? rowData.data.map((r) => r.id) : []" />
                                        </th>

                                        <th v-else-if="value['name'] === 'id'" scope="col" class="w-12 sm:w-16 py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                            <span class="group inline-flex cursor-pointer">

                                                {{ value['title'] || value['name'] }}

                                                <span  class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                                    <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                                </span>

                                            </span>
                                        </th>

                                        <th v-else-if="value['title'] === '__actions'" scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>

                                        <th v-else  scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                             <span class="group inline-flex cursor-pointer">

                                                {{ value['title'] || value['name'] }}

                                                 <span  class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                                    <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                                </span>

                                            </span>
                                        </th>

                                    </template>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="row in rowData.data" :key="row.id" :class="[selectedRow.includes(row.id) && 'bg-gray-50']">

                                <template v-for="(value, key) in fields">

                                    <td v-if="fields[key]['name'] === '__checkbox'" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                        <div v-if="selectedRow.includes(row.id)" class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                                        <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :value="row.id" v-model="selectedRow" />
                                    </td>

                                    <td v-else-if="key === 1" :class="['whitespace-nowrap py-4 pr-3 text-sm font-medium', selectedRow.includes(row.id) ? 'text-indigo-600' : 'text-gray-900']">

                                        {{ row[fields[key]['name']] }}

                                    </td>

                                    <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <component v-if="`${fields[key]['name']}`.includes('__component:')" :is="setDefineAsyncComponent(`${fields[key]['name']}`.replace('__component:', ''))" v-bind="{row: row}"/>
                                        <span v-else v-text="row[fields[key]['name']]"></span>
                                    </td>

                                </template>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="rowData"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


