<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
   <span>
        {{ row.user?.name }}
    </span>
</template>

<style scoped>

</style>
