<script setup>
import JetLabel from '@/Jetstream/Label.vue'
import {Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import {ref} from "vue";

const props = defineProps({
    modelValue: {
        type: [Boolean],
        default: false,
    },
    label: {
        type: String,
        default: "Enabled",
    },
    placeholder: {
        type: String,
        default: "Enabled",
    },
    text: {
        type: String,
        default: null,
    },
    error: String
});

const enabled = ref(props.modelValue)
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="grid grid-cols-1 gap-4">

        <div class="col-span-1">

            <JetLabel :value="props.placeholder"/>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <SwitchGroup as="div" class="mt-2 flex items-center whitespace-nowrap">
                <Switch v-model="enabled" @update:modelValue="value => emit('update:modelValue', value)" :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
                    <span aria-hidden="true" :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                </Switch>
                <SwitchLabel as="span" class="ml-3">
                    <span class="text-sm font-medium text-gray-900">{{ props.label }}</span>
                </SwitchLabel>
            </SwitchGroup>

        </div>

        <div class="col-span-1" v-if="text">

            <div class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
                {{ props.text }}
            </div>

        </div>

    </div>
</template>
