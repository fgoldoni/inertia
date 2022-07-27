<script setup>
import {ref, computed, watch, defineAsyncComponent} from 'vue'
import {SortDescendingIcon, SortAscendingIcon, PlusIcon} from '@heroicons/vue/outline';
import debounce from "lodash/debounce";
import Pagination from '@/Components/Pagination.vue';
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import SearchFilter from '@/Components/SearchFilter.vue';
import pickBy from "lodash/pickBy";
import ConfirmModal from '@/Shared/ConfirmModal.vue';
import {ElNotification} from "element-plus";

const props = defineProps({
    config: Object,
    rowData: Object,
    filters: Object,
});


const fields = props.config.fields

const form = useForm({
    perPage: ref(props.config.perPage),
    page: ref(props.filters.page),
    search: ref(props.filters.search),
    field: props.filters.field,
    direction: props.filters.direction,
});

const  params = () => pickBy({perPage: form.perPage, search: form.search, field: form.field, direction: form.direction})

watch(form, debounce(() => {
    Inertia.get(props.config.apiUrl, params(), {replace: true, preserveState: true})
}, 500), {deep: true});

const selectedRow = ref([])
const checked = ref(false)
const indeterminate = computed(() => selectedRow.value.length > 0 && selectedRow.value.length < props.rowData.data.length)

const setDefineAsyncComponent = (path) => defineAsyncComponent(() =>import(`../Pages/Modules/${path}.vue`))

const reset = () => {
    form.page = ref(null)
    form.perPage = ref(props.config.perPage)
    form.field = ref(null)
    form.direction = ref(null)
    form.search = ref('')
};

const updateSearch = (value) => form.search = value

const sort = (field) => {

    if (field.sortField) {
        form.field = field.sortField;
        form.direction = form.direction === 'asc' ? 'desc' : 'asc';
    }
};

const confirmingUserDeletion = ref(false);

const onCloseModal = (state) => {
    if(!state) return confirmingUserDeletion.value = false;

    axios.delete(route(props.config.deleteUri, { selected: selectedRow.value })).then((response) => {
        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })
        Inertia.reload({ only: ['rowData'] })
        confirmingUserDeletion.value = false;
    }).catch(error => {
        confirmingUserDeletion.value = false;
        ElNotification({
            title: error.response.statusText,
            message: error.response.data.message,
            type: 'error',
        })
    });
};

</script>
<template>
    <div class="px-4 sm:px-0">
        <ConfirmModal :open="confirmingUserDeletion" @on-close="onCloseModal"></ConfirmModal>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-secondary-900">{{ props.config.title }}</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none" v-if="props.config.createUrl && $page.props.can.create">
                <Link :href="props.config.createUrl"
                      preserve-state
                      preserve-scroll
                      :data="pickBy({... params(), ...{ page: props.filters.page }})"
                      class="uppercase inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">

                    <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true"/>

                    {{ __('Create') }}

                </Link>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 py-4">

            <div class="col-span-1 sm:col-span-2">

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    <div class="col-span-1">

                        <SearchFilter v-model="form.search" @on-model-value="updateSearch" @reset="reset"/>

                    </div>

                </div>

            </div>

            <div class="col-span-1">

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    <div class="col-span-1 sm:col-span-2 lg:col-start-3">

                        <select v-model="form.perPage"
                                class="block w-full pl-3 pr-10 py-2 text-base border-secondary-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">

                            <option value="5">05</option>

                            <option value="10">10</option>

                            <option value="25">25</option>

                            <option value="50">50</option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div v-if="props.rowData" class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5">
                        <div v-if="selectedRow.length > 0" class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-secondary-50 sm:left-16">
                            <button type="button" class="inline-flex items-center rounded border border-secondary-300 bg-white px-2.5 py-1.5 text-xs font-medium text-secondary-700 shadow-sm hover:bg-secondary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30"> CSV (Coming soon)</button>
                            <button v-if="props.config.createUrl && $page.props.can.delete" type="button" @click="confirmingUserDeletion = true" class="inline-flex items-center rounded border border-negative-300 bg-negative-50 px-2.5 py-1.5 text-xs font-medium text-negative-700 shadow-sm hover:bg-negative-100 focus:outline-none focus:ring-2 focus:ring-negative-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Delete all</button>
                        </div>
                        <table class="min-w-full table-fixed divide-y divide-secondary-300">
                            <thead class="bg-secondary-50">
                                <tr>
                                    <template v-for="(value, key) in fields">

                                        <th v-if="value['name'] === '__checkbox'" scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                            <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-secondary-300 text-primary-600 focus:ring-primary-500 sm:left-6" :checked="indeterminate || selectedRow.length === props.rowData.data.length" :indeterminate="indeterminate" @change="selectedRow = $event.target.checked ? props.rowData.data.map((r) => r.id) : []" />
                                        </th>

                                        <th v-else-if="value['name'] === 'id'" @click="sort(value)" scope="col" class="w-12 sm:w-16 py-3.5 pr-3 text-left text-sm font-semibold text-secondary-900">
                                            <span class="group inline-flex cursor-pointer">

                                                {{ value['title'] || value['name'] }}

                                                 <span  v-if="value['sortField'] && form.field !== value['name']" class="invisible ml-2 flex-none rounded text-secondary-400 group-hover:visible group-focus:visible">

                                                    <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-secondary-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                                </span>

                                                 <span  v-if="value['sortField'] && form.field === value['name']" class="ml-2 flex-none rounded text-secondary-400">

                                                    <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-secondary-400" aria-hidden="true" />

                                                     <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-secondary-400" aria-hidden="true" />

                                                </span>

                                            </span>
                                        </th>

                                        <th v-else-if="value['title'] === '__actions'" scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>

                                        <th v-else  @click="sort(value)" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-secondary-900">
                                             <span class="group inline-flex cursor-pointer">

                                                {{ value['title'] || value['name'] }}

                                                 <span  v-if="value['sortField'] && form.field !== value['name']" class="invisible ml-2 flex-none rounded text-secondary-400 group-hover:visible group-focus:visible">

                                                    <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-secondary-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                                </span>

                                                 <span  v-if="value['sortField'] && form.field === value['name']" class="ml-2 flex-none rounded text-secondary-400">

                                                    <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-secondary-400" aria-hidden="true" />

                                                     <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-secondary-400" aria-hidden="true" />

                                                </span>

                                            </span>
                                        </th>

                                    </template>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-secondary-200 bg-white">
                            <tr v-for="row in props.rowData.data" :key="row.id" :class="[selectedRow.includes(row.id) ? 'bg-primary-100' : 'even:bg-secondary-100 odd:bg-white']">

                                <template v-for="(value, key) in fields">

                                    <td v-if="fields[key]['name'] === '__checkbox'" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                        <div v-if="selectedRow.includes(row.id)" class="absolute inset-y-0 left-0 w-0.5 bg-primary-600"></div>
                                        <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-secondary-300 text-primary-600 focus:ring-primary-500 sm:left-6" :value="row.id" v-model="selectedRow" />
                                    </td>

                                    <td v-else-if="key === 1" :class="['whitespace-nowrap py-4 pr-3 text-sm font-medium', selectedRow.includes(row.id) ? 'text-primary-600' : 'text-secondary-900']">

                                        {{ row[fields[key]['name']] }}

                                    </td>

                                    <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">
                                        <component v-if="`${fields[key]['name']}`.includes('__component:')" :is="setDefineAsyncComponent(`${fields[key]['name']}`.replace('__component:', ''))" v-bind="{row: {... row, ... { params: {... params(), ...{ page: props.filters.page }} }}}"/>
                                        <span v-else v-text="row[fields[key]['name']]"></span>
                                    </td>

                                </template>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="props.rowData"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


