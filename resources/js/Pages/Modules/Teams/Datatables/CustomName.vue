<script setup>
import {ExternalLinkIcon, RefreshIcon} from '@heroicons/vue/outline';
import pickBy from "lodash/pickBy";
import {reactive} from "vue";
import {Errors} from "@/Plugins/errors";
import {ElNotification} from "element-plus";
import {Inertia} from "@inertiajs/inertia";
import moment from 'moment'

const props = defineProps({
    row: Object,
});

const form = reactive({
    processing: false,
    errors: new Errors(),
});


const restore = (id) => {
    form.processing = true;

    return axios.put(route('admin.teams.restore', id)).then((response) => {
        form.processing = false;
        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })
        Inertia.reload({ only: ["rowData"] });
    }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });
};
</script>

<template>
    <div class="flex items-center">

        <div class="h-10 w-10 flex-shrink-0">

            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" :alt="props.row.name"/>

        </div>

        <div class="ml-4">

            <div class="group inline-flex space-x-2 truncate text-sm">

                <p class="flex items-center truncate space-x-2 font-medium text-gray-900 truncate group-hover:text-gray-900">

                    <div :class="[props.row.belongsToTeam ? 'bg-green-400' : 'bg-secondary-200', 'flex-shrink-0 w-2.5 h-2.5 rounded-full']" aria-hidden="true"></div>

                    <span>{{ props.row.name }}</span>

                </p>

                <span v-if="props.row.isCurrentTeam" class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800"> Current </span>


                <Link :href="route('admin.teams.edit', props.row.id)"
                      preserve-state
                      preserve-scroll
                      :data="pickBy(props.row.params)"
                      :only="['editing', 'modal', 'basePageRoute', 'availableRoles']">
                    <ExternalLinkIcon class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300" aria-hidden="true"/>
                </Link>


            </div>

            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400" v-if="props.row.ownsTeam">Owner</div>
            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400" v-else-if="props.row.belongsToTeam">Member</div>

        </div>

    </div>
</template>

<style scoped>

</style>
