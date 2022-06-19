<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="text-gray-900">{{ props.row.email }}</div>
    <div class="text-gray-500">{{ props.row.phone }}</div>
</template>

<style scoped>

</style>
