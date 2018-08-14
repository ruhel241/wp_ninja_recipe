<template>
<div>
    <div class="nutritions"><br>
        <div>
            <label class="nutrition_fields_label"><strong>{{ field[0].label }}</strong></label><br>
            <input type="number" :placeholder="field[0].label" v-model="field[0].value" class="nutrition_fields"><br>
        </div>
        <div v-if="field[0].hasOwnProperty('children')" v-for="(ch) in field[0].children" :key="ch.label">
            <label class="nutrition_fields_label"><strong>{{ ch.label }}</strong></label>
            <input type="number" :placeholder="ch.label" v-model="ch.value" class="nutrition_fields"><br>
        </div>
        <div style="padding-right: 14px"> 
            <label class="nutrition_fields_label"><strong>{{ field[1].label }}</strong></label><br>
            <input type="number" :placeholder="field[1].label" v-model="field[1].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label class="nutrition_fields_label"><strong>{{ field[2].label }}</strong></label><br>
            <input type="number" :placeholder="field[2].label" v-model="field[2].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label class="nutrition_fields_label"><strong>{{ field[3].label }}</strong></label><br>
            <input type="number" :placeholder="field[3].label" v-model="field[3].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label class="nutrition_fields_label"><strong>{{ field[4].label }}</strong></label><br>
            <input type="number" :placeholder="field[4].label" v-model="field[4].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label class="nutrition_fields_label"><strong>{{ field[5].label }}</strong></label><br>
            <input type="number" :placeholder="field[5].label" v-model="field[5].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label class="nutrition_fields_label"><strong>{{ field[6].label }}</strong></label><br>
            <input type="number" :placeholder="field[6].label" v-model="field[6].value" class="nutrition_fields"><br>
        </div>
        <div v-if="field[6].hasOwnProperty('children')" v-for="(str) in field[6].children" :key="str.label">
            <label class="nutrition_fields_label"><strong>{{ str.label }}</strong></label>
            <input type="number" :placeholder="str.label" v-model="str.value" class="nutrition_fields"><br>
        </div>
        <div>
            <label v-if="field[7].label!='' " class="nutrition_fields_label"><strong>{{ field[7].label }}</strong></label><br>
            <input v-if="field[7].label!='' " type="number" :placeholder="field[7].label" v-model="field[7].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label v-if="field[8].label!='' " class="nutrition_fields_label"><strong>{{ field[8].label }}</strong></label><br>
            <input v-if="field[8].label != ''" type="number" :placeholder="field[8].label" v-model="field[8].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label v-if="field[9].label != '' " class="nutrition_fields_label"><strong>{{ field[9].label }}</strong></label><br>
            <input v-if="field[9].label != '' " type="number" :placeholder="field[9].label" v-model="field[9].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label v-if="field[10].label != '' " class="nutrition_fields_label"><strong>{{ field[10].label }}</strong></label><br>
            <input v-if="field[10].label != '' " type="number" :placeholder="field[10].label" v-model="field[10].value" class="nutrition_fields"><br>
        </div>
        <div>
            <label v-if="field[11].label != '' " class="nutrition_fields_label"><strong>{{ field[11].label }}</strong></label><br>
            <input v-if="field[11].label != '' " type="number" :placeholder="field[11].label" v-model="field[11].value" class="nutrition_fields"><br>
        </div>
        <div v-if="field[12].label != '' ">
            <label class="nutrition_fields_label"><strong>{{ field[12].label }}</strong></label><br>
            <input type="number" :placeholder="field[12].label" v-model="field[12].value" class="nutrition_fields"><br>
        </div>
        <div v-if="field[13].label != '' " >
            <label class="nutrition_fields_label"><strong>{{ field[13].label }}</strong></label><br>
            <input type="number" :placeholder="field[13].label" v-model="field[13].value" class="nutrition_fields"><br>
        </div>
    </div>
    <hr>
</div>
</template>


<script>

export default {
    name: 'NutritionFields',
    props: [
        'field',
        'childIndex'
    ],
    watch: {
        field: {
            handler(newValue) {
                this.$emit('input', newValue)
            },
            deep: true
        }
    },
    computed: {
        index: {
            get() {
                return this.childIndex;
            },
            set(newValue) {}
        }
    }
}
</script>

<style lang="scss">
.nutritions {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
    margin-top: 20px;
    div {
        width: 23%;
        padding-right: 14px;
        .nutrition_fields_label {
            display: inline-block;
            margin-bottom: 7px;
        }
        .nutrition_fields {
            width: 100%;
            padding: 5px;
            border-radius: 3px; 
        }
    }
}
</style>