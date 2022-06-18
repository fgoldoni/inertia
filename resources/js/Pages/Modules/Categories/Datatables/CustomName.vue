<script setup>
import {ExternalLinkIcon} from '@heroicons/vue/outline';
import moment from 'moment'

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="flex items-center">

        <div class="h-10 w-10 flex-shrink-0">

            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" :alt="props.row.name"/>

        </div>

        <div class="ml-4">

            <div class="group inline-flex space-x-2 truncate text-sm">

                <p class="flex items-center truncate space-x-2 font-medium text-gray-900 truncate group-hover:text-gray-900">

                    <div :class="[props.row.online ? 'bg-green-400' : 'bg-secondary-200', 'flex-shrink-0 w-2.5 h-2.5 rounded-full']" aria-hidden="true"></div>

                    <span>{{ props.row.name }} <span class="text-gray-500 font-normal" v-if="props.row.parent">in {{ props.row.parent.name }}</span></span>

                </p>

                <a :href="route('impersonate', props.row.id)">
                    <ExternalLinkIcon class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300" aria-hidden="true"/>
                </a>


            </div>

            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">Registered on  {{ moment(props.row.created_at, moment.ISO_8601).format('DD MMM, YYYY') }}</div>

        </div>

    </div>
</template>

<style scoped>

</style>
