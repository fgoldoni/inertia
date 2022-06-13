<script setup>
import {ShieldExclamationIcon, ShieldCheckIcon, RefreshIcon} from '@heroicons/vue/outline';
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";

const props = defineProps({
    row: Object,
});

const form = reactive({
    processing: false,
});

const sendEmailVerificationNotification = (id) => {
    form.processing = true;

    return axios.get(route('admin.users.verification.send', { user: id })).then(response => {
        form.processing = false;
        Inertia.reload({ only: ["flash"] });
        console.log(response.data.message)
    });
};
</script>

<template>
    <div class="flex">

        <div class="group inline-flex space-x-2 truncate text-sm cursor-pointer">

            <ShieldCheckIcon v-if="props.row.verified" class="flex-shrink-0 h-5 w-5 text-green-500 group-hover:text-green-700" aria-hidden="true"/>
            <ShieldExclamationIcon v-else class="flex-shrink-0 h-5 w-5 text-rose-500 group-hover:text-rose-700" aria-hidden="true"/>

            <p class="text-gray-500 truncate group-hover:text-gray-900">

                {{ props.row.email }}

            </p>

        </div>

    </div>

    <button  @click="sendEmailVerificationNotification(props.row.id)" v-if="!props.row.verified" :key="'email' + props.row.id" class="mt-2 group inline-flex items-center space-x-2 truncate text-sm text-primary-700" :class="{ 'cursor-not-allowed': form.processing }" :disabled="form.processing">
        <RefreshIcon v-if="form.processing" class="animate-spin flex-shrink-0 h-5 w-5 text-secondary-400 group-hover:text-secondary-500" aria-hidden="true" />
        <p :class="{ 'opacity-25': form.processing }" class="underline text-gray-500 truncate group-hover:text-gray-900">
            {{ __('Resend Verification Email') }}
        </p>
    </button>
</template>

<style scoped>

</style>
