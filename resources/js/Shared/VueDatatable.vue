<script setup>
import {ref, computed, watch, onMounted, reactive, defineComponent, defineAsyncComponent} from 'vue'
import {SortDescendingIcon, SortAscendingIcon, PlusIcon} from '@heroicons/vue/outline';
import debounce from "lodash/debounce";
import Pagination from '@/Components/Pagination';
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import SearchFilter from '@/Components/SearchFilter';
import pickBy from "lodash/pickBy";
import ConfirmModal from '@/Shared/ConfirmModal';

const props = defineProps({
    config: Object,
    rowData: Object,
    filters: Object,
});


const fields = props.config.fields

const form = useForm({
    perPage: ref(props.config.perPage),
    page: ref(null),
    search: ref(''),
    field: props.filters.field,
    direction: props.filters.direction,
});

const  params = () => pickBy({perPage: form.perPage, search: form.search, field: form.field, direction: form.direction})

watch(form, debounce(() => {
    Inertia.get(props.config.apiUrl, params(), {replace: true, preserveState: true})
}, 300), {deep: true});

const selectedRow = ref([])
const checked = ref(false)
const indeterminate = computed(() => selectedRow.value.length > 0 && selectedRow.value.length < props.rowData.data.length)

const setDefineAsyncComponent = (path) => defineAsyncComponent(() =>import(`@modules/${path}.vue`))

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

    axios.delete(route('admin.users.destroy', { selected: selectedRow.value })).then(() => {
        Inertia.reload({ only: ['rowData'] })
        confirmingUserDeletion.value = false;
    }).catch(error => {
        confirmingUserDeletion.value = false;
    });
};

</script>
<template>
    <div class="px-4 sm:px-0">
        <ConfirmModal :open="confirmingUserDeletion" @on-close="onCloseModal"></ConfirmModal>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Users</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <Link :href="route('admin.users.create')"
                      preserve-state
                      preserve-scroll
                      :data="pickBy({... params(), ...{ page: props.filters.page }})"
                      class="uppercase inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

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
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">

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
                        <div v-if="selectedRow.length > 0" class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16">
                            <button type="button" class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Bulk edit</button>
                            <button type="button" @click="confirmingUserDeletion = true" class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Delete all</button>
                        </div>
                        <table class="min-w-full table-fixed divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <template v-for="(value, key) in fields">

                                        <th v-if="value['name'] === '__checkbox'" scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                            <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :checked="indeterminate || selectedRow.length === props.rowData.data.length" :indeterminate="indeterminate" @change="selectedRow = $event.target.checked ? props.rowData.data.map((r) => r.id) : []" />
                                        </th>

                                        <th v-else-if="value['name'] === 'id'" @click="sort(value)" scope="col" class="w-12 sm:w-16 py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                            <span class="group inline-flex cursor-pointer">

                                                {{ value['title'] || value['name'] }}

                                                 <span  v-if="value['sortField'] && form.field !== value['name']" class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                                    <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                                </span>

                                                 <span  v-if="value['sortField'] && form.field === value['name']" class="ml-2 flex-none rounded text-gray-400">

                                                    <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                                     <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                                </span>

                                            </span>
                                        </th>

                                        <th v-else-if="value['title'] === '__actions'" scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>

                                        <th v-else  @click="sort(value)" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                             <span class="group inline-flex cursor-pointer">

                                                {{ value['title'] || value['name'] }}

                                                 <span  v-if="value['sortField'] && form.field !== value['name']" class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                                    <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                                </span>

                                                 <span  v-if="value['sortField'] && form.field === value['name']" class="ml-2 flex-none rounded text-gray-400">

                                                    <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                                     <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                                </span>

                                            </span>
                                        </th>

                                    </template>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="row in props.rowData.data" :key="row.id" :class="[selectedRow.includes(row.id) && 'bg-gray-50']">

                                <template v-for="(value, key) in fields">

                                    <td v-if="fields[key]['name'] === '__checkbox'" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                        <div v-if="selectedRow.includes(row.id)" class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                                        <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6" :value="row.id" v-model="selectedRow" />
                                    </td>

                                    <td v-else-if="key === 1" :class="['whitespace-nowrap py-4 pr-3 text-sm font-medium', selectedRow.includes(row.id) ? 'text-indigo-600' : 'text-gray-900']">

                                        {{ row[fields[key]['name']] }}

                                    </td>

                                    <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <component v-if="`${fields[key]['name']}`.includes('__component:')" :is="setDefineAsyncComponent(`${fields[key]['name']}`.replace('__component:', ''))" v-bind="{row: {... row, ... { params: params() }}}"/>
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


