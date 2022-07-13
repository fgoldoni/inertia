<script setup>
import {ref, reactive, onMounted} from 'vue'
import {Link} from "@inertiajs/inertia-vue3";
import LoadingButton from '@/Shared/LoadingButton.vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import { Errors } from '@/Plugins/errors.js'
import { useFetch } from '@/Composables/UseFetch.js'
import Assigned from '@/Shared/Assigned.vue'
import {TrashIcon} from '@heroicons/vue/solid'
import pickBy from "lodash/pickBy";
import moment from 'moment'
import {ElNotification} from "element-plus";


const props = defineProps({
    editing: Object,
    basePageRoute: String,
});

const { data: permissions, doFetchData: doFetchPermissions } = useFetch()

const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    display_name: props.editing.display_name,
    selectedRow: props.editing.permissions,
    users: [],
    errors: new Errors(),
    processing: false,
});


const onAssigned = (value) => {
    form.users = value
}

const setIsOpen = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}

onMounted(() => {
    doFetchPermissions(route('api.permissions.index'));
})

const onSubmit = () => {
    form.processing = true;

    axios.post(route('admin.roles.store'), pickBy({
        name: form.name,
        display_name: form.display_name,
        permissions: form.selectedRow,
        users: form.users
    })).then((response) => {
        form.processing = false;

        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })
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
                             enter="transition-opacity ease-linear duration-300"
                             enter-from="opacity-0"
                             enter-to="opacity-100"
                             leave="transition-opacity ease-linear duration-300"
                             leave-from="opacity-100"
                             leave-to="opacity-0">

                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>

            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">

                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

                    <TransitionChild as="template"
                                     enter="transition ease-in-out duration-300 transform"
                                     enter-from="-translate-x-full"
                                     enter-to="translate-x-0"
                                     leave="transition ease-in-out duration-300 transform"
                                     leave-from="translate-x-0"
                                     leave-to="-translate-x-full">

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
                                                                            <div class="w-full py-1.5 px-4 bg-secondary-100 dark:bg-secondary-700">
                                                                                <span class="text-sm font-bold leading-5 capitalize tracking-wide text-secondary-900 sm:text-base sm:leading-6 dark:text-white">{{ group }}</span>
                                                                            </div>
                                                                            <div class="px-4 py-1 divide-y divide-secondary-200 dark:divide-secondary-700">
                                                                                <div v-for="(permission, key) in permissions" class="flex items-center justify-between py-2">
                                                                                    <div class="flex items-center space-x-3 cursor-pointer">
                                                                                        <input :id="'permission_' + permission.id"  :name="'permission_' + permission.id" :value="permission.id" type="checkbox" v-model="form.selectedRow" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" />

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

                                                        <div class="px-4 pt-2 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                            <Assigned @on-assigned="onAssigned"></Assigned>


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
