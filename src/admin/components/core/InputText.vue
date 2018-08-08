<template>
    <div>
        <label v-if="label">{{ label }}</label>
        <input type="text" :placeholder="pcHolder" v-model="model" class="ing_text_field">
    </div>
</template>

<script>
export default {
    name: 'InputText',
    props: {
        value: {
            default: ''
        },
        pcHolder: '',
        label: {
            default: ''
        }
    },
    computed: {
        model: {
            get() {
                return this.value
            },
            set(newValue) {
                this.$emit('input', newValue)
            }
        }
    }
}
</script>

<style scoped>
.ing_text_field {
    width: 99%;
    padding: 12px;
    border-radius: 4px;
}
</style>
