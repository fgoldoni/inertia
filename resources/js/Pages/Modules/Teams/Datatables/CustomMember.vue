<script setup>

const props = defineProps({
    row: Object,
});
</script>

<template>
    <div class="flex -space-x-2 relative z-0 overflow-hidden cursor-pointer">
        <img v-for="member in props.row.members" :key="member.email" class="relative z-30 inline-block h-8 w-8 rounded-full ring-2 ring-white" :src="member.profile_photo_url" :alt="member.name">
    </div>
</template>

<style scoped>

</style>
