<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Divisions/Datatables/config'
</script>

<template>

    <Head title="Divisions"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
