<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-secondary-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
            <Link :href="data.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-secondary-300 text-sm font-medium rounded-md text-secondary-700 bg-white hover:bg-secondary-50"> Previous </Link>
            <Link :href="data.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-secondary-300 text-sm font-medium rounded-md text-secondary-700 bg-white hover:bg-secondary-50"> Next </Link>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-secondary-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium"> {{ data.from }} </span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ data.to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ data.total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination" v-if="data.last_page > 1">
                    <!-- Current: "z-10 bg-primary-50 border-primary-500 text-primary-600", Default: "bg-white border-secondary-300 text-secondary-500 hover:bg-secondary-50" -->
                    <Link v-for="link in data.links" :href="link.url" v-html="link.label" replace preserve-scroll  preserve-state :class="[link.active ? 'z-10 bg-primary-50 border-primary-500 text-primary-600' : 'bg-white border-secondary-300 text-secondary-500 hover:bg-secondary-50', 'relative inline-flex items-center px-4 py-2 border text-sm font-medium']"/>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import { Link } from "@inertiajs/inertia-vue3"
import { computed } from 'vue';

const props = defineProps({
    data: Object
})

const noPreviousPage = computed(() => props.data.current_page - 1 <= 0)

const noNextPage = computed(() => props.data.current_page + 1 > props.data.last_page)

</script>
