<script setup>
import ActionSection from '@/Shared/ActionSection.vue';
import {reactive} from "vue";
import {Errors} from "@/Plugins/errors.js";
import {ElNotification} from "element-plus";

const props = defineProps({
    modelValue: [Object, Array],
    permissions: Object,
});

const emit = defineEmits(["update:modelValue"]);

const form = reactive({
    id: props.modelValue.id,

    errors: new Errors(),
    processing: false,
})

const cancelTeamInvitation = (invitation) => {
    axios.delete(route('admin.teams.invitations.destroy', invitation))
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
    <ActionSection :title="__('Pending Team Invitations')" :errors="form.errors">

        <template #content>
            <div class="mt-5 md:mt-0 col-span-1 sm:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow-md sm:rounded-lg">
                    <div class="space-y-6">
                        <div v-for="invitation in props.modelValue.teamInvitations" :key="invitation.id" class="flex items-center justify-between">
                            <div class="text-gray-500">
                                {{ invitation.email }}
                            </div>

                            <div class="flex items-center">
                                <!-- Cancel Team Invitation -->
                                <button
                                    v-if="props.permissions.canRemoveTeamMembers"
                                    class="cursor-pointer ml-6 text-sm text-red-600 focus:outline-none"
                                    @click="cancelTeamInvitation(invitation)"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </ActionSection>
</template>

