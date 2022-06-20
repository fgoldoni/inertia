<template>
    <div class="mt-1">
        <el-date-picker
            v-model="value"
            type="date"
            placeholder="Pick a day"
            format="YYYY/MM/DD"
            value-format="YYYY-MM-DD"
            style="width: 100%"
            size="large"
        />
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { ElDatePicker } from 'element-plus'

const value = ref('2022-10-29')
</script>
