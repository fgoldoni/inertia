<template>
    <div class="relative rounded-md shadow-sm">
        <input class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </div>
    </div>
</template>

<script>

import { SearchIcon } from '@heroicons/vue/outline'

export default {
    components: {
        SearchIcon
    },
    props: {
        modelValue: String
    },
    emits: ['update:modelValue', 'reset'],
}
</script>
