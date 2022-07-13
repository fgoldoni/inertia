<script setup>
import {ref} from 'vue'
import {Link} from "@inertiajs/inertia-vue3";
import {XIcon} from '@heroicons/vue/outline'
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from '@headlessui/vue'
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import Tabs from '@/Shared/Tabs.vue'
import Logs from '@/Shared/Logs.vue'
import UpdateUserComponent from '@/Components/UpdateUserComponent.vue'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    editing: Object,
    errors: Object,
    filters: Object,
    basePageRoute: String,
});

const team = ref(props.editing)
const isOpen = ref(true)
const currentTab = ref('edit')


const close = () => {
    Inertia.get(props.basePageRoute, {}, {replace: true, preserveState: true, preserveScroll: true})
}
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

                            <div class="absolute top-0 right-0 pt-2 pr-4 sm:pt-4 sm:pr-4">
                                <Link :href="props.basePageRoute" preserve-state preserve-scroll class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" @click="close">
                                    <span class="sr-only">Close</span>
                                    <XIcon class="h-6 w-6" aria-hidden="true" />
                                </Link>
                            </div>

                            <div class="px-4 pt-10 pb-4 sm:p-0">
                                <Tabs v-model="currentTab"></Tabs>
                            </div>

                            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                <div v-if="currentTab === 'edit'" class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                    <div class="col-span-1 sm:col-span-3">

                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                            <div class="col-span-1 sm:col-span-2">

                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                    <UpdateUserComponent v-model="team" default-open></UpdateUserComponent>

                                                </div>

                                            </div>

                                            <div class="col-span-1">

                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                    <div class="col-span-1">

                                                        <div class="prose prose-sm text-gray-500" v-if="props.editing.verified">
                                                            <ul role="list">
                                                                <li>Verified</li>
                                                                <li>Last login on: {{ props.editing.lastLogin }}</li>
                                                                <li>Created on: <time datetime="2020-12-02" v-text="props.editing.created_at"></time></li>
                                                            </ul>
                                                        </div>

                                                        <div class="space-y-5" v-else>

                                                            <div class="flex items-center space-x-2">

                                                                <SwitchGroup as="div" class="flex items-center">
                                                                    <Switch v-model="props.editing.verified" :class="[props.editing.verified ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                                        <span aria-hidden="true" :class="[props.editing.verified ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                    </Switch>
                                                                    <SwitchLabel as="span" class="ml-3">
                                                                        <span class="text-sm font-medium text-gray-500">Mark as verified</span>
                                                                    </SwitchLabel>
                                                                </SwitchGroup>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-span-1">

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div v-if="currentTab === 'logs'" class="grid grid-cols-1">
                                    <Logs :options="team.logs"></Logs>
                                </div>

                            </div>

                        </DialogPanel>

                    </TransitionChild>

                </div>

            </div>

        </Dialog>

    </TransitionRoot>

</template>
