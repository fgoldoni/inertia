<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {PencilAltIcon, UserCircleIcon} from '@heroicons/vue/solid';

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div>
         <span v-if="$page.props.user.id === props.row.id"
               class="group flex items-center flex-row-reverse text-sm leading-5 text-secondary-500 text-right dark:text-secondary-400">

                                        <span class="text-gray-500 truncate group-hover:text-gray-900">Me</span>

                                        <UserCircleIcon
                                            class="flex-shrink-0 h-5 w-5 text-green-500 group-hover:text-green-700 mr-1"
                                            aria-hidden="true"/>

                                    </span>

        <Link v-else-if="props.row.can.edit && ! props.row.isAdministrator"
              :href="route('admin.users.edit', {'user': props.row.id})" preserve-state
              preserve-scroll
              :data="{}"
              class="group flex flex-row-reverse items-center hover:shadow-2xl">

            <PencilAltIcon
                class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 mr-1 transition ease-in-out delay-150 group-hover:-translate-y-1 group-hover:scale-125 duration-300"
                aria-hidden="true"/>

            <span class="sr-only">, {{ props.row.name }}</span>

        </Link>
    </div>
</template>

<style scoped>

</style>
