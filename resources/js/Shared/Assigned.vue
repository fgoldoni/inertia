<script setup>
import { ref ,watch } from 'vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import { Combobox, ComboboxButton, ComboboxInput, ComboboxLabel, ComboboxOption, ComboboxOptions} from '@headlessui/vue'
import debounce from "lodash/debounce";
import { useUsers } from '@/Composables/UseUsers'
import UsersList from '@/Components/UsersList'

const { data: users, doFetchData: doFetchUsers, doMapData, doMergeData } = useUsers()

const props = defineProps({
    items: {
        type: Array,
        default: [],
    },
});


const query = ref('')
const filteredAssigned = ref(props.items)
const selectedAssigned = ref(props.items.map((r) => r.id))

const emit = defineEmits(['onAssigned']);

watch(query, debounce(() => doFetchUsers({search: query.value}), 500), {deep: true});
watch(selectedAssigned, debounce(() => filteredAssigned.value = doMergeData([...props.items, ...doMapData([...users.value.data, ...filteredAssigned.value], selectedAssigned)]), 500), {deep: true});

</script>

<template>
    <div class="col-span-1">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

            <div class="col-span-1">

                <Combobox as="div" v-model="selectedAssigned" multiple @update:modelValue="$emit('onAssigned', $event)">

                    <ComboboxLabel class="block text-sm font-medium text-gray-700">Assigned to</ComboboxLabel>

                    <div class="relative mt-1">

                        <ComboboxInput class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" @change="query = $event.target.value" :display-value="(person) => person?.name" />

                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">

                            <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />

                        </ComboboxButton>

                        <ComboboxOptions v-if="users.data" class="absolute z-20 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ComboboxOption v-for="person in users.data" :key="person.id" :value="person.id" as="template" v-slot="{ active, selected }">
                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                    <div class="flex items-center">
                                        <img :src="person.profile_photo_url" alt="" class="h-6 w-6 flex-shrink-0 rounded-full" />
                                        <span :class="['ml-3 truncate', selected && 'font-semibold']">
                {{ person.name }}
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

            <div class="col-span-1">

                <div class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">

                    {{ __('These are the members who are already in your store with their associated roles.') }}

                </div>

            </div>

            <div class="col-span-1">

                <UsersList :items="filteredAssigned"></UsersList>

            </div>

        </div>

    </div>
</template>
