<script setup>

const props = defineProps({
    row: Object,
});

</script>

<template>
    <div>
        <span class="inline-flex capitalize items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
          <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
            <circle cx="4" cy="4" r="3" />
          </svg>
          {{ props.row.status }}
        </span>
    </div>
</template>

<style scoped>

</style>
