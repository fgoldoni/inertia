<script setup>
import { CheckCircleIcon } from '@heroicons/vue/outline'
import { XIcon } from '@heroicons/vue/solid'

import { computed, ref, watch } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const show = ref(false);
const timeout = ref(null);
const style = computed(() => usePage().props.value.flash?.style || 'success');
const message = computed(() => usePage().props.value.flash?.message || '');

defineProps({
    title: String,
});

watch(message, async () => {
    setTimeout(() => show.value = true, 1000)

    if (timeout.value) {
        clearTimeout(timeout.value)
    }

    timeout.value = setTimeout(() => show.value = false, 5000)
});
</script>

<template>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive" class="z-20 fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
        <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
            <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
            <transition enter-active-class="transform ease-out duration-500 transition" enter-from-class="translate-y-6 opacity-0 sm:translate-y-0 sm:translate-x-6" enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" leave-active-class="transition ease-in duration-500" leave-from-class="opacity-100" leave-to-class="opacity-0">
                <div v-if="show && message" class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <CheckCircleIcon class="h-6 w-6 text-green-400" aria-hidden="true" />
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">Successfully saved!</p>
                                <p class="mt-1 text-sm text-gray-500">{{ message }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button type="button" @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close</span>
                                    <XIcon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
