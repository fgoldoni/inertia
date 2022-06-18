<script setup>
import { ref, watch } from 'vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import { Combobox, ComboboxButton, ComboboxInput, ComboboxLabel, ComboboxOption, ComboboxOptions } from '@headlessui/vue'
import debounce from "lodash/debounce";
import { useFetch } from '@/Composables/UseFetch'

const { data: items, doFetchData } = useFetch()

const emit = defineEmits(['onSelected']);

const props = defineProps({
    selected: {
        type: Object,
        default: null,
    }
});

const query = ref('')
const selectedItem = ref(props.selected)

watch(query, debounce(() => doFetchData(route('api.categories.index', {search: query.value})), 500), {deep: true});

watch(selectedItem, debounce((value) => emit('onSelected', value.id), 500), {deep: true});

</script>

<template>
    <div class="col-span-1 sm:col-span-2">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

            <div class="col-span-1">
                <Combobox as="div" v-model="selectedItem">
                    <ComboboxLabel class="block text-sm font-medium text-gray-700">Assigned to</ComboboxLabel>
                    <div class="relative mt-1">
                        <ComboboxInput class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" @change="query = $event.target.value" :display-value="(person) => person?.name" />
                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                            <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </ComboboxButton>

                        <ComboboxOptions v-if="items.data" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ComboboxOption v-for="person in items.data" :key="person.id" :value="person" as="template" v-slot="{ active, selected }">
                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                    <div class="flex items-center">
                                        <span :class="['inline-block h-2 w-2 flex-shrink-0 rounded-full', person.online ? 'bg-green-400' : 'bg-gray-200']" aria-hidden="true" />
                                        <span :class="['ml-3 truncate', selected && 'font-semibold']">
                {{ person.name }}
                <span class="sr-only"> is {{ person.online ? 'online' : 'offline' }}</span>
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

    </div>

</template>
