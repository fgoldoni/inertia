<script setup>
import FormSection from '@/Shared/FormSection.vue';
import {reactive} from "vue";
import {Errors} from "@/Plugins/errors.js";
import {ElNotification} from "element-plus";
import JetLabel from '@/Jetstream/Label.vue'
import ImageUpload from '@/Shared/ImageUpload.vue'
import AvatarInput from '@/Shared/AvatarInput.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import JetButton from '@/Jetstream/Button.vue';
import pickBy from "lodash/pickBy";
import {useAvatar} from "@/Composables/UseAvatar.js";
import {useMedia} from "@/Composables/UseMedia.js";

const props = defineProps({
    modelValue: [Object, Array],
});

const form = reactive({
    id: props.modelValue.id,
    defaultSrc: 'https://ui-avatars.com/api/?name=' + encodeURIComponent(props.modelValue.name) + '&color=7F9CF5&background=EBF4FF',
    avatar: props.modelValue.avatar_path,
    files: props.modelValue?.attachments,

    errors: new Errors(),
    processing: false,
})

const updateTeamOwner = () => {
    axios.put(route('admin.teams.assets.update', form.id), pickBy({
        avatar_path: useAvatar.value.media?.avatar_path,
        files: useMedia.value.doMediaFetchIds(),
    })).then((response) => {

        form.processing = false;

        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })

    }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });
};
</script>

<template>
    <FormSection :title="__('Assets')" :errors="form.errors" @submitted="updateTeamOwner">

        <template #form>
            <div class="col-span-1 sm:col-span-2">

                <JetLabel :value="__('Logo')" class="mb-2"/>

                <AvatarInput v-model="form.avatar" :default-src="form.defaultSrc" model='App\Models\Team'></AvatarInput>

            </div>

            <div class="col-span-1 sm:col-span-2">

                <JetLabel :value="__('Featured Image')" class="mb-2"/>

                <ImageUpload v-model="form.files"></ImageUpload>

                <JetInputError :message="form.errors.get('files')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </FormSection>
</template>

