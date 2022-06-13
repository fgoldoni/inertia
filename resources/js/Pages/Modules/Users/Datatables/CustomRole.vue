<script setup>
const props = defineProps({
    row: Object,
});
</script>

<template>
     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-100 text-secondary-800 dark:bg-secondary-700 dark:text-secondary-400">

        {{ props.row.role }}

    </span>
</template>

<style scoped>

</style>
