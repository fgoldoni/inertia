<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Categories/Datatables/config'
</script>

<template>

    <Head title="Categories"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
