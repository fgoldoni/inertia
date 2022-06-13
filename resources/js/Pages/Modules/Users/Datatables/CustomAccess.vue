<script setup>
const props = defineProps({
    row: Object,
});
</script>

<template>
    <span class="text-right float-right">
        {{ props.row.access }}
    </span>
</template>

<style scoped>

</style>
