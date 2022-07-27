<script setup>
import {ExternalLinkIcon } from '@heroicons/vue/outline';
import pickBy from "lodash/pickBy";
import {reactive, ref} from "vue";
import {Errors} from "@/Plugins/errors.js";
import {ElNotification} from "element-plus";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    row: Object,
});


const frontendDomain = document.querySelector('meta[name="frontendDomain"]').content

const frontendHttp = document.querySelector('meta[name="frontendHttp"]').content

const preview = ref(frontendHttp + props.row.subdomain + frontendDomain)

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

            <img class="h-10 w-10 rounded-full" :src="props.row.avatar_url" :alt="props.row.name"/>

        </div>

        <div class="ml-4">

            <div class="group inline-flex space-x-2 truncate text-sm">

                <p class="flex items-center truncate space-x-2 font-medium text-gray-900 truncate group-hover:text-gray-900">

                    <div :class="[props.row.belongsToTeam ? 'bg-green-400' : 'bg-secondary-200', 'flex-shrink-0 w-2.5 h-2.5 rounded-full']" aria-hidden="true"></div>

                    <Link :href="route('admin.teams.edit', props.row.id)"
                      preserve-state
                      preserve-scroll
                      :data="pickBy(props.row.params)"
                      :only="['editing', 'modal', 'basePageRoute', 'availableRoles', 'permissions']"
                      class="inline-flex underline items-center whitespace-nowrap font-medium text-primary-700 hover:text-primary-500">
                    <span>{{ props.row.name }}</span>
                </Link>

                </p>

                <span v-if="props.row.isCurrentTeam" class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800"> Current </span>

                <a :href="preview + '/cache/clear'" target="_blank">

                    <ExternalLinkIcon class="flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300" aria-hidden="true"/>

                </a>


            </div>

        </div>

    </div>
</template>

<style scoped>

</style>
