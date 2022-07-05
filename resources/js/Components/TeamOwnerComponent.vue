<script setup>
import {ref, reactive, onMounted} from 'vue'
import BaseDisclosure from '@/Components/BaseDisclosure'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetTextarea from '@/Jetstream/Textarea'
import JetInputError from '@/Jetstream/InputError.vue';
import ValidationErrors from '@/Shared/ValidationErrors';
import {Errors} from "@/Plugins/errors";

const props = defineProps({
    team: Object,
});

const form = reactive({
    id: props.team.id,
    name: props.team.name,
    subdomain: props.team.subdomain,
    display_name: props.team.display_name,

    errors: new Errors(),
    processing: false,
})

</script>

<template>
    <BaseDisclosure :title="__('Team Owner')" default-open>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2" v-if="form.errors.any()">
                <ValidationErrors :errors="form.errors.all()" class="mb-4" />
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
                    required/>

                <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <JetLabel for="name" :value="__('Domain')" required/>

                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> https:// </span>
                    <input type="text" name="subdomain" id="subdomain"  v-model="form.subdomain" class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300" placeholder="example" />
                    <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> .wedo37.com </span>
                </div>

                <JetInputError :message="form.errors.get('display_name')" class="mt-2"/>

            </div>

        </div>

    </BaseDisclosure>
</template>
