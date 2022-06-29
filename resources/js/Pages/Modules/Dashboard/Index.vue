<script setup>
import {onMounted, ref, defineAsyncComponent} from "vue";
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    rowData: Object,
    data: Object,
});

const layout = ref(props.rowData.map((e) => e.layout))

const setDefineAsyncComponent = (path) => defineAsyncComponent(() =>import(`@modules/Dashboard/Components/${path}.vue`))

const draggable = ref(true)
const resizable = ref(true)
const responsive = ref(true)
const colNum = ref(12)
const index = ref(0)

onMounted(() => index.value = layout.value.length);

const layoutUpdatedEvent = (newLayout) => {
    axios.put(route('admin.dashboard.user.update', usePage().props.value.auth.user?.id), { layouts: newLayout})
        .then((res) => {})
        .catch((error) => {})
        .finally(() => {})
}
</script>

<template>
    <Head title="Dashboard"></Head>
    <div>
        <div class="layoutJSON">
            Displayed as <code>[x, y, w, h]</code>:
            <div class="columns">
                <div class="layoutItem" v-for="item in layout" :key="item.i">
                    <b>{{item.i}}</b>: [{{item.x}}, {{item.y}}, {{item.w}}, {{item.h}}]
                </div>
            </div>
        </div>
        <input type="checkbox" v-model="draggable" /> Draggable
        <input type="checkbox" v-model="resizable" /> Resizable
        <grid-layout :layout.sync="layout"
                     :col-num="colNum"
                     :row-height="30"
                     :is-draggable="draggable"
                     :is-resizable="resizable"
                     :responsive="responsive"
                     :vertical-compact="true"
                     :use-css-transforms="true"
                     @layout-updated="layoutUpdatedEvent"
        >
            <grid-item v-for="item in layout"
                       :static="item.static"
                       :x="item.x"
                       :y="item.y"
                       :w="item.w"
                       :h="item.h"
                       :i="item.i"
            >
                <component :is="setDefineAsyncComponent(item.component)" v-bind="{data :props.data}"/>
            </grid-item>
        </grid-layout>
    </div>
</template>

<style>
.layoutJSON {
    background: #ddd;
    border: 1px solid black;
    margin-top: 10px;
    padding: 10px;
}

.columns {
    -moz-columns: 120px;
    -webkit-columns: 120px;
    columns: 120px;
}

/*************************************/

.remove {
    position: absolute;
    right: 2px;
    top: 0;
    cursor: pointer;
}

.vue-grid-item:not(.vue-grid-placeholder) {
    background: #ccc;
}

.vue-grid-item .resizing {
    opacity: 0.9;
}


.vue-grid-item .text {
    font-size: 24px;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    height: 100%;
    width: 100%;
}

.vue-grid-item .no-drag {
    height: 100%;
    width: 100%;
}

.vue-grid-item .minMax {
    font-size: 12px;
}

.vue-grid-item .add {
    cursor: pointer;
}

.vue-draggable-handle {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 0;
    left: 0;
    background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>") no-repeat;
    background-position: bottom right;
    padding: 0 8px 8px 0;
    background-repeat: no-repeat;
    background-origin: content-box;
    box-sizing: border-box;
    cursor: pointer;
}


</style>
