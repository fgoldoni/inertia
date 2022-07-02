<script setup>
import {RefreshIcon} from '@heroicons/vue/outline';
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import { ElNotification } from 'element-plus'
import {Errors} from "@/Plugins/errors";

const props = defineProps({
    row: Object,
});

const form = reactive({
    processing: false,
    errors: new Errors(),
});


const restore = (id) => {
    form.processing = true;

    return axios.put(route('admin.users.restore', id)).then((response) => {
        form.processing = false;
        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })
        Inertia.reload({ only: ["rowData"] });
    }).catch(error => {
        form.processing = false;
        form.errors.record(error.response.data.errors);
    });
};
</script>

<template>
    <div class="flex items-center">

        <div class="h-10 w-10 flex-shrink-0">

            <img class="h-10 w-10 rounded-full" :src="props.row.image" alt=""/>

        </div>

        <div class="ml-4">

            <div class="group inline-flex space-x-2 truncate text-sm">

                <p :class="[props.row.deleted_at ? 'text-negative-500 line-through' : 'text-gray-900', 'font-medium truncate group-hover:text-gray-900']">

                    {{ props.row.name }}

                </p>

                <a :href="route('impersonate', props.row.id)" v-if="props.row.can.impersonate && !($page.props.user.id === props.row.id)" class="text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300">
                    Login As &#x2192;
                </a>

                <button  @click="restore(props.row.id)" v-if="props.row.deleted_at" :key="'restore' + props.row.id" class="group inline-flex items-center space-x-2 truncate text-sm text-blue-700" :class="{ 'cursor-not-allowed': form.processing }" :disabled="form.processing">
                    <RefreshIcon v-if="form.processing" class="animate-spin flex-shrink-0 h-5 w-5 text-secondary-400 group-hover:text-secondary-500" aria-hidden="true" />
                    <p :class="{ 'opacity-25': form.processing }" class="underline group-hover:text-blue-900 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300">
                        {{ __('Restore') }}
                    </p>
                </button>


            </div>

            <div class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">Registered on  {{ props.row.created_at }}</div>

        </div>

    </div>
</template>

<style scoped>

</style>
