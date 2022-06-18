<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Cities/Datatables/config'
</script>

<template>

    <Head title="Cities"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
