<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
<div>
    <div class="text-gray-900">{{ row.created_at }}</div>
</div>
</template>


