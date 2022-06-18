<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {PencilAltIcon} from '@heroicons/vue/solid';
import pickBy from "lodash/pickBy";

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div>
        <Link
              :href="route('admin.cities.edit', props.row.id)"
              preserve-state
              preserve-scroll
              :data="pickBy(props.row.params)"
              :only="['editing', 'modal', 'basePageRoute']"
              class="group flex flex-row-reverse items-center hover:shadow-2xl ml-2">

            <PencilAltIcon
                class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 mr-1 transition ease-in-out delay-150 group-hover:-translate-y-1 group-hover:scale-125 duration-300"
                aria-hidden="true"/>

            <span class="sr-only">, {{ props.row.name }}</span>

        </Link>
    </div>
</template>
