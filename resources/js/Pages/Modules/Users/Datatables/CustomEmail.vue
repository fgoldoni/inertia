<script setup>
import {ShieldExclamationIcon, ShieldCheckIcon} from '@heroicons/vue/outline';

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="flex">

        <div class="group inline-flex space-x-2 truncate text-sm cursor-pointer">

            <ShieldCheckIcon v-if="props.row.verified" class="flex-shrink-0 h-5 w-5 text-green-500 group-hover:text-green-700" aria-hidden="true"/>
            <ShieldExclamationIcon v-else class="flex-shrink-0 h-5 w-5 text-rose-500 group-hover:text-rose-700" aria-hidden="true"/>

            <p class="text-gray-500 truncate group-hover:text-gray-900">

                {{ props.row.email }}

            </p>

        </div>

    </div>
</template>

<style scoped>

</style>
