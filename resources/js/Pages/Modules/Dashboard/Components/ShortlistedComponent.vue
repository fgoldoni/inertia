<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div v-for="item in stats" :key="item.id" class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 w-full h-full shadow overflow-hidden">
        <dt>
            <div class="absolute bg-rose-200 rounded-md p-3">
                <CubeIcon class="h-6 w-6 text-rose-700" aria-hidden="true" />
            </div>
            <p class="ml-16 text-sm font-medium text-gray-500 truncate">{{ item.name }}</p>
        </dt>
        <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
            <p class="text-2xl font-semibold text-gray-900">
                {{ item.stat }}
            </p>
            <p :class="[item.changeType === 'increase' ? 'text-green-600' : 'text-red-600', 'ml-2 flex items-baseline text-sm font-semibold']">
                <ArrowSmUpIcon v-if="item.changeType === 'increase'" class="self-center flex-shrink-0 h-5 w-5 text-green-500" aria-hidden="true" />
                <ArrowSmDownIcon v-else class="self-center flex-shrink-0 h-5 w-5 text-red-500" aria-hidden="true" />
                <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>
                {{ item.change }}
            </p>
            <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                        View all<span class="sr-only"> {{ item.name }} stats</span></a
                    >
                </div>
            </div>
        </dd>
    </div>
</template>

<script setup>
import { ArrowSmDownIcon, ArrowSmUpIcon } from '@heroicons/vue/solid'
import { CubeIcon } from '@heroicons/vue/outline'

const props = defineProps({
    data: Object,
});

const stats = [
    { id: 1, name: 'Total Companies', stat: props.data.companies_count, change: '122', changeType: 'increase' },
]


</script>
