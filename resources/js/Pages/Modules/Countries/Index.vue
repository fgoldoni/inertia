<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Countries/Datatables/config'
</script>

<template>

    <Head title="Countries"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
