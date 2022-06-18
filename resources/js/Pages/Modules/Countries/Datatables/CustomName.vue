<script setup>
import {ExternalLinkIcon} from '@heroicons/vue/outline';
import pickBy from "lodash/pickBy";

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

            <Link :href="route('admin.countries.edit', props.row.id)"
                preserve-state
                preserve-scroll
                :data="pickBy(props.row.params)"
                :only="['editing', 'modal', 'basePageRoute']">
                <ExternalLinkIcon class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300" aria-hidden="true"/>
            </Link>


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
