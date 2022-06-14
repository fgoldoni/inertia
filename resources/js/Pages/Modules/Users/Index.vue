<script setup>
import VueDatatable from '@/Shared/VueDatatable';
import config from '@/Pages/Modules/Users/Datatables/config'
</script>

<template>

    <Head title="Users"></Head>

    <VueDatatable :config="config" v-bind="$page.props"></VueDatatable>
</template>
