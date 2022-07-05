<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div>
         <span v-if="!props.row.deleted_at" :class="'inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-' + colors[props.row.state] + '-100 text-' + colors[props.row.state] + '-800'">
            <svg :class="'-ml-0.5 mr-1.5 h-2 w-2 text-' + colors[props.row.state] + '-400'" fill="currentColor" viewBox="0 0 8 8">
              <circle cx="4" cy="4" r="3" />
            </svg>
            {{ props.row.state }}
      </span>

      <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-negative-100 text-negative-800">
            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-negative-400" fill="currentColor" viewBox="0 0 8 8">
              <circle cx="4" cy="4" r="3" />
            </svg>
            Deleted
      </span>

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
