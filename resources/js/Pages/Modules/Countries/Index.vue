<script setup>
import VueDatatable from '@/Shared/VueDatatable.vue';
import config from '@/Pages/Modules/Countries/Datatables/config.js'
</script>

<template>
    <AppLayout title="Countries">
        <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
    </AppLayout>
</template>
