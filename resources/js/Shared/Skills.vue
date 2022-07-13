<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 space-y-4">

        <div class="col-span-1 sm:col-span-2">

            <h3 class="text-sm font-medium text-gray-900">Key Responsibilities</h3>

            <div class="mt-4">
                <ul role="list" class="pl-4 list-disc text-sm space-y-2">
                    <li v-for="responsibility in responsibilities" :key="responsibility.id" class="text-gray-400">
                        <span class="text-gray-600" v-text="responsibility.name"></span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-span-1 sm:col-span-2">

            <h3 class="text-sm font-medium text-gray-900">Skill & Experience</h3>

            <div class="mt-4">
                <ul role="list" class="pl-4 list-disc text-sm space-y-2">
                    <li v-for="skill in skills" :key="skill.id" class="text-gray-400">
                        <span class="text-gray-600" v-text="skill.name"></span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-span-1 sm:col-span-2">

            <h3 class="text-sm font-medium text-gray-900">Benefits</h3>

            <div class="mt-4">
                <ul role="list" class="pl-4 list-disc text-sm space-y-2">
                    <li v-for="benefit in benefits" :key="benefit.id" class="text-gray-400">
                        <span class="text-gray-600" v-text="benefit.name"></span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-span-1 sm:col-span-2">

            <div class="flex flex-nowrap justify-between py-2 space-x-2">
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

        </div>

        <div class="col-span-1 sm:col-span-2" v-if="mem.name == 'Responsibilities'">

            <BaseListbox :options="props.options.responsibilities" v-model="form.responsibilities" placeholder="Select Responsibilities" label="Select Responsibilities" multiple/>

        </div>

        <div class="col-span-1 sm:col-span-2" v-if="mem.name == 'Skills'">

            <BaseListbox :options="props.options.skills" v-model="form.skills"  placeholder="Select Skills" label="Select Skills" multiple/>

        </div>

        <div class="col-span-1 sm:col-span-2" v-if="mem.name == 'Benefits'">

            <BaseListbox :options="props.options.benefits" v-model="form.benefits"  placeholder="Select Benefits" label="Select Benefits" multiple/>

        </div>

        <div class="col-span-1 sm:col-span-2">
            <Information :text="'Please follow this link to add the new ' + mem.name" :url-text="'Add ' +  mem.name" :url="route('admin.categories.index')"></Information>
        </div>

    </div>

</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue'
import BaseListbox from '@/Shared/BaseListbox.vue'
import Information from '@/Shared/Information.vue'

import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const props = defineProps({
    editing: Object,
    options: Object,
    modelValue: [Object, Array],
});

const emit = defineEmits(['update:modelValue']);

const responsibilities = computed(() => props.options.responsibilities.filter(element => form.responsibilities.includes(element.id)))
const benefits = computed(() => props.options.benefits.filter(element => form.benefits.includes(element.id)))
const skills = computed(() => props.options.skills.filter(element => form.skills.includes(element.id)))

const form = reactive({
    responsibilities: props.modelValue.responsibilities,
    skills: props.modelValue.skills,
    benefits: props.modelValue.benefits,
})

watch(form, () => emit('update:modelValue', form));

const memoryOptions = [
    { name: 'Responsibilities', inStock: true },
    { name: 'Skills', inStock: true },
    { name: 'Benefits', inStock: true },
]

const mem = ref(memoryOptions[0])
</script>
