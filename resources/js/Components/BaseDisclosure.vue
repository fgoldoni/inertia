<script setup>
import { Disclosure,  DisclosureButton,  DisclosurePanel} from '@headlessui/vue'
import { MinusSmIcon, PlusSmIcon } from '@heroicons/vue/solid'


const props = defineProps({
    title: String,
    defaultOpen: {
        type: Boolean,
        default: false,
    },
});

</script>

<template>
    <Disclosure as="div" :defaultOpen="props.defaultOpen" key="salary-disclosure" class="border-t border-gray-200 p-6 bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2" v-slot="{ open }">
        <h3 class="-my-3 flow-root">
            <DisclosureButton class="rounded-lg bg-secondary-100 px-4 py-3 w-full flex items-center justify-between text-sm text-secondary-500 hover:text-secondary-600">
                <span class="font-medium text-gray-900">
                    {{ props.title }}
                </span>
                <span class="ml-6 flex items-center">
                      <PlusSmIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                      <MinusSmIcon v-else class="h-5 w-5" aria-hidden="true" />
                 </span>
            </DisclosureButton>
        </h3>
        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-out"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >

            <DisclosurePanel class="pt-6">

                <slot></slot>

            </DisclosurePanel>

        </transition>

    </Disclosure>
</template>
