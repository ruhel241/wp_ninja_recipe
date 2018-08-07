<template>
<div>
    <div class="nutritions"><br>
        <div>
            <label>{{ field[0].label }} <span><el-switch v-model="field[0].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[0].label" v-model="field[0].value"  :disabled="field[0].disabled"><br>
        </div>
        <div>
            <label>{{ field[1].label }} <span><el-switch v-model="field[1].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[1].label" v-model="field[1].value"  :disabled="field[1].disabled"><br>
        </div>
        <div>
            <label>{{ field[2].label }} <span><el-switch v-model="field[2].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[2].label" v-model="field[2].value"  :disabled="field[2].disabled"><br>
        </div>
        <div>
            <label>{{ field[3].label }} <span><el-switch v-model="field[3].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[3].label" v-model="field[3].value"  :disabled="field[3].disabled"><br>
        </div>
        <div>
            <label>{{ field[4].label }} <span><el-switch v-model="field[4].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[4].label" v-model="field[4].value"  :disabled="field[4].disabled"><br>
        </div>
        <div>
            <label>{{ field[5].label }} <span><el-switch v-model="field[5].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[5].label" v-model="field[5].value"  :disabled="field[5].disabled"><br>
        </div>
        <div>
            <label>{{ field[6].label }} <span><el-switch v-model="field[6].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input type="number" :placeholder="field[6].label" v-model="field[6].value"  :disabled="field[6].disabled"><br>
        </div>
        <div>
            <label v-if="field[7].label!='' ">{{ field[7].label }} <span><el-switch v-model="field[7].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input v-if="field[7].label!='' " type="number" :placeholder="field[7].label" v-model="field[7].value" :disabled="field[7].disabled"><br>
        </div>
        <div>
            <label v-if="field[8].label!='' ">{{ field[8].label }} <span><el-switch v-model="field[8].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input v-if="field[8].label != ''" type="number" :placeholder="field[8].label" v-model="field[8].value" :disabled="field[8].disabled"><br>
        </div>
        <div>
            <label v-if="field[9].label != '' ">{{ field[9].label }} <span><el-switch v-model="field[9].disabled" inactive-color="green" active-color="#9098B8"></el-switch></span></label><br>
            <input v-if="field[9].label != '' " type="number" :placeholder="field[9].label" v-model="field[9].value" :disabled="field[9].disabled"><br>
        </div>
    </div>
    <hr>
</div>
</template>


<script>

export default {
    name: 'NutritionFields',
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

<style lang="scss">
.nutritions {
    display: flex;
    flex-wrap: wrap;
    div {
        width: 24%;
        padding-right: 10px;
        input {
            width: 100%;
        }
    }
}
</style>