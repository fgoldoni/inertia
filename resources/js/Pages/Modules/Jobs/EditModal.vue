<script setup>
import {ref, reactive, onMounted} from 'vue'
import LoadingButton from '@/Shared/LoadingButton'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import { QuestionMarkCircleIcon } from '@heroicons/vue/solid'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetTextarea from '@/Jetstream/Textarea'
import JetInputError from '@/Jetstream/InputError.vue';
import { Errors } from '@/Plugins/errors'
import ImageUpload from '@/Shared/ImageUpload'
import BaseListbox from '@/Shared/BaseListbox'
import DatePicker from '@/Shared/DatePicker'
import { useFetch } from '@/Composables/UseFetch'
import {useForm} from "@inertiajs/inertia-vue3";

const { data: roles, doFetchData: doFetchRoles } = useFetch()

const props = defineProps({
    editing: Object,
    filters: Object,
    states: Array,
    basePageRoute: String,
});

const isOpen = ref(true)

const form = useForm({
    id: props.editing.id,
    name: props.editing.name,
    content: props.editing.content,
    state: props.editing.state,
});

onMounted(() => {
    doFetchRoles(route('api.roles.index'));
})


const closeModal = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}

const onSubmit = () => {
    form.transform((data) => ({
        ...data,
        ...props.filters,
    })).put(route('admin.jobs.update', form.id));
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

        <Dialog as="div" class="relative z-10" @close="closeModal()">

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
                            class="relative bg-gray-100 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-5xl sm:w-full">

                            <form @submit.prevent="onSubmit">

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                    <div>

                                        <div class="mb-3">

                                            <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">

                                                {{ __('Edit Modal') }}

                                            </DialogTitle>

                                        </div>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                            <div class="col-span-1 sm:col-span-3">

                                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                                    <div class="col-span-1 sm:col-span-2">

                                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                            <div class="bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                    <div class="col-span-1 sm:col-span-2">

                                                                        <JetLabel for="name" value="Name" required/>

                                                                        <JetInput
                                                                            id="name"
                                                                            name="name"
                                                                            v-model="form.name"
                                                                            type="text"
                                                                            class="mt-1 block w-full"
                                                                            required
                                                                            autofocus/>

                                                                        <JetInputError :message="form.errors.name" class="mt-2"/>
                                                                    </div>

                                                                    <div class="col-span-1 sm:col-span-2">

                                                                        <JetLabel for="content" value="Content" required/>

                                                                        <JetTextarea
                                                                            id="content"
                                                                            name="content"
                                                                            v-model="form.content"
                                                                            type="text"
                                                                            class="mt-1 block w-full"
                                                                            required/>

                                                                        <div class="mt-3 flex items-center justify-between">
                                                                            <a href="#" class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900">
                                                                                <QuestionMarkCircleIcon class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                                                                <span> Some HTML is okay. </span>
                                                                            </a>
                                                                        </div>

                                                                        <JetInputError :message="form.errors.content" class="mt-2"/>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                    <div class="col-span-1 sm:col-span-2">

                                                                       sgfsdgfd
                                                                    </div>

                                                                    <div class="col-span-1 sm:col-span-2">

                                                                       fgdfg
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-span-1">

                                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                            <div class="bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                    <ImageUpload></ImageUpload>

                                                                </div>

                                                            </div>

                                                            <div class="bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                    <div class="col-span-1">

                                                                        <BaseListbox :options="props.states" v-if="props.states" v-model="form.state"  placeholder="Publish"/>

                                                                        <JetInputError :message="form.errors.state" class="mt-2"/>
                                                                    </div>
                                                                    <div class="col-span-1">

                                                                        <JetLabel value="Expiration Date" required/>

                                                                        <DatePicker></DatePicker>

                                                                        <JetInputError :message="form.errors.role" class="mt-2"/>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                    <div class="col-span-1">
                                                                        <!-- This example requires Tailwind CSS v2.0+ -->
                                                                        <SwitchGroup as="div" class="flex items-center whitespace-nowrap">
                                                                            <Switch v-model="form.enabled" :class="[form.enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                                                <span aria-hidden="true" :class="[form.enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                            </Switch>
                                                                            <SwitchLabel as="span" class="ml-3">
                                                                                <span class="text-sm font-medium text-gray-500">Negotiable Salary</span>
                                                                            </SwitchLabel>
                                                                        </SwitchGroup>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="bg-secondary-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                    <LoadingButton type="submit" :loading="form.processing"
                                            class="uppercase w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">

                                        {{ __('Save') }}

                                    </LoadingButton>

                                    <Link :href="props.basePageRoute" preserve-state preserve-scroll
                                          class="uppercase mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
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
