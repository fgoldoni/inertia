<script setup>

const props = defineProps({
    row: Object,
});


</script>

<template>
    <div>
        <div class="text-gray-900">{{ props.row.candidate?.name }}</div>
        <div class="text-gray-500">{{ props.row.candidate?.email }}</div>
    </div>
</template>

<style scoped>

</style>
