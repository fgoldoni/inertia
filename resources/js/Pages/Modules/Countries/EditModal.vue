<script setup>
import {ref, reactive} from 'vue'
import LoadingButton from '@/Shared/LoadingButton'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import { Errors } from '@/Plugins/errors'

const props = defineProps({
    editing: Object,
    filters: Object,
    basePageRoute: String,
});

const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    errors: new Errors(),
    processing: false,
});


const closeModal = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}

const onSubmit = () => {
    form.processing = true;

    axios.put(route('admin.countries.update', form.id), {
        name: form.name,
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
                            class="relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-3xl sm:w-full">

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

                                                        </div>

                                                    </div>

                                                    <div class="bg-secondary-100 col-span-1">

                                                        <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                            <div class="col-span-1">

                                                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                                                    <div class="sm:col-span-2">
                                                                        <dt class="capitalize text-sm font-medium text-gray-500">{{ __('Capital') }} {{ props.editing.emoji }}</dt>
                                                                        <dd class="mt-1 max-w-prose text-sm text-gray-900 space-y-5" v-html="props.editing.capital" />
                                                                    </div>
                                                                    <div class="sm:col-span-2">
                                                                        <dt class="capitalize text-sm font-medium text-gray-500">{{ __('Full Name') }}</dt>
                                                                        <dd class="capitalize mt-1 max-w-prose text-sm text-gray-900 space-y-5" v-html="props.editing.full_name" />
                                                                    </div>
                                                                    <div class="sm:col-span-2">
                                                                        <dt class="capitalize text-sm font-medium text-gray-500">{{ __('Currency') }}</dt>
                                                                        <dd class="mt-1 max-w-prose text-sm text-gray-900 space-y-5" v-html="props.editing.currency_name + ' ( ' + props.editing.currency_code + ' )'" />
                                                                    </div>
                                                                </dl>

                                                            </div>


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
