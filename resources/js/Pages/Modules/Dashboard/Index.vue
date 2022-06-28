<script setup>
import {onMounted, ref, defineAsyncComponent} from "vue";


const props = defineProps({
    rowData: Object,
});


const layout = ref(props.rowData.map((e) => e.layout))

const setDefineAsyncComponent = (path) => defineAsyncComponent(() =>import(`@modules/Dashboard/Components/${path}.vue`))



const draggable = ref(true)
const resizable = ref(true)
const colNum = ref(12)
const index = ref(0)

onMounted(() => index.value = layout.value.length);

const movedEvent = (i, newX, newY) => {
    axios.put(route('admin.dashboard.update', i), {x: newX, y: newY})
        .then((res) => {})
        .catch((error) => {})
        .finally(() => {})
}

const removeItem = (val) => {
    const index = layout.value.map(item => item.i).indexOf(val);
    layout.value.splice(index, 1);
}
</script>

<template>
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
                     :vertical-compact="true"
                     :use-css-transforms="true"
        >
            <grid-item v-for="item in layout"
                       :static="item.static"
                       :x="item.x"
                       :y="item.y"
                       :w="item.w"
                       :h="item.h"
                       :i="item.i"
                       @moved="movedEvent"
            >
                <component :is="setDefineAsyncComponent(item.component)"/>
                <span class="remove" @click="removeItem(item.i)">x</span>
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

.vue-grid-layout {
    background: #eee;
}

.vue-grid-item:not(.vue-grid-placeholder) {
    background: #ccc;
    border: 1px solid black;
}

.vue-grid-item .resizing {
    opacity: 0.9;
}

.vue-grid-item .static {
    background: #cce;
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
