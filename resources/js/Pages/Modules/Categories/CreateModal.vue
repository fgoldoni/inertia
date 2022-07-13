<script setup>
import {ref, reactive} from 'vue'
import {Link} from "@inertiajs/inertia-vue3";
import LoadingButton from '@/Shared/LoadingButton.vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import JetTextarea from '@/Jetstream/Textarea.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import { Errors } from '@/Plugins/errors.js'
import BaseComboboxes from '@/Shared/BaseComboboxes.vue'
import ImageUpload from '@/Shared/ImageUpload.vue'

const props = defineProps({
    editing: Object,
    filters: Object,
    basePageRoute: String,
});

const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    parent_id: props.editing.parent_id,
    seo_title: props.editing.seo_title,
    seo_description: props.editing.seo_description,
    online: ref(props.editing.online),
    errors: new Errors(),
    processing: false,
});



const closeModal = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}

const onSubmit = () => {
    form.processing = true;

    axios.post(route('admin.categories.store'), {
        name: form.name,
        parent_id: form.parent_id,
        seo_title: form.seo_title,
        seo_description: form.seo_description,
        online: form.online,
    }).then(() => {
        form.processing = false;
        closeModal();
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
                            class="relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-5xl sm:w-full">

                            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

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

                                                                <BaseComboboxes v-model="form.parent_id" :country-id="form.country_id" placeholder="No category" api-url="api.categories.index" label="Parent" :default-value="props.editing.parent?.name" key="select-city"></BaseComboboxes>

                                                                <JetInputError :message="form.errors.get('parent_id')" class="mt-2"/>

                                                            </div>


                                                            <div class="col-span-1 sm:col-span-2">

                                                                <JetLabel for="seo_title" value="Seo Title" optional/>

                                                                <JetInput
                                                                    id="seo_title"
                                                                    name="seo_title"
                                                                    v-model="form.seo_title"
                                                                    type="text"
                                                                    class="mt-1 block w-full"/>

                                                                <JetInputError :message="form.errors.get('seo_title')" class="mt-2"/>
                                                            </div>

                                                            <div class="col-span-1 sm:col-span-2">

                                                                <JetLabel for="seo_description" value="Seo Description" optional/>

                                                                <JetTextarea
                                                                    id="seo_description"
                                                                    name="seo_description"
                                                                    v-model="form.seo_description"
                                                                    type="text"
                                                                    class="mt-1 block w-full"/>

                                                                <p class="mt-2 text-sm text-gray-500">160 characters</p>


                                                                <JetInputError :message="form.errors.get('seo_description')" class="mt-2"/>
                                                            </div>

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

                        </DialogPanel>

                    </TransitionChild>

                </div>

            </div>

        </Dialog>

    </TransitionRoot>

</template>
