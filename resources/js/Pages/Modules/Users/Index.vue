<script setup>
import {computed, ref, watch, reactive} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {PlusIcon, ShieldCheckIcon, PencilAltIcon, UserCircleIcon, RefreshIcon, ShieldExclamationIcon} from '@heroicons/vue/solid';
import {SortAscendingIcon, SortDescendingIcon, ExternalLinkIcon} from '@heroicons/vue/outline';
import {useForm, Link, Head} from "@inertiajs/inertia-vue3";
import pickBy from 'lodash/pickBy';
import debounce from 'lodash/debounce';
import SearchFilter from '@/Components/SearchFilter';
import Pagination from '@/Components/Pagination';
import ConfirmModal from '@/Shared/ConfirmModal';


const props = defineProps({
    filters: Object,
    users: Object,
});

const selectedUsers = ref([]);

const confirmingUserDeletion = ref(false);

const formVerification = reactive({
    password: '',
    processing: false,
});


const form = useForm({
    perPage: props.filters.perPage || 5,
    page: props.filters.page,
    search: props.filters.search,
    field: props.filters.field,
    direction: props.filters.direction,
    role: props.filters.role,
    trashed: props.filters.trashed,
});

const indeterminate = computed(() => selectedUsers.value.length > 0 && selectedUsers.value.length < props.users.data.length)

watch(form, debounce(() => {
    Inertia.get(route('admin.users.index'), queryString(), {replace: true, preserveState: true})
}, 300), {deep: true});

const  queryString = () => pickBy({perPage: form.perPage, page: form.page, search: form.search, field: form.field, direction: form.direction})

const reset = () => form.reset();
const updateSearch = (value) => form.search = value

const sort = (name) => {
    form.field = name;
    form.direction = form.direction === 'asc' ? 'desc' : 'asc';
};

const sendEmailVerificationNotification = (id) => {
    formVerification.processing = true;

    return axios.get(route('admin.users.verification.send', { user: id })).then(response => {
        formVerification.processing = false;
        Inertia.reload({ only: ["flash"] });
        console.log(response.data.message)
    });
};

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const onCloseModal = (state) => {
    if(!state) return confirmingUserDeletion.value = false;

    axios.delete(route('admin.users.destroy', { selected: selectedUsers.value })).then(() => {
        Inertia.reload({ only: ['users'] })
        confirmingUserDeletion.value = false;
    }).catch(error => {
        confirmingUserDeletion.value = false;
    });
};

</script>

<template>

    <Head title="Users"></Head>

    <ConfirmModal :open="confirmingUserDeletion" @on-close="onCloseModal"></ConfirmModal>

    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center">

            <div class="sm:flex-auto">

                <h1 class="text-xl font-semibold text-gray-900">Users</h1>

            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

                <Link :href="route('admin.users.create')"
                      preserve-state
                      preserve-scroll
                      :data="queryString()"
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

        <div class="flex flex-col">

            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">

                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">

                    <div class="relative overflow-hidden shadow">

                        <div v-if="selectedUsers.length > 0"
                             class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16">

                            <button type="button"
                                    class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">

                                Bulk edit

                            </button>

                            <button type="button" @click="confirmUserDeletion"
                                    class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">

                                Delete all

                            </button>

                        </div>

                        <table class="min-w-full table-fixed divide-y divide-gray-300">

                            <thead class="bg-gray-50">

                            <tr>

                                <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">

                                    <input type="checkbox"
                                           class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                           :checked="indeterminate || selectedUsers.length === users.data.length"
                                           :indeterminate="indeterminate"
                                           @change="selectedUsers = $event.target.checked ? users.data.map((p) => p.id) : []"/>

                                </th>

                                <th scope="col" @click="sort('id')" class="w-12 sm:w-16 py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">

                                    <span class="group inline-flex cursor-pointer">

                                        {{ __('ID') }}

                                        <span  v-if="form.field !== 'id'" class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                            <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                        </span>

                                         <span  v-if="form.field === 'id'" class="ml-2 flex-none rounded text-gray-400">

                                            <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                             <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                        </span>

                                    </span>

                                </th>

                                <th scope="col"
                                    @click="sort('name')"
                                    class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">

                                    <span class="group inline-flex cursor-pointer">

                                        {{ __('Name') }}

                                         <span  v-if="form.field !== 'name'" class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                            <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                        </span>

                                         <span  v-if="form.field === 'name'" class="ml-2 flex-none rounded text-gray-400">

                                            <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                             <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                        </span>

                                    </span>

                                </th>

                                <th scope="col"  @click="sort('email')" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">

                                    <span class="group inline-flex cursor-pointer">
                                        {{ __('Email') }}

                                        <span  v-if="form.field !== 'email'" class="invisible ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">

                                            <SortDescendingIcon class="invisible ml-2 h-5 w-5 flex-none rounded text-gray-400 group-hover:visible group-focus:visible" aria-hidden="true" />

                                        </span>

                                         <span  v-if="form.field === 'email'" class="ml-2 flex-none rounded text-gray-400">

                                            <SortAscendingIcon v-if="form.direction === 'desc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                             <SortDescendingIcon v-if="form.direction === 'asc'" class="ml-2 h-5 w-5 flex-none rounded text-gray-400" aria-hidden="true" />

                                        </span>

                                    </span>

                                </th>

                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">

                                    {{ __('Role') }}

                                </th>

                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">

                                    {{ __('Last Login') }}

                                </th>

                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">

                                    {{ __('Access') }}

                                </th>

                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">

                                    <span class="sr-only"> {{ __('Edit') }}</span>

                                </th>

                            </tr>

                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">

                            <tr v-for="user in users.data" :key="user.id"
                                :class="[selectedUsers.includes(user.id) && 'bg-gray-50']">

                                <td class="relative w-12 px-6 sm:w-16 sm:px-8">

                                    <div v-if="selectedUsers.includes(user.id)"
                                         class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>

                                    <input type="checkbox"
                                           class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
                                           :value="user.id" v-model="selectedUsers"/>

                                </td>

                                <td :class="['whitespace-nowrap py-4 pr-3 text-sm font-medium', selectedUsers.includes(user.id) ? 'text-indigo-600' : 'text-gray-900']">

                                    {{ user.id }}

                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                    <div class="flex items-center">

                                        <div class="h-10 w-10 flex-shrink-0">

                                            <img class="h-10 w-10 rounded-full" :src="user.image" alt=""/>

                                        </div>

                                        <div class="ml-4">

                                            <div class="group inline-flex space-x-2 truncate text-sm">

                                                <p class="font-medium text-gray-900 truncate group-hover:text-gray-900">

                                                    {{ user.name }}

                                                </p>

                                                <a :href="route('impersonate', user.id)" v-if="user.can.impersonate">
                                                    <ExternalLinkIcon class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300" aria-hidden="true"/>
                                                </a>


                                            </div>

                                            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">Registered on  {{ user.created_at }}</div>

                                        </div>

                                    </div>

                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                    <div class="flex">

                                        <div class="group inline-flex space-x-2 truncate text-sm cursor-pointer">

                                            <ShieldCheckIcon v-if="user.verified" class="flex-shrink-0 h-5 w-5 text-green-500 group-hover:text-green-700" aria-hidden="true"/>
                                            <ShieldExclamationIcon v-else class="flex-shrink-0 h-5 w-5 text-rose-500 group-hover:text-rose-700" aria-hidden="true"/>

                                            <p class="text-gray-500 truncate group-hover:text-gray-900">

                                                {{ user.email }}

                                            </p>

                                        </div>

                                    </div>

                                    <button  @click="sendEmailVerificationNotification(user.id)" v-if="!user.verified" class="mt-2 group inline-flex items-center space-x-2 truncate text-sm text-primary-700" :class="{ 'cursor-not-allowed': formVerification.processing }" :disabled="formVerification.processing">
                                        <RefreshIcon v-if="formVerification.processing" class="animate-spin flex-shrink-0 h-5 w-5 text-secondary-400 group-hover:text-secondary-500" aria-hidden="true" />
                                        <p :class="{ 'opacity-25': formVerification.processing }" class="underline text-gray-500 truncate group-hover:text-gray-900">
                                            {{ __('Resend Verification Email') }}
                                        </p>
                                    </button>

                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-100 text-secondary-800 dark:bg-secondary-700 dark:text-secondary-400">

                                        {{ user.role }}

                                    </span>

                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                    <div v-if="user.sessions.length > 0" class="space-y-6">
                                        <div v-for="(session, i) in user.sessions" :key="i" class="flex items-center">
                                            <div>
                                                <svg
                                                    v-if="session.agent.is_desktop"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    class="w-8 h-8 text-gray-500"
                                                >
                                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>

                                                <svg
                                                    v-else
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-8 h-8 text-gray-500"
                                                >
                                                    <path d="M0 0h24v24H0z" stroke="none" /><rect
                                                    x="7"
                                                    y="4"
                                                    width="10"
                                                    height="16"
                                                    rx="1"
                                                /><path d="M11 5h2M12 17v.01" />
                                                </svg>
                                            </div>

                                            <div class="ml-3">
                                                <div class="text-sm text-gray-600">
                                                    {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                                                </div>

                                                <div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ session.ip_address }},

                                                        <span v-if="session.is_current_device" class="text-green-500 font-semibold">This device</span>
                                                        <span v-else>Last active {{ session.last_active }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-right">

                                    {{ user.access }}

                                </td>

                                <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 text-right cursor-pointer">

                                    <span v-if="$page.props.user.id === user.id"
                                          class="group flex items-center flex-row-reverse text-sm leading-5 text-secondary-500 text-right dark:text-secondary-400">

                                        <span class="text-gray-500 truncate group-hover:text-gray-900">Me</span>

                                        <UserCircleIcon
                                            class="flex-shrink-0 h-5 w-5 text-green-500 group-hover:text-green-700 mr-1"
                                            aria-hidden="true"/>

                                    </span>

                                    <Link v-if="$page.props.auth.user.isAdministrator && ! user.isAdministrator"
                                          :href="route('admin.users.edit', {'user': user.id})" preserve-state
                                          preserve-scroll
                                          :data="queryString()"
                                          class="group flex flex-row-reverse items-center hover:shadow-2xl">

                                        <PencilAltIcon
                                            class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 mr-1 transition ease-in-out delay-150 group-hover:-translate-y-1 group-hover:scale-125 duration-300"
                                            aria-hidden="true"/>

                                        <span class="sr-only">, {{ user.name }}</span>

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
</template>
