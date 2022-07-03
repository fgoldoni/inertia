<script setup>
import {ref, reactive} from 'vue'
import LoadingButton from '@/Shared/LoadingButton'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import JetInputPhone from '@/Jetstream/JetInputPhone.vue';
import { Errors } from '@/Plugins/errors'
import ImageUpload from '@/Shared/ImageUpload'
import JetTextarea from '@/Jetstream/Textarea'
import {ElNotification} from "element-plus";
import {DocumentTextIcon, PencilAltIcon, XIcon} from "@heroicons/vue/solid";
import Logs from '@/Shared/Logs'
import ValidationErrors from '@/Shared/ValidationErrors';
import BaseDisclosure from '@/Components/BaseDisclosure'

const props = defineProps({
    editing: Object,
    filters: Object,
    basePageRoute: String,
});

const tabs = [
    { name: 'Edit Modal', key: 'edit_modal', icon: PencilAltIcon },
    { name: 'Logs', key: 'logs', icon: DocumentTextIcon },
]

const currentTab = ref('edit_modal')

const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    content: props.editing.content,
    email: props.editing.email,
    phone: props.editing.phone,
    online: ref(props.editing.online),
    errors: new Errors(),
    processing: false,
});


const closeModal = () => {
    document.querySelector('#cancelButtonRef').click()
}


const onSubmit = () => {
    form.processing = true;

    axios.put(route('admin.companies.update', form.id), {
        name: form.name,
        content: form.content,
        email: form.email,
        phone: form.phone,
        online: form.online,
    }).then((response) => {
        form.processing = false;
        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })
        closeModal()
    }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });

};
</script>

<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-10">

            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="hidden fixed inset-0 bg-secondary-500 bg-opacity-75 transition-opacity md:block" />
            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">


                <div class="flex items-stretch md:items-center justify-center min-h-full text-center md:px-2 lg:px-4">

                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95" enter-to="opacity-100 translate-y-0 md:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 md:scale-100" leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95">

                        <DialogPanel class="relative text-base bg-secondary-100 text-left transform transition w-full md:max-w-4xl md:px-4 md:my-8 lg:max-w-6xl">

                            <div class="flex items-center justify-between">
                                <Link :href="props.basePageRoute" preserve-state preserve-scroll class="absolute top-0 right-4 text-secondary-400 hover:text-secondary-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8">
                                    <span class="sr-only">Close</span>
                                    <XIcon class="h-6 w-6" aria-hidden="true" />
                                </Link>

                                <div class="sm:hidden">
                                    <label for="tabs" class="sr-only">Select a tab</label>
                                    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                                    <select id="tabs" name="tabs" class="block w-full focus:ring-primary-500 focus:border-primary-500 border-secondary-300 rounded-md" v-model="currentTab">
                                        <option v-for="tab in tabs" :key="tab.name" :value="tab.key">{{ tab.name }}</option>
                                    </select>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="border-b border-secondary-200">
                                        <nav class="px-4 -mb-px flex space-x-8" aria-label="Tabs">
                                            <a v-for="tab in tabs" :key="tab.name" href="javascript:;" @click="currentTab = tab.key" :class="[tab.key === currentTab ? 'border-primary-500 text-primary-600' : 'border-transparent text-secondary-500 hover:text-secondary-700 hover:border-secondary-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.key === currentTab ? 'page' : undefined">
                                                <component :is="tab.icon" :class="[tab.key === currentTab ? 'text-primary-500' : 'text-secondary-400 group-hover:text-secondary-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                                                <span>{{ tab.name }}</span>
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            <div v-if="currentTab === 'logs'">

                                <div class="px-8 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div>
                                        <div class="grid grid-cols-1">
                                            <div class="col-span-1">
                                                <Logs :options="props.editing.logs"></Logs>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div v-if="currentTab === 'edit_modal'">

                                <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

                                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                        <div>

                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                                <div class="col-span-1 sm:col-span-3">

                                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                                        <div class="col-span-1 sm:col-span-2">

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">


                                                                <div class="col-span-1 sm:col-span-2" v-if="form.errors.any()">
                                                                    <ValidationErrors :errors="form.errors.all()" class="mb-4" />
                                                                </div>

                                                                <BaseDisclosure :title="__('Name & Description')" default-open>

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

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

                                                                            <JetInputError :message="form.errors.get('name')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <JetLabel for="content" value="Description" optional/>

                                                                            <JetTextarea
                                                                                id="content"
                                                                                name="content"
                                                                                v-model="form.content"
                                                                                type="text"
                                                                                class="mt-1 block w-full"/>


                                                                            <JetInputError :message="form.errors.get('content')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <JetLabel for="email" value="Email"/>

                                                                            <JetInput
                                                                                id="email"
                                                                                name="email"
                                                                                v-model="form.email"
                                                                                type="text"
                                                                                class="mt-1 block w-full"
                                                                                required/>

                                                                            <JetInputError :message="form.errors.get('email')" class="mt-2"/>

                                                                        </div>

                                                                        <JetInputPhone :error="form.errors.get('phone')" v-model="form.phone"></JetInputPhone>

                                                                    </div>

                                                                </BaseDisclosure>

                                                            </div>

                                                        </div>

                                                        <div class="bg-secondary-100 col-span-1">

                                                            <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                <div class="col-span-1">
                                                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                                                    <SwitchGroup as="div" class="mt-2 flex items-center whitespace-nowrap">
                                                                        <Switch v-model="form.online" :class="[form.online ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                                            <span aria-hidden="true" :class="[form.online ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                        </Switch>
                                                                        <SwitchLabel as="span" class="ml-3">
                                                                            <span class="text-sm font-medium text-gray-900 cursor-pointer">Online</span>
                                                                        </SwitchLabel>
                                                                    </SwitchGroup>

                                                                </div>

                                                                <ImageUpload></ImageUpload>

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

                                        <Link :href="props.basePageRoute" preserve-state preserve-scroll
                                              class="uppercase mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                              id="cancelButtonRef"
                                              ref="cancelButtonRef">

                                            {{ __('Cancel') }}

                                        </Link>

                                    </div>

                                </form>

                            </div>

                        </DialogPanel>

                    </TransitionChild>

                </div>

            </div>

        </Dialog>

    </TransitionRoot>

</template>
