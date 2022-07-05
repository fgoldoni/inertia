<script setup>
import {ref, reactive, onMounted} from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'
import LoadingButton from '@/Shared/LoadingButton'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetTextarea from '@/Jetstream/Textarea'
import JetInputError from '@/Jetstream/InputError.vue';
import ValidationErrors from '@/Shared/ValidationErrors';
import ImageUpload from '@/Shared/ImageUpload'
import BaseListbox from '@/Shared/BaseListbox'
import DatePicker from '@/Shared/DatePicker'
import AvatarInput from '@/Shared/AvatarInput'
import BaseComboboxes from '@/Shared/BaseComboboxes'
import TeamMembers from '@/Shared/TeamMembers'
import Information from '@/Shared/Information'
import BaseDisclosure from '@/Components/BaseDisclosure'
import {Errors} from "@/Plugins/errors";
import { ElNotification } from 'element-plus'

const props = defineProps({
    editing: Object,
    filters: Object,
    availableRoles: Array,
    basePageRoute: String,
});
const open = ref(true)
const cancelButtonRef = ref(null)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    subdomain: props.editing.subdomain,
    display_name: props.editing.display_name,
    role: null,

    avatar: props.editing.avatar_path,
    errors: new Errors(),
    processing: false,
})

const onSubmit = () => {}

const closeModal = () => {
    document.querySelector('#cancelButtonRef').click()
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

                            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                        <div class="col-span-1 sm:col-span-3">

                                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                                <div class="col-span-1 sm:col-span-2">

                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                        <div class="col-span-1 sm:col-span-2" v-if="form.errors.any()">
                                                            <ValidationErrors :errors="form.errors.all()" class="mb-4" />
                                                        </div>

                                                        <BaseDisclosure :title="__('Team Owner')" default-open>

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                <div class="col-span-1">


                                                                    <JetLabel for="name" :value="__('Name')" required/>

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


                                                                    <JetLabel for="name" :value="__('Display Name')" required/>

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

                                                                    <JetLabel for="name" :value="__('Domain')" required/>

                                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> https:// </span>
                                                                        <input type="text" name="subdomain" id="subdomain"  v-model="form.subdomain" class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300" placeholder="example" />
                                                                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> .wedo37.com </span>
                                                                    </div>

                                                                    <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>

                                                                </div>

                                                            </div>

                                                        </BaseDisclosure>

                                                        <BaseDisclosure :title="__('Add Team Member')">

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                <div class="col-span-1 sm:col-span-2">
                                                                    <Information text="Please provide the email address of the person you would like to add to this team."></Information>
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

                                                                <div class="col-span-1 sm:col-span-2">
                                                                    <!-- Role -->
                                                                    <div v-if="props.availableRoles.length > 0" class="col-span-6 lg:col-span-4">
                                                                        <JetLabel for="roles" value="Role" />

                                                                        <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>

                                                                        <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                                                                            <button
                                                                                v-for="(role, i) in availableRoles"
                                                                                :key="role.key"
                                                                                type="button"
                                                                                class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200"
                                                                                :class="{'border-t border-gray-200 rounded-t-none': i > 0, 'rounded-b-none': i != Object.keys(availableRoles).length - 1}"
                                                                                @click="form.role = role.key"
                                                                            >
                                                                                <div :class="{'opacity-50': form.role && form.role != role.key}">
                                                                                    <!-- Role Name -->
                                                                                    <div class="flex items-center">
                                                                                        <div class="text-sm text-gray-600" :class="{'font-semibold': form.role == role.key}">
                                                                                            {{ role.name }}
                                                                                        </div>

                                                                                        <svg
                                                                                            v-if="form.role == role.key"
                                                                                            class="ml-2 h-5 w-5 text-green-400"
                                                                                            fill="none"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            stroke="currentColor"
                                                                                            viewBox="0 0 24 24"
                                                                                        ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                                                    </div>

                                                                                    <!-- Role Description -->
                                                                                    <div class="mt-2 text-xs text-gray-600 text-left">
                                                                                        {{ role.description }}
                                                                                    </div>
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </BaseDisclosure>

                                                    </div>

                                                </div>

                                                <div class="col-span-1">

                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                        <div class="col-span-1">

                                                            <BaseDisclosure :title="__('Pending Team Invitations')" default-open>

                                                                <TeamMembers></TeamMembers>

                                                            </BaseDisclosure>

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
                                          class="uppercase mt-3 w-full inline-flex justify-center rounded-md border border-secondary-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-secondary-700 hover:bg-secondary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
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
