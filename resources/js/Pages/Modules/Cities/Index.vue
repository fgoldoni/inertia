<script setup>
import VueDatatable from '@/Shared/VueDatatable.vue';
import config from '@/Pages/Modules/Cities/Datatables/config.js'
</script>

<template>
    <AppLayout title="Cities">
        <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
    </AppLayout>
</template>
