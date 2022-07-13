<script setup>
import {ref, computed} from "vue"
import { useUsers } from '@/Composables/UseUsers.js'

const props = defineProps({
    items: {
        default: ref([]),
    },
});

const { doGroupData } = useUsers()

const filteredItems = computed(() => doGroupData(props.items))
</script>

<template>

    <div class="relative overflow-auto">

        <nav class="h-72 overflow-y-auto" aria-label="Directory">

            <div v-for="letter in Object.keys(filteredItems)" :key="letter" class="relative">

                <div class="z-10 sticky top-0 border-t border-b border-gray-200 bg-gray-50 px-6 py-1 text-sm font-medium text-gray-500 uppercase">

                    <h3>{{ letter }}</h3>

                </div>

                <ul role="list" class="relative z-0 divide-y divide-gray-200">

                    <li v-for="item in filteredItems[letter]" :key="item.id" class="bg-white">

                        <div class="relative px-6 py-5 flex items-center space-x-3 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">

                            <div class="flex-shrink-0">

                                <img class="h-10 w-10 rounded-full" :src="item.profile_photo_url" alt="" />

                            </div>

                            <div class="flex-1 min-w-0">

                                <a href="javascript:;" class="focus:outline-none">

                                    <span class="absolute inset-0" aria-hidden="true" />

                                    <p class="text-sm font-medium text-gray-900">

                                        {{ item.name }}

                                    </p>

                                    <p class="text-sm text-gray-500 truncate">

                                        {{ item.email }}

                                    </p>

                                </a>

                            </div>

                        </div>

                    </li>

                </ul>

            </div>

        </nav>

    </div>
</template>
