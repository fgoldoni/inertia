<script setup>
import { ref, watch } from 'vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'

import debounce from "lodash/debounce";
import { useFetch } from '@/Composables/UseFetch'
import pickBy from "lodash/pickBy";

const { data: items, doInitData, doFetchData } = useFetch()

const props = defineProps({
    label: {
        type: String,
        default: null,
    },
    apiUrl: String,
    modelValue: [String, Number, Array],
    countryId: {
        type: Number,
        default: null,
    },
    defaultValue: {
        type: String,
        default: null,
    },
    placeholder: {
        type: String,
        default: "Select option",
    },
    multiple: Boolean,
    error: String
});



const query = ref('')

const emit = defineEmits(["update:modelValue"]);

watch(query, debounce(() => doFetchData(route(props.apiUrl, pickBy({search: query.value, country_id: props.countryId}))), 500), {deep: true});

const label = (person) => {

    if (!person) return

    if (!items.value.data) return props.defaultValue

    return items.value.data
        .filter(option => {
            if (Array.isArray(person)) {
                return person.includes(option.id);
            }

            return person === option.id;
        })
        .map(option => option.name)
        .join(", ");
};
</script>

<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

        <div class="col-span-1">
            <Combobox as="div"  :model-value="props.modelValue" @update:modelValue="value => emit('update:modelValue', value)">
                <ComboboxLabel class="block text-sm font-medium text-gray-500" v-if="props.label">{{ '--- ' + props.label + ' ---' }}</ComboboxLabel>
                <div class="relative mt-1">
                    <ComboboxInput class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" :placeholder="'--- ' + props.placeholder + ' ---'" @change="query = $event.target.value" :display-value="label" autocomplete="off"/>
                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                        <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </ComboboxButton>

                    <ComboboxOptions v-if="items.data" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                        <ComboboxOption v-for="option in items.data" :key="option.id" :value="option.id" as="template" v-slot="{ active, selected }">
                            <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                <div class="flex items-center">
                                    <span v-if="option.hasOwnProperty('online')" :class="['inline-block h-2 w-2 flex-shrink-0 rounded-full mr-3', option.online ? 'bg-green-400' : 'bg-gray-200']" aria-hidden="true" />
                                    <span v-if="option.emoji" class="inline-block flex-shrink-0  mr-3" aria-hidden="true" v-html="option.emoji"/>
                                    <span v-if="option.country" class="inline-block flex-shrink-0  mr-3" aria-hidden="true" v-html="option.country?.emoji"/>
                                    <span :class="['truncate', selected && 'font-bold']">
                                        {{ option.name }}
                                        <span class="sr-only"> is {{ option.online ? 'online' : 'offline' }}</span>
                                    </span>
                                    <span v-if="option.division" :class="['ml-2 truncate text-gray-500', active ? 'text-indigo-200' : 'text-gray-500']">
                                        {{ option.division?.name }}
                                    </span>
                                </div>

                                <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
              <CheckIcon class="h-5 w-5" aria-hidden="true" />
            </span>
                            </li>
                        </ComboboxOption>
                    </ComboboxOptions>
                </div>
            </Combobox>
        </div>

    </div>
</template>

