<!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <form action="#" class="relative">
        <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <label for="title" class="sr-only">Title</label>
            <input type="text" name="title" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Title" />
            <label for="description" class="sr-only">Description</label>
            <textarea rows="4" name="description" id="description" class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description..." />

            <!-- Spacer element to match the height of the toolbar -->
            <div aria-hidden="true">
                <div class="py-2">
                    <div class="h-9" />
                </div>
                <div class="h-px" />
                <div class="py-2">
                    <div class="py-px">
                        <div class="h-9" />
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 inset-x-px">
            <!-- Actions: These are just examples to demonstrate the concept, replace/wire these up however makes sense for your project. -->
            <div class="flex flex-nowrap justify-end py-2 px-2 space-x-2 sm:px-3">
                <RadioGroup v-model="mem" class="mt-2">
                    <RadioGroupLabel class="sr-only"> Choose a memory option </RadioGroupLabel>
                    <div class="grid grid-cols-3 gap-3">
                        <RadioGroupOption as="template" v-for="option in memoryOptions" :key="option.name" :value="option" :disabled="!option.inStock" v-slot="{ active, checked }">
                            <div :class="[option.inStock ? 'cursor-pointer focus:outline-none' : 'opacity-25 cursor-not-allowed', active ? 'ring-2 ring-offset-2 ring-indigo-500' : '', checked ? 'bg-indigo-600 border-transparent text-white hover:bg-indigo-700' : 'bg-white border-gray-200 text-gray-900 hover:bg-gray-50', 'border rounded-md py-3 px-3 flex items-center justify-center text-sm font-medium uppercase sm:flex-1']">
                                <RadioGroupLabel as="span">
                                    {{ option.name }}
                                </RadioGroupLabel>
                            </div>
                        </RadioGroupOption>
                    </div>
                </RadioGroup>
            </div>
            <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
                <div class="flex-1">
                    <div class="w-full grid grid-cols-1 gap-4 sm:grid-cols-1">

                        <div class="col-span-1" v-if="mem.name == 'Responsibilities'">

                            <BaseListbox :options="props.options.responsibilities" v-model="form.responsibility"  placeholder="Select Responsibilities"/>

                        </div>

                        <div class="col-span-1" v-if="mem.name == 'Skills'">

                            <BaseListbox :options="props.options.skills" v-model="form.skill"  placeholder="Select Skills"/>

                        </div>

                        <div class="col-span-1" v-if="mem.name == 'Benefits'">

                            <BaseListbox :options="props.options.benefits" v-model="form.Benefit"  placeholder="Select Benefits"/>

                        </div>

                    </div>
                </div>
                <div class="flex-shrink-0">
                    <button type="submit" class="uppercase inline-flex items-center px-7 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { ref, reactive } from 'vue'
import BaseDisclosure from '@/Components/BaseDisclosure'
import BaseListbox from '@/Shared/BaseListbox'

import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const props = defineProps({
    editing: Object,
    options: Object,
});

const form = reactive({
    responsibility: 1,
    skill: 1,
})



const memoryOptions = [
    { name: 'Responsibilities', inStock: true },
    { name: 'Skills', inStock: true },
    { name: 'Benefits', inStock: true },
]

const mem = ref(memoryOptions[0])

const assignees = [
    { name: 'Unassigned', value: null },
    {
        name: 'Wade Cooper',
        value: 'wade-cooper',
        avatar:
            'https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    // More items...
]
const labels = [
    { name: 'Unlabelled', value: null },
    { name: 'Engineering', value: 'engineering' },
    // More items...
]
const dueDates = [
    { name: 'No due date', value: null },
    { name: 'Today', value: 'today' },
    // More items...
]

const assigned = ref(assignees[0])
const labelled = ref(labels[0])
const dated = ref(dueDates[0])
</script>
