<script setup>
import {ref, reactive, onMounted} from 'vue'
import LoadingButton from '@/Shared/LoadingButton'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import { Errors } from '@/Plugins/errors'
import {TrashIcon} from '@heroicons/vue/solid'
import pickBy from "lodash/pickBy";
import UsersList from '@/Components/UsersList'
import { InformationCircleIcon } from '@heroicons/vue/solid'
import { useFetch } from '@/Composables/UseFetch'
import moment from 'moment'
import Assigned from '@/Shared/Assigned'



const props = defineProps({
    editing: Object,
    basePageRoute: String,
});

const isOpen = ref(true)


const onAssigned = (value) => {
    form.users = value
}

const { data: permissions, fetchData: fetchPermissions } = useFetch()

const setIsOpen = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    display_name: props.editing.display_name,
    selectedRow: props.editing.permissions,
    errors: new Errors(),
    processing: false,
    users: [],
});

onMounted(() => {
    fetchPermissions(route('api.permissions.index'));
})


const onSubmit = () => {
    form.processing = true;

    axios.put(route('admin.roles.update', form.id), pickBy({
        name: form.name,
        display_name: form.display_name,
        permissions: form.selectedRow
    })).then((response) => {
        setIsOpen()
        form.processing = false;
    }).catch(error => {
        form.processing = false;
        form.errors.record(error.response.data.errors);
    });

};

</script>

<template>
    <TransitionRoot as="template"
                    :show="isOpen"
                    enter="transition-opacity duration-500"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity duration-500"
                    leave-from="opacity-100"
                    leave-to="opacity-0">

        <Dialog as="div" class="relative z-10" @close="setIsOpen">

            <TransitionChild as="template"
                             enter="ease-out duration-300"
                             enter-from="opacity-0"
                             enter-to="opacity-100"
                             leave="ease-in duration-200"
                             leave-from="opacity-100"
                             leave-to="opacity-0">

                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>

            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">

                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

                    <TransitionChild as="template"
                                     enter="ease-out duration-300"
                                     enter-from="-opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                     enter-to="opacity-100 translate-y-0 sm:scale-100"
                                     leave="ease-in duration-200"
                                     leave-from="opacity-100 translate-y-0 sm:scale-100"
                                     leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                        <DialogPanel
                            class="relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-5xl sm:w-full">

                            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                    <div>

                                        <div class="mb-3">

                                            <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">

                                                {{ __('Create Modal') }}

                                            </DialogTitle>

                                        </div>

                                        <div class="mb-3" v-if="props.editing.name === 'administrator'">
                                            <div class="rounded-md bg-primary-500 bg-opacity-10 p-4">
                                                <div class="flex">
                                                    <div class="shrink-0">
                                                        <InformationCircleIcon  class="h-5 w-5 text-primary-400" />
                                                    </div>
                                                    <div class="ml-3 flex-1 md:flex md:justify-between">
                                                        <p class="text-sm leading-5 text-primary-700">
                                                            {{ __('You are about to update the admin role, this could block your access to the dashboard.') }}
                                                        </p>
                                                        <p class="mt-3 text-sm leading-5 md:mt-0 md:ml-6">
                                                            <a href="javascript:;" class="whitespace-no-wrap font-medium text-primary-700 hover:text-primary-600 transition ease-in-out duration-150">
                                                                {{ __('Learn more') }} &rarr;
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                            <div class="col-span-1 sm:col-span-3">

                                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                                    <div class="col-span-1 sm:col-span-2">

                                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                            <div class="col-span-1">

                                                                <JetLabel for="name" value="Name (in lowercase) " required/>

                                                                <JetInput
                                                                    id="name"
                                                                    name="name"
                                                                    v-model="form.name"
                                                                    type="text"
                                                                    class="mt-1 block w-full"
                                                                    required
                                                                    autofocus/>

                                                                <JetInputError :message="form.errors.get('name')" class="mt-2"/>
                                                            </div>

                                                            <div class="col-span-1">

                                                                <JetLabel for="name" value="Name" required/>

                                                                <JetInput
                                                                    id="display_name"
                                                                    name="display_name"
                                                                    v-model="form.display_name"
                                                                    type="text"
                                                                    class="mt-1 block w-full"
                                                                    required/>

                                                                <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>
                                                            </div>

                                                            <div class="col-span-1 sm:col-span-2">
                                                                <div class="relative bg-white shadow overflow-auto rounded-md dark:bg-secondary-800">
                                                                    <div class="px-4 pt-5 sm:px-6 flex flex-wrap items-baseline">
                                                                        <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">{{ __('Permissions') }}</h3>
                                                                        <p class="ml-2 mt-1 text-sm leading-5 text-secondary-500 truncate">{{ __('in :name role', {'name': editing.display_name}) }}</p>
                                                                    </div>

                                                                    <JetInputError :message="form.errors.get('permissions')" class="mt-2 px-5"/>

                                                                    <div class="mt-4 border-t border-secondary-200 overflow-y-auto h-72 divide-y divide-secondary-200 dark:border-secondary-700 dark:divide-secondary-700">
                                                                        <div v-for="(permissions, group) in permissions.data">
                                                                            <div class="sticky top-0 w-full py-1.5 px-4 bg-secondary-100 dark:bg-secondary-700">
                                                                                <span class="text-sm font-bold leading-5 capitalize tracking-wide text-secondary-900 sm:text-base sm:leading-6 dark:text-white">{{ group }}</span>
                                                                            </div>
                                                                            <div class="px-4 py-1 divide-y divide-secondary-200 dark:divide-secondary-700">
                                                                                <div v-for="(permission, key) in permissions" class="flex items-center justify-between py-2">
                                                                                    <div class="flex items-center space-x-3 cursor-pointer">
                                                                                        <input :id="'permission_' + permission.id"  :name="'permission_' + permission.id" :value="permission.id" type="checkbox" v-model="form.selectedRow" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />

                                                                                        <JetLabel :for="'permission_' + permission.id" :value="permission.display_name"/>
                                                                                    </div>
                                                                                    <div class="flex items-center space-x-3">
                                                                                        <button v-if="permission.can_be_removed" type="button" class="inline-flex items-center text-sm leading-5 text-medium text-secondary-500 hover:text-rose-500 focus:text-rose-700 focus:outline-none focus:shadow-none dark:text-secondary-400 dark:hover:text-rose-500">
                                                                                            <TrashIcon class="w-4 h-4" />
                                                                                        </button>
                                                                                        <time datetime="{{ permission.created_at }}" class="capitalize text-xs font-medium leading-5 text-secondary-400 dark:text-secondary-500">{{ moment(permission.created_at, moment.ISO_8601).format('MMM YY') }}</time>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="bg-secondary-100 col-span-1">

                                                        <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                            <div class="col-span-1">
                                                                <div class="flex items-center space-x-2">
                                                                    <div class="flex -space-x-1 relative z-0 overflow-hidden">
                                                                        <img v-for="user in props.editing.users" :key="'image' + user.id" class="relative z-30 inline-block h-6 w-6 rounded-full ring-2 ring-white" :src="user.profile_photo_url" :alt="user.name" loading="lazy"/>
                                                                    </div>

                                                                    <span v-if="props.editing.users_count - 10 > 0" class="shrink-0 text-xs leading-5 font-medium text-secondary-500 dark:text-secondary-400">+{{ props.editing.users_count - 10 }}</span>
                                                               </div>
                                                            </div>

                                                            <div class="col-span-1">

                                                                <div class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
                                                                    {{ __('These are the members who are already in your store with their associated roles.') }}
                                                                </div>

                                                            </div>

                                                            <Assigned @on-assigned="onAssigned" :items="props.editing.users"></Assigned>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="bg-secondary-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                    <LoadingButton type="submit" :loading="form.processing"
                                                   class="uppercase w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">

                                        {{ __('Save') }}

                                    </LoadingButton>

                                    <Link :href="props.basePageRoute"
                                          class="cursor-pointer uppercase mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                          id="cancelButtonRef"
                                          ref="cancelButtonRef">

                                        {{ __('Cancel') }}

                                    </Link>

                                </div>

                            </form>

                        </DialogPanel>

                    </TransitionChild>

                </div>

            </div>

        </Dialog>

    </TransitionRoot>

</template>
