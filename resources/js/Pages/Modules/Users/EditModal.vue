<script setup>

import { ref } from 'vue'

import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

import Select from '@/Components/Select'

import JetInput from '@/Jetstream/Input.vue'

import JetLabel from '@/Jetstream/Label.vue'

import {useForm, Link} from "@inertiajs/inertia-vue3";

import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

import JetInputError from '@/Jetstream/InputError.vue';


const enabled = ref(false)

const isOpen = ref(true)

const props = defineProps({

    editing: Object,

    roles: Object,

    errors: Object,

});

const form = useForm({

    id: props.editing.id,

    name: props.editing.name,

    email: props.editing.email,

    role_id: props.editing.roles[0].id,

});

const updateInputRole = (role) => {

    form.role_id = role.id

}

</script>

<template>
    <TransitionRoot
        :show="isOpen"

        as="template"

        enter="delay-200 duration-300 ease-out"

        enter-from="opacity-0"

        enter-to="opacity-100"

        leave="duration-200 ease-in"

        leave-from="opacity-100"

        leave-to="opacity-0"
    >
        <Dialog as="div" class="relative z-10">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to="opacity-100 translate-y-0 sm:scale-100"
                leave="ease-in duration-200"
                leave-from="opacity-100 translate-y-0 sm:scale-100"
                leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative bg-white px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-4xl sm:w-full sm:p-6">
                            <JetValidationErrors class="mb-4" />
                            <form @submit.prevent="form.put(route('admin.users.update', form.id))">
                                <div>
                                    <div class="mb-3">
                                        <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900"> Payment successful </DialogTitle>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <div class="col-span-1 sm:col-span-3">
                                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                                                    <div class="col-span-1 sm:col-span-2">
                                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                            <div class="col-span-1">

                                                                <JetLabel for="name" value="Name"/>

                                                                <JetInput
                                                                    id="name"
                                                                    v-model="form.name"
                                                                    type="text"
                                                                    class="mt-1 block w-full"
                                                                    required
                                                                    autofocus/>

                                                                <JetInputError :message="errors.name" class="mt-2" />
                                                            </div>

                                                            <div class="col-span-1">
                                                                <Select :people="props.roles" v-if="props.roles" @on-select="updateInputRole" :selected="form.role_id"></Select>
                                                            </div>

                                                            <div class="col-span-1 sm:col-span-2">
                                                                <JetLabel
                                                                    for="email"
                                                                    value="Email"
                                                                />
                                                                <JetInput
                                                                    id="email"
                                                                    v-model="form.email"
                                                                    type="text"
                                                                    class="mt-1 block w-full"
                                                                    required/>
                                                                <JetInputError :message="errors.email" class="mt-2" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                                                            <div class="col-span-1">
                                                                <JetLabel
                                                                    value="Invitation"
                                                                />
                                                                <SwitchGroup as="div" class="mt-2 flex items-center">
                                                                    <Switch v-model="enabled" :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                                        <span aria-hidden="true" :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                    </Switch>
                                                                    <SwitchLabel as="span" class="ml-3">
                                                                        <span class="text-sm font-medium text-gray-900">Send Invite </span>
                                                                    </SwitchLabel>
                                                                </SwitchGroup>
                                                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                                    Send an invitation to this administrator by email with his login information
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">Deactivate</button>
                                <Link :href="route('admin.users.index')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" ref="cancelButtonRef">Cancel</Link>
                            </div>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
