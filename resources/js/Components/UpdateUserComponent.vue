<script setup>
import {computed, onMounted, reactive, ref} from 'vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import FormSection from '@/Shared/FormSection.vue';
import BaseListbox from '@/Shared/BaseListbox.vue'
import {Errors} from "@/Plugins/errors.js";
import JetButton from '@/Jetstream/Button.vue';
import pickBy from "lodash/pickBy";
import {ElNotification} from "element-plus";
import { useFetch } from '@/Composables/UseFetch.js'
import JetInputPhone from '@/Jetstream/InputPhone.vue';
import {generatePassword, strengthLevels} from '@/Plugins/generatePassword.js'
import zxcvbn from "zxcvbn";

const props = defineProps({
    modelValue: [Object, Array],
    permissions: Object,
});

const score = computed(() => zxcvbn(form.password).score)

const { data: roles, doFetchData: doFetchRoles } = useFetch()

onMounted(() => {
    doFetchRoles(route('api.roles.index'));
})

const emit = defineEmits(["update:modelValue"]);

const showPassword = ref(false)

const form = reactive({
    id: props.modelValue.id,
    name: props.modelValue.name,
    email: props.modelValue.email,
    phone: props.modelValue.phone,
    role: props.modelValue.role,
    verified: props.modelValue.verified,

    errors: new Errors(),
    password: '',
    processing: false,
})

const generate = () => {
    form.password = generatePassword(10)
}

const updateUser = () => {

    form.processing = true;

    axios.put(route('admin.users.update', form.id), pickBy({
        name: form.name,
        email: form.email,
        phone: form.phone,
        role: form.role,
        password: form.password,
        verified: form.verified,
    })).then((response) => {

        form.processing = false;

        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })

        emit('update:modelValue', response.data.model)

    }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });
};
</script>

<template>
    <FormSection :title="__('Update User')" :errors="form.errors" @submitted="updateUser" default-open>

        <template #form>

            <div class="col-span-1">

                <JetLabel for="name" :value="__('Name')" required/>

                <JetInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus/>

                <JetInputError :message="form.errors.get('name')" class="mt-2"/>

            </div>

            <div class="col-span-1">

                <BaseListbox :options="roles.data" v-if="roles.data" v-model="form.role"  placeholder="__('Select roles')" :label="__('Select roles')"/>

                <JetInputError :message="form.errors.get('role')" class="mt-2"/>
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

            <JetInputPhone :error="form.errors.get('phone')" v-model="form.phone"></JetInputPhone>

            <div class="col-span-1 sm:col-span-2">

                <div class="flex items-center justify-between">

                    <JetLabel for="password" value="Password"/>
                    <div
                        class="flex items-center divide-x divide-secondary-200 dark:divide-secondary-600">

                        <button @click="generate" type="button"
                                class="pr-2 text-primary-600 text-sm font-medium leading-5 hover:text-primary-500 hover:underline dark:text-primary-500/50">

                            {{ __('Generate') }}

                        </button>

                        <button @click="showPassword = !showPassword"
                                v-text="showPassword ? __('Hide') : __('Show')"
                                type="button"
                                class="pl-2 text-sm text-leading-5 text-primary-600 hover:text-primary-700 focus:outline-none focus:text-primary-700 hover:underline dark:text-primary-500/50">

                        </button>

                    </div>

                </div>

                <JetInput
                    id="password"
                    name="password"
                    v-model="form.password"
                    :type="showPassword ? 'text' : 'password'"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />
                <JetInputError :message="form.errors.get('password')" class="mt-2"/>
            </div>

            <div class="col-span-1 sm:col-span-2">

                                                                <span class="text-sm">

                                                                    <span
                                                                        class="text-sm font-medium text-secondary-500 truncate">

                                                                        {{ __('Password strength:') }}

                                                                    </span>

                                                                    {{ strengthLevels[score] || __('Weak') }}

                                                                </span>

                <progress :value="score" max="4"
                          class="w-full"></progress>

            </div>

        </template>

        <template v-if="true" #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </FormSection>
</template>
