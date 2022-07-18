<script setup>
import {MapIcon} from "@heroicons/vue/outline";


const props = defineProps({
    row: Object,
});

</script>

<template>
    <div class="flex items-center">
        <div class="h-10 w-10 flex-shrink-0">
            <img class="h-10 w-10 rounded-full" :src="props.row.job?.avatar_url" :alt="props.row.job?.name">
        </div>
        <div class="ml-4">
            <div class="font-medium text-gray-900">{{ props.row.job?.name }}</div>
            <div class="flex">
                <a href="#" class="group inline-flex space-x-2 truncate text-sm">
                    <MapIcon class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"></MapIcon>
                    <p class="text-gray-500 truncate group-hover:text-gray-900">{{ props.row.job?.city }}</p>
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
