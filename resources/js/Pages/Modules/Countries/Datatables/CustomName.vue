<script setup>
import {ExternalLinkIcon} from '@heroicons/vue/outline';
import moment from 'moment'

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="space-y-2">

        <div class="group inline-flex space-x-2 truncate text-sm">

            <p class="flex items-center truncate space-x-2 font-medium text-gray-900 truncate group-hover:text-gray-900">

                <span>{{ props.row.emoji }} {{ props.row.name }}</span>

            </p>


        </div>

        <div>
                <span class="inline-block rounded-full bg-indigo-100 px-2 text-xs font-semibold leading-5 text-indigo-800">
                    {{ props.row.continent.name }}
                </span>
        </div>

    </div>
</template>

<style scoped>

</style>
