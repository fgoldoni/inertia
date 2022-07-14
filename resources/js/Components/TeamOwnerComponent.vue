<script setup>
import {reactive} from 'vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import FormSection from '@/Shared/FormSection.vue';
import Information from '@/Shared/Information.vue';
import {Errors} from "@/Plugins/errors";
import JetButton from '@/Jetstream/Button.vue';
import pickBy from "lodash/pickBy";
import {ElNotification} from "element-plus";
import BaseListbox from '@/Shared/BaseListbox.vue'


const props = defineProps({
    modelValue: [Object, Array],
    permissions: Object,
});

const emit = defineEmits(["update:modelValue"]);

const form = reactive({
    id: props.modelValue.id,
    name: props.modelValue.name,
    subdomain: props.modelValue.subdomain,
    display_name: props.modelValue.display_name,
    industry: props.modelValue.categories?.find(element => element.type === "industry")?.id,

    errors: new Errors(),
    processing: false,
})

const updateTeamOwner = () => {
    form.processing = true;

    axios.put(route('admin.teams.update', form.id), pickBy({
        name: form.name,
        subdomain: form.subdomain,
        display_name: form.display_name,
        industry: form.industry,
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
    <FormSection :title="__('Team Owner')" :errors="form.errors" @submitted="updateTeamOwner" default-open>

        <template #form>

            <div class="col-span-1 sm:col-span-2">
                <Information text="You just have a read only access for the Team"></Information>
            </div>
            <div class="col-span-1">


                <JetLabel for="name" :value="__('Name')" required/>

                <JetInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    :disabled="!props.permissions.canUpdateTeam"
                    autofocus/>

                <JetInputError :message="form.errors.get('name')" class="mt-2"/>

            </div>

            <div class="col-span-1">

                <JetLabel for="name" :value="__('Display Name')" required/>

                <JetInput
                    id="display_name"
                    name="display_name"
                    v-model="form.display_name"
                    type="text"
                    class="mt-1 block w-full"
                    :disabled="!props.permissions.canUpdateTeam"
                    required/>

                <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <BaseListbox :options="props.modelValue.industries" v-model="form.industry" placeholder="Industries" label="Industries"/>

                <JetInputError :message="form.errors.get('industry')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <JetLabel for="name" :value="__('Domain')" required/>

                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> https:// </span>
                    <input type="text" name="subdomain" id="subdomain"  v-model="form.subdomain" class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300" :disabled="!props.permissions.canUpdateTeam" placeholder="example" />
                    <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> .wedo37.com </span>
                </div>

                <JetInputError :message="form.errors.get('subdomain')" class="mt-2"/>

            </div>
        </template>

        <template v-if="props.permissions.canUpdateTeam" #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </FormSection>
</template>
