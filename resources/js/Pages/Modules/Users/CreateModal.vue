<script setup>
import {ref, computed, onMounted, reactive, nextTick} from 'vue'
import {useForm, Link} from "@inertiajs/inertia-vue3";
import LoadingButton from '@/Shared/LoadingButton'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import pickBy from 'lodash/pickBy'
import zxcvbn from 'zxcvbn'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import Select from '@/Components/Select'
import internationalNumber from '@/Plugins/internationalNumber'
import 'intl-tel-input/build/css/intlTelInput.css'
import {generatePassword, strengthLevels} from '@/Plugins/generatePassword'
import { Errors } from '@/Plugins/errors'
import { useFetch } from '@/Composables/UseFetch'


const props = defineProps({
    editing: Object,
    filters: Object,
    basePageRoute: String,
});

const { data: roles, doFetchData: doFetchRoles } = useFetch()


const showPassword = ref(false)
const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    email: props.editing.email,
    phone: props.editing.phone,
    role: props.editing.role,
    enabled: ref(false),
    errors: new Errors(),
    password: '',
    processing: false,
});

onMounted(() => {
    internationalNumber('#phone').init();
    doFetchRoles(route('api.roles.index'));
})

const closeModal = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}
const updateInputRole = (roleId) => form.role = roleId

const generate = () => {
    form.password = generatePassword(10)
}

const score = computed(() => zxcvbn(form.password).score)

const onSubmit = () => {
    form.processing = true;

    axios.post(route('admin.users.store'), {
        name: form.name,
        email: form.email,
        phone: form.phone,
        role: form.role,
        password: form.password,
        invite: form.enabled,
    }).then(() => {
        form.processing = false;
        closeModal();
    }).catch(error => {
        form.processing = false;
        debugger
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
                            class="relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-4xl sm:w-full">

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

                                                            <div class="col-span-1">

                                                                <Select :items="roles.data"
                                                                        v-if="roles.data"
                                                                        @on-select="updateInputRole"
                                                                        :selected="form.role"/>

                                                                <JetInputError :message="form.errors.get('role')" class="mt-2"/>
                                                            </div>

                                                            <div class="col-span-1 sm:col-span-2">

                                                                <JetLabel for="email" value="Email" required/>

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

                                                                <JetLabel for="phone" value="Phone"/>

                                                                <JetInput
                                                                    id="phone"
                                                                    name="phone"
                                                                    v-model="form.phone"
                                                                    type="text"
                                                                    class="mt-1 block w-full"
                                                                    autofocus/>

                                                                <JetInputError :message="form.errors.get('phone')" class="mt-2"/>
                                                            </div>

                                                            <div class="col-span-1 sm:col-span-2">

                                                                <div class="flex items-center justify-between">

                                                                    <JetLabel for="password" value="Password" required/>
                                                                    <div
                                                                        class="flex items-center divide-x divide-secondary-200 dark:divide-secondary-600">

                                                                        <button @click="generate" type="button"
                                                                                class="pr-2 text-primary-600 text-sm font-medium leading-5 hover:text-primary-500 hover:underline dark:text-primary-500/50">

                                                                            {{ __('Generate') }}

                                                                        </button>

                                                                        <button @click="showPassword = !showPassword"
                                                                                v-text="showPassword ? __('Hide') : __('Show')"
                                                                                type="button"
                                                                                class="pl-2 text-sm text-leading-5 text-primary-600 hover:text-primary-700 focus:outline-none focus:text-primary-700 hover:underline dark:text-primary-500/50">

                                                                        </button>

                                                                    </div>

                                                                </div>

                                                                <JetInput
                                                                    id="password"
                                                                    name="password"
                                                                    v-model="form.password"
                                                                    :type="showPassword ? 'text' : 'password'"
                                                                    class="mt-1 block w-full"
                                                                    required
                                                                    autocomplete="new-password"
                                                                />

                                                                <JetInputError :message="form.errors.get('password')" class="mt-2"/>
                                                            </div>

                                                            <div class="col-span-1 sm:col-span-2">

                                                                <span class="text-sm">

                                                                    <span
                                                                        class="text-sm font-medium text-secondary-500 truncate">

                                                                        {{ __('Password strength:') }}

                                                                    </span>

                                                                    {{ strengthLevels[score] || __('Weak') }}

                                                                </span>

                                                                <progress :value="score" max="4"
                                                                          class="w-full"></progress>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="bg-secondary-100 col-span-1">

                                                        <div class="pl-4 pt-2 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                            <div class="col-span-1">

                                                                <JetLabel value="Invitation"/>

                                                                <!-- This example requires Tailwind CSS v2.0+ -->
                                                                <SwitchGroup as="div" class="mt-2 flex items-center whitespace-nowrap">
                                                                    <Switch v-model="form.enabled" :class="[form.enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                                        <span aria-hidden="true" :class="[form.enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                    </Switch>
                                                                    <SwitchLabel as="span" class="ml-3">
                                                                        <span class="text-sm font-medium text-gray-900">Send Invite</span>
                                                                    </SwitchLabel>
                                                                </SwitchGroup>

                                                            </div>

                                                            <div class="col-span-1">

                                                                <div class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
                                                                    Send an invitation to this administrator by email with his login information.
                                                                </div>

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
