<script setup>
import BaseDisclosure from '@/Components/BaseDisclosure'
import ValidationErrors from '@/Shared/ValidationErrors';

const props = defineProps({
    title: String,
    errors: Object,
    defaultOpen: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <BaseDisclosure :title="title" :default-open="props.defaultOpen">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2" v-if="props.errors.any()">
                <ValidationErrors :errors="props.errors.all()" class="mb-4" />
            </div>

            <div class="mt-5 md:mt-0 col-span-1 sm:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow-md sm:rounded-lg">
                    <slot name="content" />
                </div>
            </div>

        </div>

    </BaseDisclosure>
</template>
