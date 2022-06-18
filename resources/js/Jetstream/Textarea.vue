<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    name: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: '',
    },
});

defineEmits(['update:modelValue']);

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute('autofocus')) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });
</script>

<template>
    <textarea rows="4"
              ref="textarea"
              :name="name"
              :placeholder="placeholder"
              :value="modelValue"
              @input="$emit('update:modelValue', $event.target.value)"
              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
</template>
