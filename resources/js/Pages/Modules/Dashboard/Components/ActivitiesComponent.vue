<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="relative bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6 w-full h-full shadow overflow-auto">
        <h3 class="text-lg font-medium text-gray-900">Activities</h3>
        <div class="flow-root mt-5">
            <ul role="list" class="-mb-8">
                <li v-for="(event, eventIdx) in props.data.activities" :key="event.id" v-if="props.data.activities">
                    <div class="relative pb-8">
                        <span v-if="eventIdx !== props.data.activities.length - 1" class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" />
                        <div class="relative flex space-x-3">
                            <div>
                              <span :class="['bg-secondary-100 h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white']">
                                  <component :is="setIcon(event.event)" :class="[event.iconBackground, 'h-4 w-4']" aria-hidden="true" />
                              </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        {{ event.description }} <a :href="event.href" class="font-medium text-gray-900">{{ event.target }}</a>
                                    </p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    <time :datetime="event.date">{{ event.date }}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<script setup>
import { CheckIcon, TrashIcon, RefreshIcon, UserIcon, ThumbUpIcon } from '@heroicons/vue/solid'

const props = defineProps({
    data: Object,
});

const setIcon = (icon) => {

    if (icon === 'deleted') return TrashIcon;
    if (icon === 'updated') return RefreshIcon;
    if (icon === 'created') return CheckIcon;

    return CheckIcon;
}

</script>
