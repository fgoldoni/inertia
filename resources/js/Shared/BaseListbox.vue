<template>

    <Listbox as="div" :model-value="props.modelValue" :multiple="props.multiple" @update:modelValue="value => emit('update:modelValue', value)">

        <ListboxLabel class="block text-sm font-medium text-gray-700"> {{ props.placeholder }} </ListboxLabel>

        <div class="mt-1 relative">

            <ListboxButton class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-3 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                <span class="block truncate" v-if="label">{{ label }}</span>
                <span class="text-gray-500" v-else>{{ props.placeholder }}</span>

                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">

                    <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />

                </span>

            </ListboxButton>

            <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">

                <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">

                    <ListboxOption as="template" v-for="option in props.options" :key="option.name" :value="option.id" v-slot="{ active, selected }">

                       <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                          <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                            {{ option.name }}
                          </span>

                          <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                          </span>

                        </li>
                    </ListboxOption>

                </ListboxOptions>

            </transition>

        </div>

    </Listbox>

</template>

<script setup>
import { ref, computed } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'

const props = defineProps({
    options: [Array, Object],
    modelValue: [String, Number, Array],
    placeholder: {
        type: String,
        default: "Select option",
    },
    multiple: Boolean,
    error: String
});

const label = computed(() => {
    return props.options
        .filter(option => {
            if (Array.isArray(props.modelValue)) {
                return props.modelValue.includes(option.id);
            }

            return props.modelValue === option.id;
        })
        .map(option => option.name)
        .join(", ");
});



const emit = defineEmits(["update:modelValue"]);

</script>
