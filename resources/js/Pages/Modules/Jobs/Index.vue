<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Jobs/Datatables/config'
</script>

<template>

    <Head title="Jobs"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
