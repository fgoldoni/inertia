<script setup>
import {ref, reactive, onMounted} from 'vue'
import BaseDisclosure from '@/Components/BaseDisclosure'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetTextarea from '@/Jetstream/Textarea'
import JetInputError from '@/Jetstream/InputError.vue';
import ValidationErrors from '@/Shared/ValidationErrors';
import {Errors} from "@/Plugins/errors";
import Information from '@/Shared/Information'

const props = defineProps({
    team: Object,
    availableRoles: Object,
});

const form = reactive({
    id: props.team.id,
    email: props.team.email,
    role: props.team.role,

    errors: new Errors(),
    processing: false,
})
</script>

<template>
    <BaseDisclosure :title="__('Add Team Member')">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2" v-if="form.errors.any()">
                <ValidationErrors :errors="form.errors.all()" class="mb-4" />
            </div>

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

                    <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>

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

        </div>

    </BaseDisclosure>
</template>
