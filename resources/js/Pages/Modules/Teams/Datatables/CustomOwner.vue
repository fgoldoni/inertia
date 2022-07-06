<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div>
        <div class="text-gray-900">{{ props.row.owner }}</div>
        <div class="text-gray-500" v-if="props.row.ownsTeam">Membership: <span class="underline text-gray-700">{{ __('Owner') }}</span></div>
        <div class="text-gray-500" v-else-if="props.row.belongsToTeam">Membership: <span class="underline text-gray-700">{{ __('Member') }}</span></div>
    </div>

</template>


<script setup>
const props = defineProps({
    row: Object,
});


const colors = {
    hold: 'yellow',
    archived: 'slate',
    published: 'green',
    draft: 'rose',
};

</script>

<style scoped>

</style>
