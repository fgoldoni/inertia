<script setup>
import {ExternalLinkIcon} from '@heroicons/vue/outline';
import moment from 'moment'

const props = defineProps({
    row: Object,
});
</script>

<template>
<div>
    <div class="text-gray-900">Registered on {{ moment(row.created_at, moment.ISO_8601).format('DD MMMM, YYYY') }}</div>
    <div class="text-gray-500">Last Modified: {{ moment(row.updated_at, moment.ISO_8601).fromNow() }}</div>
</div>
</template>


