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
import JetTextarea from '@/Jetstream/Textarea.vue'

const props = defineProps({
    modelValue: [Object, Array]
});


const { data: items, doFetchData } = useFetch()

onMounted(() => {
    doFetchData(route('admin.applicants.show', props.modelValue.id));
})

const emit = defineEmits(["update:modelValue"]);


const form = reactive({
    id: props.modelValue.id,
    status: props.modelValue.status,
    message: props.modelValue.message,
    phone: props.modelValue.phone,
    job_id: props.modelValue.job_id,
    user_id: props.modelValue.user_id,

    errors: new Errors(),
    processing: false,
})



const updateApplicant = () => {

    form.processing = true;

    axios.put(route('admin.applicants.update', form.id), pickBy({
        status: props.modelValue.status,
        message: props.modelValue.message,
        phone: props.modelValue.phone,
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
    <FormSection :title="__('Update Applicant')" :errors="form.errors" @submitted="updateApplicant" default-open v-if="items.data">

        <template #form>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="items.data.candidates" v-if="items.data.candidates" v-model="form.user_id"  :placeholder="__('Select candidate')" :label="__('Select candidate')"/>

                <JetInputError :message="form.errors.get('user_id')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="items.data.jobs" v-if="items.data.jobs" v-model="form.job_id"  :placeholder="__('Select job')" :label="__('Select job')"/>

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



            <JetInputPhone :error="form.errors.get('phone')" v-model="form.phone"></JetInputPhone>

        </template>

        <template v-if="true" #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </FormSection>
</template>
