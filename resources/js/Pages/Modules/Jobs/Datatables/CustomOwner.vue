<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div>
        <div class="text-gray-900">{{ row.company?.name }}</div>
        <div><span class="text-gray-900">Created By: </span> {{ row.user?.name }}</div>
    </div>
</template>

<style scoped>

</style>
