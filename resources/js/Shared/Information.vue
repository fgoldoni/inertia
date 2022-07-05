<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="rounded-md bg-blue-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <InformationCircleIcon class="h-5 w-5 text-blue-400" aria-hidden="true" />
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-blue-700 lowercase">{{ props.text }}</p>
                <p class="mt-3 text-sm md:mt-0 md:ml-6" v-if="props.url">
                    <a :href="props.url" target="_blank" class="whitespace-nowrap font-medium text-blue-700 hover:text-blue-600 lowercase">{{ props.urlText }} <span aria-hidden="true">&rarr;</span></a>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { InformationCircleIcon } from '@heroicons/vue/solid'

const props = defineProps({
    text: String,
    url: String,
    urlText: String,
});
</script>
