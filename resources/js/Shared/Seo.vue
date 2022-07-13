<script setup>
import {reactive, watch, ref} from "vue"
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetTextarea from '@/Jetstream/Textarea.vue'
import { QuestionMarkCircleIcon } from '@heroicons/vue/solid'
import { TransitionRoot } from '@headlessui/vue'

const props = defineProps({
    open: {
        type: Boolean,
        default: false
    },
    editing: Object,
    modelValue: [Object, Array],
});

const baseUrl = document.querySelector('meta[name="baseUrl"]').content

const emit = defineEmits(['update:modelValue']);

const form = reactive({
    seo_title: props.modelValue.seo_title,
    seo_description: props.modelValue.seo_description,
})

const isOpen = ref(props.open)


watch(form, () => emit('update:modelValue', form));
</script>

<template>

    <div class="px-4 py-5 sm:p-6">

        <div class="flex items-center justify-between">
            <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">{{ __('Search engine listing preview') }}</h3>
            <button v-if="!isOpen" type="button" @click="isOpen = !isOpen" class="text-sm leading-5 bg-transparent outline-none focus:outline-none text-primary-600 hover:text-primary-700 dark:text-primary-500/50">{{ __('Edit SEO preview') }}</button>
        </div>


        <div class="mt-5">
            <p class="text-sm leading-5 text-secondary-500 dark:text-secondary-400" v-if="!isOpen">{{ __('Add a title and description to see how this collection might appear in a search engine listing.') }}</p>

            <div class="flex flex-col" v-else>
                <h3 class="text-base text-primary-800 font-medium leading-6 dark:text-primary-500/50">Clear Lace Glue (38ml)</h3>
                <span class="mt-1 text-green-600 text-sm leading-5 dark:text-green-500/50">{{ baseUrl + '/' + props.editing.slug }}</span>
                <p class="mt-1 text-secondary-500 text-sm leading-5 dark:text-secondary-400">Description Our Super Bonding Glue last much longer, is magical and designed to hold. It's made for people who are active, sweaty and needs a strong application. It provides a secure and strong hold without damaging your natural hairline, as many others do.</p>
            </div>
        </div>
    </div>



    <TransitionRoot
        :show="isOpen"
        as="div"
        enter="transition duration-100 ease-out"
        enter-from="transform scale-95 opacity-0"
        enter-to="transform scale-100 opacity-100"
        leave-active="transition duration-75 ease-out"
        leave-from="transform scale-100 opacity-100"
        leave-to="transform scale-95 opacity-0"
        class="px-4 py-5 sm:px-6 space-y-5">


        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 space-y-4">
            <div class="col-span-1 sm:col-span-2">

                <JetLabel for="seo_title" value="Seo Title"/>

                <JetInput
                    id="seo_title"
                    name="name"
                    v-model="form.seo_title"
                    type="text"
                    class="mt-1 block w-full"/>
            </div>

            <div class="col-span-1 sm:col-span-2">

                <JetLabel for="content" value="Seo Description"/>

                <JetTextarea
                    id="seo_description"
                    name="seo_description"
                    v-model="form.seo_description"
                    type="text"
                    class="mt-1 block w-full"
                />

                <div class="mt-3 flex items-center justify-between">
                    <a href="#" class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900">
                        <QuestionMarkCircleIcon class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                        <span> 160 characters. </span>
                    </a>
                </div>
            </div>
        </div>

    </TransitionRoot>
</template>


