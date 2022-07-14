<script setup>
import { reactive, computed } from 'vue'
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'
import {Errors} from "@/Plugins/errors";
import {ElNotification} from "element-plus";
import pickBy from "lodash/pickBy";
import chunk from "lodash/chunk";


const props = defineProps({
    modelValue: [Object, Array]
});

const emit = defineEmits(["update:modelValue"]);

const form = reactive({
    id: props.modelValue.id,

    errors: new Errors(),
    processing: false,
})
const color = computed(() => props.modelValue.color)

const updateTeamColor = (color) => {
    form.processing = true;

    axios.put(route('admin.teams.color.update', form.id), pickBy({
        color: color,
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
    <RadioGroup v-model="color" @update:modelValue="updateTeamColor($event)">
        <RadioGroupLabel class="block text-sm font-medium text-gray-700">Choose a label color</RadioGroupLabel>
        <div class="mt-4 flex items-center space-x-3">
            <div v-for="colors in chunk(props.modelValue.colors, 4)" class="space-y-12">
                <RadioGroupOption as="template" v-for="color in colors" :key="color.id" :value="color.id" v-slot="{ active, checked }">
                    <div :class="[color.selectedColor, active && checked ? 'ring ring-offset-1' : '', !active && checked ? 'ring-2' : '', '-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none']">
                        <RadioGroupLabel as="span" class="sr-only">{{ color.name }}</RadioGroupLabel>
                        <span aria-hidden="true" :class="[color.bgColor, 'h-8 w-8 border border-black border-opacity-10 rounded-full']" />
                    </div>
                </RadioGroupOption>
            </div>
        </div>
    </RadioGroup>
</template>
