<script setup>
import ActionSection from '@/Shared/ActionSection';
import {reactive} from "vue";
import {Errors} from "@/Plugins/errors";
import {ElNotification} from "element-plus";

const props = defineProps({
    team: Object,
});

const form = reactive({
    id: props.team.id,

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
        }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });
};
</script>

<template>
    <ActionSection :title="__('Pending Team Invitations')" :errors="form.errors">

        <template #content>
            <div class="space-y-6">
                <div v-for="invitation in team.teamInvitations" :key="invitation.id" class="flex items-center justify-between">
                    <div class="text-gray-500">
                        {{ invitation.email }}
                    </div>

                    <div class="flex items-center">
                        <!-- Cancel Team Invitation -->
                        <button
                            v-if="true"
                            class="cursor-pointer ml-6 text-sm text-red-600 focus:outline-none"
                            @click="cancelTeamInvitation(invitation)"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </ActionSection>
</template>

