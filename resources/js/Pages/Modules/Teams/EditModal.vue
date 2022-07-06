<script setup>
import {ref} from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'
import Tabs from '@/Shared/Tabs'
import TeamOwnerComponent from '@/Components/TeamOwnerComponent'
import AddTeamMemberComponent from '@/Components/AddTeamMemberComponent'
import PendingTeamInvitationsComponent from '@/Components/PendingTeamInvitationsComponent'
import Logs from '@/Shared/Logs'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    editing: Object,
    filters: Object,
    availableRoles: Array,
    basePageRoute: String,
});

const team = ref(props.editing)

const open = ref(true)

const currentTab = ref('edit')

const close = () => {
    Inertia.get(props.basePageRoute, {}, {replace: true, preserveState: true, preserveScroll: true})
}

</script>

<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="hidden fixed inset-0 bg-secondary-500 bg-opacity-75 transition-opacity md:block" />
            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">

                <div class="flex items-stretch md:items-center justify-center min-h-full text-center md:px-2 lg:px-4">

                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95" enter-to="opacity-100 translate-y-0 md:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 md:scale-100" leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95">

                        <DialogPanel class="relative text-base bg-secondary-100 text-left transform transition w-full md:max-w-4xl md:px-4 md:my-8 lg:max-w-6xl">


                            <div class="absolute top-0 right-0 pt-2 pr-4 sm:pt-4 sm:pr-4">
                                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" @click="close">
                                    <span class="sr-only">Close</span>
                                    <XIcon class="h-6 w-6" aria-hidden="true" />
                                </button>
                            </div>

                            <div class="px-4 pt-10 pb-4 sm:p-6 sm:pb-4">
                                <Tabs v-model="currentTab"></Tabs>
                            </div>

                            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                <div v-if="currentTab === 'edit'" class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                    <div class="col-span-1 sm:col-span-3">

                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                            <div class="col-span-1 sm:col-span-2">

                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                    <TeamOwnerComponent v-model="team" default-open></TeamOwnerComponent>

                                                    <AddTeamMemberComponent v-model="team"  :available-roles="props.availableRoles"></AddTeamMemberComponent>

                                                    <PendingTeamInvitationsComponent v-model="team"></PendingTeamInvitationsComponent>


                                                </div>

                                            </div>

                                            <div class="col-span-1">

                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                    <div class="col-span-1">

                                                        xcxbfxd

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
