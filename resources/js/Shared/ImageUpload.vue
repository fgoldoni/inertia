<script setup>
import {ref} from "vue";
import {TrashIcon} from '@heroicons/vue/solid'

const dragging = ref(false)

const media = ref([])

const fileUpload = ref(null);

const uploadFiles = (files) => {
    files.forEach(file => {
        media.value.unshift({
            file: file,
            progress: 0,
            error: null,
            uploaded: false,
        });
    });

    media.value.filter(media => !media.uploaded)
        .forEach(media => {
            let form = new FormData;
            form.append('file', media.file);

            axios.post(route('admin.attachments.store'), form, {
                onUploadProgress: (event) => {
                    media.progress = Math.round(event.loaded * 100 / event.total);
                },
            })
                .then(() => media.uploaded = true)
                .catch(error => {
                    media.error = `Upload failed. Please try again later.`;

                    if (error?.response.status === 422) {
                        media.error = error.response.data.errors.file[0];
                    }
                });
        });

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
    <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700"> Image Upload </label>
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
                        <input @input="onSelectedFiles" id="fileUpload"   name="fileUpload"  ref="fileUpload" type="file" class="sr-only" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
            </div>
        </div>
    </div>

    <div class="col-span-1">
        <ul class="my-6 bg-white rounded divide-y divide-gray-200 shadow">
            <li v-for="(item, index) in media" :key="index"
                class="p-3 flex items-center justify-between">
                <div class="text-sm text-gray-700">{{ item.file.name }}</div>

                <div v-if="!item.uploaded && !item.error" class="w-40 bg-gray-200 rounded-full h-3 shadow-inner overflow-hidden relative flex items-center justify-center">
                    <div class="inline-block h-full bg-indigo-600 absolute top-0 left-0" :style="`width: ${item.progress}%`"></div>
                    <div class="relative z-10 text-xs font-semibold text-center text-white drop-shadow text-shadow">{{ item.progress }}%</div>
                </div>

                <div v-if="item.error" class="text-sm text-red-600">{{ item.error }}</div>
                <Link href="#" v-if="item.uploaded" class="text-sm text-indigo-600 underline">
                    <TrashIcon class="flex-shrink-0 h-4 w-4 text-rose-500 group-hover:text-rose-700 mr-1 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-125 duration-300" />
                </Link>
            </li>
        </ul>
    </div>


</template>

