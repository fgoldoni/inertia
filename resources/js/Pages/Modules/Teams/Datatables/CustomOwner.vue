<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="flex items-center">
        <div class="h-10 w-10 flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </div>
        <div class="ml-4">
            <div class="font-medium text-gray-900">{{ row.owner?.name }}</div>
            <div class="text-gray-500">{{ row.owner?.email }}</div>
        </div>
    </div>
</template>

<style scoped>

</style>
