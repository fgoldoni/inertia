<template>
    <Head title="Welcome" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full max-w-7xl mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="min-h-full flex">
                <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                    <div class="mx-auto w-full max-w-sm lg:w-96">
                        <div>
                            <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
                            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Welcome back to your Job Board</h2>
                            <p class="mt-2 text-sm text-gray-600">
                                Or
                                {{ ' ' }}
                                <a href="#" class="font-medium text-primary-600 hover:text-primary-500"> start your 1-month free trial </a>
                            </p>
                        </div>

                        <div class="mt-8">
                            <div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Get started with</p>

                                    <div class="mt-1 relative">
                                        <button @click="open = !open" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-primary-600 bg-gray-100 hover:bg-gray-200">
                                            Live Demo
                                            <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-6 relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300" />
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500" v-if="!$page.props.user"> Sign in to your Account </span>
                                        <span class="px-2 bg-white text-gray-500" v-else> Switch to your Dashboard </span>
                                    </div>
                                    <div class="mt-6 relative" v-if="$page.props.user">
                                        <a :href="route('admin.dashboard.index')" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            Dashboard
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6" v-if="!$page.props.user">

                                <JetValidationErrors class="my-4" />

                                <form @submit.prevent="submit" class="space-y-6">
                                    <div>
                                        <JetLabel for="email" value="Email" class="block text-sm font-medium text-gray-700"/>
                                        <div class="mt-1">
                                            <JetInput
                                                id="email"
                                                v-model="form.email"
                                                type="email"
                                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                                required
                                                autocomplete="off"
                                                autofocus
                                            />
                                        </div>
                                    </div>

                                    <div class="space-y-1">
                                        <JetLabel for="password" value="Password" class="block text-sm font-medium text-gray-700"/>
                                        <div class="mt-1">
                                            <JetInput
                                                id="password"
                                                v-model="form.password"
                                                type="password"
                                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                                required
                                                autocomplete="off"
                                            />
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <JetCheckbox v-model:checked="form.remember" id="remember-me" name="remember" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"/>
                                            <label for="remember-me" class="ml-2 text-sm text-gray-600"> Remember me </label>
                                        </div>

                                        <div class="text-sm">
                                            <Link v-if="canResetPassword" :href="route('password.request')" class="font-medium text-primary-600 hover:text-primary-500">
                                                Forgot your password ?
                                            </Link>
                                        </div>
                                    </div>

                                    <div>
                                        <JetButton class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Log in
                                        </JetButton>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block relative w-0 flex-1">
                    <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="" />
                </div>
            </div>
        </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <template>
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-sm sm:w-full sm:p-6">
                                <div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <div class="mt-2">
                                            <ul role="list" class="mt-3 grid grid-cols-1 gap-5">
                                                <li v-for="demo in $page.props.demo" :key="demo.title" class="col-span-1 flex shadow-sm rounded-md">
                                                    <a   :href="demo.url"
                                                         target="_blank"
                                                          class="inline-flex underline items-center whitespace-nowrap font-medium text-primary-700 hover:text-primary-500">
                                                        <span>{{ demo.title }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6">
                                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-100 text-base font-medium text-gray-700 hover:bg-gray-200 sm:text-sm" @click="open = false">{{ __('Cancel') }}</button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </template>


</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const open = ref(false)

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: 'admin@admin.com',
    password: '00000000',
    remember: true,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
