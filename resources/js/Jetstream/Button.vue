<script setup>
import {RefreshIcon} from '@heroicons/vue/outline';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-primary-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition">
        <RefreshIcon v-if="disabled" class="animate-spin flex-shrink-0 h-5 w-5 text-white" aria-hidden="true" />
        <slot />
    </button>
</template>
