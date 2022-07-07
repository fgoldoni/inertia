<script setup>
import ActionSection from '@/Shared/ActionSection';
import {reactive} from "vue";
import {Errors} from "@/Plugins/errors";
import {ElNotification} from "element-plus";
import {usePage} from "@inertiajs/inertia-vue3";

const props = defineProps({
    modelValue: [Object, Array],
    availableRoles: Object,
    permissions: Object,
});

const emit = defineEmits(["update:modelValue"]);

const form = reactive({
    id: props.modelValue.id,

    errors: new Errors(),
    processing: false,
})

const displayableRole = (role) => {
    return props.availableRoles.find(r => r.key === role).name;
};

const leaveTeam = () => {
    axios.delete(route('admin.teams.members.destroy', [props.modelValue, usePage().props.value.user]))
        .then((response) => {

            form.processing = false;

            ElNotification({
                title: 'Great!',
                message: response.data.message,
                type: 'success',
            })

            emit('update:modelValue', response.data.team)

        }).catch(error => {
            form.processing = false;
            form.errors.onFailed(error);
        });
};

const removeTeamMember = (user) => {
    axios.delete(route('admin.teams.members.destroy', [props.modelValue, user]))
        .then((response) => {

            form.processing = false;

            ElNotification({
                title: 'Great!',
                message: response.data.message,
                type: 'success',
            })

            emit('update:modelValue', response.data.team)

        }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });
};
</script>

<template>
    <ActionSection :title="__('Team Members')" :errors="form.errors">

        <template #content>
            <div class="mt-5 md:mt-0 col-span-1 sm:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow-md sm:rounded-lg">
                    <div class="space-y-6">
                        <div v-for="user in props.modelValue.members" :key="user.id" class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="w-8 h-8 rounded-full" :src="user.profile_photo_url" :alt="user.name">
                                <div class="ml-4">
                                    {{ user.name }}
                                </div>
                            </div>

                            <div class="flex items-center">
                                <!-- Manage Team Member Role -->
                                <div v-if="availableRoles.length" class="ml-2 text-sm text-gray-400">
                                    {{ displayableRole(user.membership?.role) }}
                                </div>

                                <!-- Leave Team -->
                                <button
                                    v-if="$page.props.user.id === user.id"
                                    class="cursor-pointer ml-6 text-sm text-red-500"
                                    @click="leaveTeam"
                                >
                                    Leave
                                </button>

                                <!-- Remove Team Member -->
                                <button
                                    v-if="props.permissions.canRemoveTeamMembers"
                                    class="cursor-pointer ml-6 text-sm text-red-500"
                                    @click="removeTeamMember(user)"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </ActionSection>
</template>

