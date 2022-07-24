<template>
    <el-tag
        v-for="tag in dynamicTags"
        :key="tag"
        class="mx-1 uppercase"
        closable
        :disable-transitions="false"
        @close="handleClose(tag)"
    >
        {{ tag }}
    </el-tag>
    <el-input
        v-if="inputVisible"
        ref="InputRef"
        v-model="inputValue"
        class="ml-1 w-20"
        type="text"
        size="small"
        @keyup.enter="handleInputConfirm"
        @blur="handleInputConfirm"
    />
    <el-button v-else class="button-new-tag ml-1" size="small" @click="showInput">
        + New Tag
    </el-button>
</template>

<script setup>
import { nextTick, ref, computed } from 'vue'
import { ElInput, ElTag, ElButton } from 'element-plus'


const props = defineProps({
    modelValue: {
        type: [Array],
        default: [],
    },
    error: String
});

const emit = defineEmits(["update:modelValue"]);

const dynamicTags = computed(() => {
    if (Object.entries(props.modelValue).length !== 0) {
        return  JSON.parse(JSON.stringify(props.modelValue))
    }

    return [];
});

const inputValue = ref('')
const inputVisible = ref(false)
const InputRef = ref(null)

const handleClose = (tag) => {
    dynamicTags.value.splice(dynamicTags.value.indexOf(tag), 1)
}

const showInput = () => {
    inputVisible.value = true
    nextTick(() => {
        InputRef.value.focus()
    })
}

const handleInputConfirm = () => {
    if (inputValue.value) {
        dynamicTags.value.push(inputValue.value)
        emit('update:modelValue', dynamicTags.value)
    }
    inputVisible.value = false
    inputValue.value = ''
}
</script>
