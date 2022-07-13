<script setup>
import BaseDisclosure from '@/Components/BaseDisclosure.vue'
import ValidationErrors from '@/Shared/ValidationErrors.vue';

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

                <div class="col-span-1 sm:col-span-2">
                    <slot name="content" />
                </div>

        </div>



    </BaseDisclosure>
</template>
