<script setup>
import {reactive} from 'vue'
import JetInputError from '@/Jetstream/InputError.vue';
import FormSection from '@/Shared/FormSection.vue';
import BaseListbox from '@/Shared/BaseListbox.vue'
import {Errors} from "@/Plugins/errors.js";
import JetButton from '@/Jetstream/Button.vue';
import pickBy from "lodash/pickBy";
import {ElNotification} from "element-plus";

const props = defineProps({
    modelValue: [Object, Array],
    states: [Object, Array]
});


const emit = defineEmits(["update:modelValue"]);


const form = reactive({
    id: props.modelValue.id,
    status: props.modelValue.status,

    errors: new Errors(),
    processing: false,
})



const updateApplicantStatus = () => {

    form.processing = true;

    axios.put(route('admin.applicants.update', form.id), pickBy({
        status: props.modelValue.status,
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
    <FormSection :title="__('Update Status')" :errors="form.errors" @submitted="updateApplicant" default-open>

        <template #form>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="states" v-if="states" v-model="form.status"  :placeholder="__('Select status')" :label="__('Select status')"/>

                <JetInputError :message="form.errors.get('status')" class="mt-2"/>

            </div>

        </template>

        <template v-if="true" #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </FormSection>
</template>
