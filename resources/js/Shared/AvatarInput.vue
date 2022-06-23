<script setup>
import {CameraIcon, XIcon} from '@heroicons/vue/outline'
import {ref, watch, onMounted} from "vue";
import {useAvatar} from '@/Composables/UseAvatar'

const emit = defineEmits(["update:modelValue"]);
const fileRef = ref(null);

const props = defineProps({
    modelValue: [String, File],
    defaultSrc: String
});

onMounted(() => {
    useAvatar.value.doLoadFile(props.modelValue, props.defaultSrc);
})


const browse = () =>  fileRef.value.click();

const remove = () => emit('update:modelValue', null);

watch(() => props.modelValue, (file) => {
    if (!file) {
        form.src = props.defaultSrc;

        if (fileRef.value?.value) {
            fileRef.value.value = null;
        }

    } else {
        useAvatar.value.doSubmitFile(props.modelValue);
    }
}, {deep: true});
</script>

<template>
    <div class="relative flex items-center">
        <input
            type="file"
            accept="image/*"
            class="hidden"
            ref="fileRef"
            @change="e => emit('update:modelValue', e.target.files[0])"
        />
        <img v-if="useAvatar.media" :src="useAvatar.media.avatar_url" alt="Admin SG" class="h-20 w-20 rounded-full ring-4 ring-white object-cover">
        <div class="absolute top-0 h-20 w-20 rounded-full ring-4 ring-primary-100 bg-black bg-opacity-25 flex items-center justify-center">
            <button
                type="button"
                @click="browse()"
                class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200"
            >
                <CameraIcon class="flex-shrink-0 h-4 w-4" />
            </button>

            <button
                type="button"
                v-if="useAvatar.media?.avatar_path"
                @click="useAvatar.doRemoveFile(props.defaultSrc)"
                class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200"
            >
                <XIcon class="flex-shrink-0 h-4 w-4" />
            </button>

        </div>
    </div>

    <div class="col-span-1 mt-2" v-if="useAvatar.error">
        <div v-if="useAvatar.error" class="text-xs text-rose-500">{{ useAvatar.error }}</div>
    </div>
</template>


