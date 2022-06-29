<script setup>
import {ref, computed, onMounted, reactive} from 'vue'
import {Link} from "@inertiajs/inertia-vue3";
import {CalendarIcon, LockOpenIcon, AcademicCapIcon, XIcon} from '@heroicons/vue/solid'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import pickBy from 'lodash/pickBy'
import zxcvbn from 'zxcvbn'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import ValidationErrors from '@/Shared/ValidationErrors';
import BaseListbox from '@/Shared/BaseListbox'
import internationalNumber from '@/Plugins/internationalNumber'
import 'intl-tel-input/build/css/intlTelInput.css'
import {generatePassword, strengthLevels} from '@/Plugins/generatePassword'
import { Errors } from "@/Plugins/errors";
import LoadingButton from '@/Shared/LoadingButton'
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import { useFetch } from '@/Composables/UseFetch'
import JetInputPhone from '@/Jetstream/JetInputPhone.vue';
import BaseDisclosure from '@/Components/BaseDisclosure'


const props = defineProps({
    editing: Object,
    errors: Object,
    filters: Object,
    basePageRoute: String,
});

const score = computed(() => zxcvbn(form.password).score)

const { data: roles, doFetchData: doFetchRoles } = useFetch()

onMounted(() => {
    internationalNumber('#phone').init();
    doFetchRoles(route('api.roles.index'));
})

const enabled = ref(false)
const showPassword = ref(false)
const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    email: props.editing.email,
    phone: props.editing.phone,
    role: props.editing.role,
    verified: props.editing.verified,
    errors: new Errors(),
    password: '',
    processing: false,
});

const closeModal = () => {
    isOpen.value = false
    document.querySelector('#cancelButtonRef').click()
}

const generate = () => {
    form.password = generatePassword(10)
}

const onSubmit = () => {
    form.processing = true;

    axios.put(route('admin.users.update', form.id), pickBy({
        name: form.name,
        email: form.email,
        phone: form.phone,
        role: form.role,
        password: form.password,
        verified: form.verified,
    })).then((response) => {
        form.processing = false;
        closeModal()
    }).catch(error => {
        form.processing = false;
        form.errors.record(error.response.data.errors);
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

                            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                    <div>

                                        <div class="mb-3">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">

                                                    {{ __('Edit Modal') }}

                                                </DialogTitle>

                                                <Link :href="props.basePageRoute" preserve-state preserve-scroll class="absolute top-0 right-4 text-secondary-400 hover:text-secondary-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8">
                                                    <span class="sr-only">Close</span>
                                                    <XIcon class="h-6 w-6" aria-hidden="true" />
                                                </Link>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                            <div class="col-span-1 sm:col-span-3">

                                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                                    <div class="col-span-1 sm:col-span-2">

                                                        <div class="col-span-1 sm:col-span-2" v-if="form.errors.any()">
                                                            <ValidationErrors :errors="form.errors.all()" class="mb-4" />
                                                        </div>

                                                        <BaseDisclosure :title="__('Name & Description')" default-open>

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                <div class="col-span-1">

                                                                    <JetLabel for="name" value="Name"/>

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

                                                                    <BaseListbox :options="roles.data" v-if="roles.data" v-model="form.role"  placeholder="__('Select roles')" :label="__('Select roles')"/>

                                                                    <JetInputError :message="form.errors.get('role')" class="mt-2"/>
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

                                                                <div class="col-span-1 sm:col-span-2">

                                                                    <div class="flex items-center justify-between">

                                                                        <JetLabel for="password" value="Password"/>
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

                                                        </BaseDisclosure>




                                                    </div>

                                                    <div class="col-span-1">

                                                        <BaseDisclosure :title="__('Name & Description')" default-open>

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                <div class="col-span-1">

                                                                    <div class="space-y-5">

                                                                        <div class="flex items-center space-x-2"
                                                                             v-if="props.editing.verified">

                                                                            <LockOpenIcon class="h-5 w-5 text-green-500"
                                                                                          aria-hidden="true"/>

                                                                            <span
                                                                                class="text-green-700 text-sm font-medium">Verified</span>

                                                                        </div>

                                                                        <div class="flex items-center space-x-2" v-else>

                                                                            <SwitchGroup as="div" class="flex items-center">
                                                                                <Switch v-model="form.verified" :class="[form.verified ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                                                                                    <span aria-hidden="true" :class="[form.verified ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                                </Switch>
                                                                                <SwitchLabel as="span" class="ml-3">
                                                                                    <span class="text-sm font-medium text-gray-900">Mark as verified</span>
                                                                                </SwitchLabel>
                                                                            </SwitchGroup>

                                                                        </div>

                                                                        <div class="flex items-center space-x-2">

                                                                            <AcademicCapIcon class="h-5 w-5 text-gray-400"
                                                                                             aria-hidden="true"/>

                                                                            <span class="text-gray-900 text-sm font-medium">4 Job(s)</span>
                                                                        </div>

                                                                        <div
                                                                            class="flex items-center space-x-2 whitespace-nowrap">

                                                                            <CalendarIcon class="h-5 w-5 text-gray-400"
                                                                                          aria-hidden="true"/>

                                                                            <span class="text-gray-900 text-sm font-medium">

                                                                            Created on <time datetime="2020-12-02"
                                                                                             v-text="props.editing.created_at"></time>

                                                                        </span>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </BaseDisclosure>

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
                                          ref="cancelButtonRef" id="cancelButtonRef">

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
