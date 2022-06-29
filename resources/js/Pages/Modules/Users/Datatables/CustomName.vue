<script setup>
import {ArrowRightIcon} from '@heroicons/vue/outline';

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="flex items-center">

        <div class="h-10 w-10 flex-shrink-0">

            <img class="h-10 w-10 rounded-full" :src="props.row.image" alt=""/>

        </div>

        <div class="ml-4">

            <div class="group inline-flex space-x-2 truncate text-sm">

                <p class="font-medium text-gray-900 truncate group-hover:text-gray-900">

                    {{ props.row.name }}

                </p>

                <a :href="route('impersonate', props.row.id)" v-if="props.row.can.impersonate" class="text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300">
                    Login As &#x2192;
                </a>


            </div>

            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">Registered on  {{ props.row.created_at }}</div>

        </div>

    </div>
</template>

<style scoped>

</style>
