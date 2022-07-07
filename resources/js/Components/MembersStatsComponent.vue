<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
        <div class="col-span-1">
            <div class="mt-8 overflow-hidden">
                <dl class="-mx-8 -mt-8 flex flex-wrap">
                    <div class="flex flex-col px-8 pt-8">
                        <dt class="order-2 text-base font-medium text-gray-500">{{ __('Team Members') }}</dt>
                        <dd class="order-1 text-2xl font-extrabold text-primary-600 sm:text-3xl">{{ props.modelValue?.members.length }}</dd>
                    </div>
                    <div class="flex flex-col px-8 pt-8">
                        <dt class="order-2 text-base font-medium text-gray-500">{{ __('Pending Team Invitations') }}</dt>
                        <dd class="order-1 flex items-baseline text-2xl font-extrabold text-primary-600 sm:text-3xl">
                            {{ props.modelValue?.teamInvitations.length }}
                            <ArrowSmUpIcon  class="self-center flex-shrink-0 h-6 w-6 sm:h-8 sm:w-8 text-green-500" aria-hidden="true" />
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ArrowSmUpIcon } from '@heroicons/vue/solid'

const props = defineProps({
    modelValue: [Object, Array],
});
</script>

<style scoped>

</style>
