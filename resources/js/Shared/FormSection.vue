<script setup>
import { computed, useSlots } from 'vue';
import BaseDisclosure from '@/Components/BaseDisclosure'
import ValidationErrors from '@/Shared/ValidationErrors';

const props = defineProps({
    title: String,
    errors: Object,
});

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <BaseDisclosure :title="title" default-open>
        <form @submit.prevent="$emit('submitted')" @keydown="props.errors.clear($event.target.name)">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                <div class="col-span-1 sm:col-span-2" v-if="props.errors.any()">
                    <ValidationErrors :errors="props.errors.all()" class="mb-4" />
                </div>

                <slot name="form" />

            </div>

            <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="col-span-1 sm:col-span-2">
                    <div v-if="hasActions" class="flex items-center justify-end px-4 py-3 bg-secondary-100 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <slot name="actions" />
                    </div>
                </div>
            </div>
        </form>

    </BaseDisclosure>
</template>
