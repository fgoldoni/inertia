<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Companies/Datatables/config'
</script>

<template>

    <Head title="Companies"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
