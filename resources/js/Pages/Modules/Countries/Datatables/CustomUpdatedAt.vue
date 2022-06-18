<script setup>
import {ExternalLinkIcon} from '@heroicons/vue/outline';
import moment from 'moment'

const props = defineProps({
    row: Object,
});
</script>

<template>
<div>
    {{ moment(row.updated_at, moment.ISO_8601).format('DD MMMM, YYYY') }}
</div>
</template>


