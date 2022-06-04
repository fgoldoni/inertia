<template>
    <div class="flex rounded-md shadow-sm">
        <div class="relative flex items-stretch flex-grow focus-within:z-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <input class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:text-sm border-gray-300" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
        </div>
        <button type="button"  @click="$emit('reset')" class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            <RefreshIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </button>
    </div>
</template>

<script setup>

import { SearchIcon } from '@heroicons/vue/outline'

import { RefreshIcon } from '@heroicons/vue/solid'

const emit = defineEmits(['update:modelValue', 'reset']);

defineProps({
    modelValue: String
})

</script>
