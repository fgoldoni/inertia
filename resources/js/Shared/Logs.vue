<template>
    <div class="grid grid-cols-1 w-full overflow-auto h-80">
        <el-table :data="props.options" stripe size="large">
            <el-table-column type="expand">
                <template #default="props">
                    <div class="px-8">
                        <p v-for="(value, key) in props.row.properties"><span class="capitalize">{{ __(key) }}</span> : <span v-html="value"></span></p>
                    </div>
                </template>
            </el-table-column>
            <el-table-column :label="__('Date')" prop="created_at" sortable>
            </el-table-column>
            <el-table-column :label="__('User')" prop="causer">
            </el-table-column>
            <el-table-column :label="__('Action')" prop="description">
            </el-table-column>
        </el-table>
    </div>

</template>

<script setup>
import { ElTable, ElTableColumn } from 'element-plus'

const props = defineProps({
    options: [Object, Array],
});

const tableData = [
    {
        date: '2016-05-03',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
    {
        date: '2016-05-02',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
    {
        date: '2016-05-04',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
    {
        date: '2016-05-01',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
    {
        date: '2016-05-08',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
    {
        date: '2016-05-06',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
    {
        date: '2016-05-07',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036',
    },
]
</script>
