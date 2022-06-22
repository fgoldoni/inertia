<script setup>
import {ref} from "vue";
import {XIcon} from '@heroicons/vue/outline'

const dragging = ref(false)

const media = ref([]);

const fileUpload = ref(null);

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    modelValue: [File, Object, Array],
    multiple: Boolean,
    error: String
});

const removeFile = (index, item) => {
    media.value.splice(index, 1)
}

const uploadFiles = (files) => {

    files.forEach(file => {

        let reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = async (e) => {

            media.value.unshift({
                file: file,
                url: e.target.result,
                progress: 0,
                error: null,
                uploaded: false,
            });

        }

    });

    emit('update:modelValue', media)
}

const onDroppedFiles = ($event) => {

    dragging.value = false;

    let files = [...$event.dataTransfer.items]
        .filter(item => item.kind === 'file')
        .map(item => item.getAsFile());

    uploadFiles(files);
}

const onSelectedFiles = ($event) => {

    let files = [...$event.target.files];

    uploadFiles(files);

    fileUpload.value = null;
}
</script>

<template>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

        <div class="col-span-1" v-if="!media.length">
            <div
                @drop.prevent="onDroppedFiles"
                @dragover.prevent="dragging = true"
                @dragleave.prevent="dragging = false"
                :class="[dragging ? 'border-indigo-500' :'border-gray-400', 'mt-1 border-2 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center']">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="fileUpload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input @change="onSelectedFiles" id="fileUpload" name="fileUpload" ref="fileUpload" type="file" class="sr-only" :multiple="props.multiple"/>
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </div>

        <div class="col-span-1" v-if="media.length">

            <ul role="list" class="grid grid-cols-1 gap-x-4 gap-y-8" :class="{ 'sm:grid-cols-2 sm:gap-x-6': media.length > 1 }">
                <li v-for="(item, index) in media" :key="index">
                    <div class="relative w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                        <img :src="item.url" alt="" class="object-cover w-full pointer-events-none group-hover:opacity-75" />

                        <button @click="removeFile(index, item)" type="button" class="absolute inset-0 top-0 left-0 h-4 w-4 text-white bg-primary-900 bg-opacity-75 rounded-full hover:bg-opacity-100 cursor-pointer focus:outline-none">
                            <XIcon class="flex-shrink-0 h-4 w-4" />
                        </button>

                        <div v-if="media.loading" class="bg-primary-900 btn-spinner" />
                    </div>
                </li>
            </ul>

        </div>

    </div>

</template>

