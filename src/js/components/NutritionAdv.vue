<template>
<div>
    <el-row>
        <el-col :span="12">
            <label>{{ field.label }}</label>
            <input type="number" :placeholder="field.label" v-model="field.value">
        </el-col>
    </el-row>
</div>
</template>


<script>
export default {
    name: 'NutritionAdv',
    props: [
        'field'
    ],
    watch: {
        field: {
            handler(newValue) {
                this.$emit('input', newValue)
            },
            deep: true
        }
    }
}
</script>
