<script setup>
import {reactive} from 'vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import FormSection from '@/Shared/FormSection';
import Information from '@/Shared/Information';
import {Errors} from "@/Plugins/errors";
import JetButton from '@/Jetstream/Button';
import pickBy from "lodash/pickBy";
import {ElNotification} from "element-plus";

const props = defineProps({
    modelValue: [Object, Array],
    availableRoles: Object,
});

const emit = defineEmits(["update:modelValue"]);

const form = reactive({
    id: props.modelValue.id,
    email: '',
    role: null,

    errors: new Errors(),
    processing: false,
})

const updateTeamOwner = () => {
    form.processing = true;

    axios.post(route('admin.teams.members.store', form.id), pickBy({
        email: form.email,
        role: form.role,
    })).then((response) => {

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
}
</script>

<template>
    <FormSection :title="__('Add Team Member')" :errors="form.errors" @submitted="updateTeamOwner">

        <template #form>
            <div class="col-span-1 sm:col-span-2">
                <Information text="Please provide the email address of the person you would like to add to this team."></Information>
            </div>

            <div class="col-span-1 sm:col-span-2">

                <JetLabel for="email" value="Email"/>

                <JetInput
                    id="email"
                    name="email"
                    v-model="form.email"
                    type="text"
                    class="mt-1 block w-full"
                    required/>

                <JetInputError :message="form.errors.get('email')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">
                <!-- Role -->
                <div v-if="props.availableRoles.length > 0" class="col-span-6 lg:col-span-4">
                    <JetLabel for="roles" value="Role" />

                    <JetInputError :message="form.errors.get('role')" class="mt-2"/>

                    <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                        <button
                            v-for="(role, i) in availableRoles"
                            :key="role.key"
                            type="button"
                            class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200"
                            :class="{'border-t border-gray-200 rounded-t-none': i > 0, 'rounded-b-none': i != Object.keys(availableRoles).length - 1}"
                            @click="form.role = role.key"
                        >
                            <div :class="{'opacity-50': form.role && form.role != role.key}">
                                <!-- Role Name -->
                                <div class="flex items-center">
                                    <div class="text-sm text-gray-600" :class="{'font-semibold': form.role == role.key}">
                                        {{ role.name }}
                                    </div>

                                    <svg
                                        v-if="form.role == role.key"
                                        class="ml-2 h-5 w-5 text-green-400"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>

                                <!-- Role Description -->
                                <div class="mt-2 text-xs text-gray-600 text-left">
                                    {{ role.description }}
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>

    </FormSection>
</template>
