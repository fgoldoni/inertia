<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
    <span class="inline-block rounded-full bg-indigo-100 px-2 text-xs font-semibold leading-5 text-indigo-800">
        {{ props.row.country.emoji }} {{ props.row.country.name }}
    </span>
</template>

<style scoped>

</style>
