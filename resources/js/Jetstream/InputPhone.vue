<template>
    <div className="col-span-1 sm:col-span-2">

        <JetLabel for="phone" value="Phone"/>

        <JetInput
            id="phone"
            name="phone"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="text"
            class="mt-1 block w-full"
            placeholder="Phone"
            required/>

        <JetInputError :message="error" class="mt-2"/>
    </div>
</template>

<script setup>
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import internationalNumber from '@/Plugins/internationalNumber'
import 'intl-tel-input/build/css/intlTelInput.css'
import {onMounted} from "vue";

defineProps({
    modelValue: [String, Number],
    error: String,
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

onMounted(() => {
    internationalNumber('#phone').init();
})
</script>
