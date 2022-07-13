<script setup>
import VueDatatable from '@/Shared/VueDatatable.vue';
import config from '@/Pages/Modules/Users/Datatables/config.js'

</script>

<template>
    <AppLayout title="Users">
        <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
    </AppLayout>
</template>
