<script setup>
import {ref, onMounted} from 'vue'
import {Link} from "@inertiajs/inertia-vue3";
import {XIcon} from '@heroicons/vue/outline'
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from '@headlessui/vue'
import Tabs from '@/Shared/Tabs.vue'
import Logs from '@/Shared/Logs.vue'
import SwitchGroupComponent from '@/Shared/SwitchGroupComponent.vue'
import StoreApplicantComponent from '@/Components/StoreApplicantComponent.vue'
import {Inertia} from "@inertiajs/inertia";
import { useFetch } from '@/Composables/UseFetch.js'


const props = defineProps({
    editing: Object,
    states: Object,
    errors: Object,
    filters: Object,
    basePageRoute: String,
});

const applicant = ref(props.editing)
const isOpen = ref(true)
const currentTab = ref('edit')
const enabled = ref(false)

const { data, doFetchData } = useFetch()

onMounted(() => {
    doFetchData(route('admin.applicants.show', 0))
})


const close = () => {
    Inertia.get(props.basePageRoute, {}, {replace: true, preserveState: true, preserveScroll: true})
}

</script>

<template>
    <div v-if="data.data">
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

                                                        <StoreApplicantComponent v-model="applicant" :states="states"  :data="data.data" :enabled="enabled" @close="close" default-open></StoreApplicantComponent>

                                                    </div>

                                                </div>

                                                <div class="col-span-1">

                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                                                        <div class="col-span-1">
                                                            <div class="pl-4 pt-2 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                <div class="col-span-1">

                                                                    <SwitchGroupComponent
                                                                        v-model="enabled"
                                                                        :placeholder="__('Send a notification to candidate')"
                                                                        :text="__('The applicant will be notified that a new application is created.')"
                                                                    ></SwitchGroupComponent>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div v-if="currentTab === 'logs'" class="grid grid-cols-1">
                                        <Logs :options="applicant.logs"></Logs>
                                    </div>

                                </div>

                            </DialogPanel>

                        </TransitionChild>

                    </div>

                </div>

            </Dialog>

        </TransitionRoot>
    </div>

</template>
