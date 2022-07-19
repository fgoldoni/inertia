<script setup>
import {reactive} from 'vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import FormSection from '@/Shared/FormSection.vue';
import BaseListbox from '@/Shared/BaseListbox.vue'
import {Errors} from "@/Plugins/errors.js";
import JetButton from '@/Jetstream/Button.vue';
import pickBy from "lodash/pickBy";
import {ElNotification} from "element-plus";
import JetInputPhone from '@/Jetstream/InputPhone.vue';
import JetTextarea from '@/Jetstream/Textarea.vue'

const props = defineProps({
    modelValue: [Object, Array],
    states: [Object, Array],
    data: [Object, Array],
    enabled: [Boolean]
});

const emit = defineEmits(["close"]);

const form = reactive({
    status: props.modelValue.status,
    message: props.modelValue.message,
    phone: props.modelValue.phone,
    job_id: props.modelValue.job_id,
    user_id: props.modelValue.user_id,

    errors: new Errors(),
    processing: false,
})



const storeApplicant = () => {

    form.processing = true;

    axios.post(route('admin.applicants.store'), pickBy({
        message: form.message,
        phone: form.phone,
        job_id: form.job_id,
        user_id: form.user_id,
        enabled: props.enabled,
    })).then((response) => {

        form.processing = false;

        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })

        emit('close')

    }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });
};
</script>

<template>
    <FormSection :title="__('Store Applicant')" :errors="form.errors" @submitted="storeApplicant" default-open>

        <template #form>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="data.candidates" v-if="data.candidates" v-model="form.user_id"  :placeholder="__('Select candidate')" :label="__('Select candidate')"/>

                <JetInputError :message="form.errors.get('user_id')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="data.jobs" v-if="data.jobs" v-model="form.job_id"  :placeholder="__('Select job')" :label="__('Select job')"/>

                <JetInputError :message="form.errors.get('job_id')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <JetLabel for="content" value="Note" optional/>

                <JetTextarea
                    id="content"
                    name="content"
                    v-model="form.message"
                    type="text"
                    class="mt-1 block w-full"/>


                <JetInputError :message="form.errors.get('message')" class="mt-2"/>
            </div>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="props.states" v-model="form.status"  :placeholder="__('Select status')" :label="__('Select status')"/>

                <JetInputError :message="form.errors.get('status')" class="mt-2"/>

            </div>

            <JetInputPhone :error="form.errors.get('phone')" v-model="form.phone"></JetInputPhone>

        </template>

        <template v-if="true" #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </FormSection>
</template>
