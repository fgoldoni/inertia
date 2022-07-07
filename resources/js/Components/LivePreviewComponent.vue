<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

        <div class="relative col-span-1">
            <a :href="preview + '/cache/clear'" target="_blank" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">Live Preview</a>
            <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
        </div>



    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
    modelValue: [Object, Array],
});

const frontendDomain = document.querySelector('meta[name="frontendDomain"]').content

const frontendHttp = document.querySelector('meta[name="frontendHttp"]').content

const preview = computed(() => frontendHttp + props.modelValue.subdomain + frontendDomain)
</script>

<style scoped>

</style>
