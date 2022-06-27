<script setup>
const props = defineProps({
    value: String,
    required: {
        type: Boolean,
        default: false,
    },
    optional: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div class="flex items-center justify-between">

        <label class="block font-medium text-sm text-gray-700">

            <span v-if="value">{{ value }} <span class="text-rose-500" v-if="required">*</span></span>

            <span v-else><slot /></span>

        </label>

        <span  v-if="optional" class="text-secondary-500 text-sm leading-5 dark:text-secondary-400">{{ __('Optional') }}</span>

    </div>

</template>
