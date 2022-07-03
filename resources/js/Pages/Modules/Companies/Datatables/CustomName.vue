<script setup>
import {ExternalLinkIcon, RefreshIcon} from '@heroicons/vue/outline';
import pickBy from "lodash/pickBy";
import moment from 'moment'
import {reactive} from "vue";
import {Errors} from "@/Plugins/errors";
import {ElNotification} from "element-plus";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    row: Object,
});

const form = reactive({
    processing: false,
    errors: new Errors(),
});


const restore = (id) => {
    form.processing = true;

    return axios.put(route('admin.companies.restore', id)).then((response) => {
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

                    <div v-if="!props.row.deleted_at" :class="[props.row.online ? 'bg-green-400' : 'bg-secondary-200', 'flex-shrink-0 w-2.5 h-2.5 rounded-full']" aria-hidden="true"></div>
                    <span :class="[props.row.deleted_at ? 'text-negative-500 line-through' : '']">{{ props.row.name }}</span>

                </p>

                <button  @click="restore(props.row.id)" v-if="props.row.deleted_at" :key="'restore' + props.row.id" class="group inline-flex items-center space-x-2 truncate text-sm text-blue-700" :class="{ 'cursor-not-allowed': form.processing }" :disabled="form.processing">
                    <RefreshIcon v-if="form.processing" class="animate-spin flex-shrink-0 h-5 w-5 text-secondary-400 group-hover:text-secondary-500" aria-hidden="true" />
                    <p :class="{ 'opacity-25': form.processing }" class="underline group-hover:text-blue-900 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300">
                        {{ __('Restore') }}
                    </p>
                </button>

                <Link
                      v-if="$page.props.can.edit && !props.row.deleted_at"
                      :href="route('admin.companies.edit', props.row.id)"
                      preserve-state
                      preserve-scroll
                      :data="pickBy(props.row.params)"
                      :only="['editing', 'modal', 'basePageRoute']">
                    <ExternalLinkIcon class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300" aria-hidden="true"/>
                </Link>


            </div>

            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">Registered on {{ moment(props.row.created_at, moment.ISO_8601).format('DD MMM, YYYY') }}</div>

        </div>

    </div>
</template>

<style scoped>

</style>
