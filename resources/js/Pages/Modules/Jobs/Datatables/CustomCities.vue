<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
   <span class="inline-flex rounded-full bg-indigo-100 px-2 text-xs font-semibold leading-5 text-indigo-800">
        {{ row.cities_count  + ' Cities'}}
    </span>
</template>

<style scoped>

</style>
