<script setup>
import VueDatatable from '@/Shared/VueDatatable.vue';
import config from '@/Pages/Modules/Divisions/Datatables/config.js'
</script>

<template>
    <AppLayout title="Divisions">
        <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
    </AppLayout>
</template>
