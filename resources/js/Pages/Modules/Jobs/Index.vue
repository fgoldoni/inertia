<script setup>
import VueDatatable from '@/Shared/VueDatatable.vue';
import config from '@/Pages/Modules/Jobs/Datatables/config.js'
</script>

<template>
    <AppLayout title="Jobs">
        <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
    </AppLayout>
</template>
