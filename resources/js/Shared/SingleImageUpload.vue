<script setup>
import {XIcon} from '@heroicons/vue/outline'
import {useMedia} from '@/Composables/UseMedia'
import {ref} from "vue";

const fileUpload = ref(null);

const props = defineProps({
    multiple: Boolean
});

</script>

<template>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

        <div class="col-span-1" v-if="!useMedia.media.length">
            <div
                @drop.prevent="useMedia.doDroppedFiles"
                @dragover.prevent="useMedia.dragging = true"
                @dragleave.prevent="useMedia.dragging = false"
                :class="[useMedia.dragging ? 'border-indigo-500' :'border-gray-400', 'mt-1 border-2 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center']">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="fileUpload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input @input="fileUpload = null" @change="useMedia.doSelectedFiles" id="fileUpload" name="fileUpload" ref="fileUpload" type="file" class="sr-only" :multiple="props.multiple"/>
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </div>

        <div class="col-span-1" v-if="useMedia.media.length">

            <ul role="list" class="grid grid-cols-1 gap-x-4 gap-y-8" :class="{ 'sm:grid-cols-2 sm:gap-x-6': useMedia.media.length > 1 }">
                <li v-for="(item, index) in useMedia.media" :key="index">
                    <div class="relative w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                        <img :src="item.url" alt="" class="object-cover w-full pointer-events-none group-hover:opacity-75" />

                        <button @click="useMedia.doRemoveFile(index, item)" type="button" class="absolute inset-0 top-0 left-0 h-4 w-4 text-white bg-primary-900 bg-opacity-75 rounded-full hover:bg-opacity-100 cursor-pointer focus:outline-none">
                            <XIcon class="flex-shrink-0 h-4 w-4" />
                        </button>

                        <div v-if="useMedia.media.loading" class="bg-primary-900 btn-spinner" />
                    </div>
                </li>
            </ul>

        </div>

    </div>

</template>

