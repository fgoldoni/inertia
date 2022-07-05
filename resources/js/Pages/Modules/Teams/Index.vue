<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Teams/Datatables/config'
</script>

<template>

    <Head title="Teams"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
