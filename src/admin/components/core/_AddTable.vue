<template>
    <el-dialog
        title="Add New Recipe Table"
        :visible.sync="addTableModal"
        width="60%">
            <div class="table_form_fields">

                <div class="recipe_table_name">
                    <label for="new_table_name">Table Name</label>
                    <el-input id="new_table_name" type="text" placeholder="Your Table Name" v-model="table_name"></el-input>
                </div>

                <div class="recipe_categories">
                    <el-row>
                        <el-col :span="12">
                            <app-input-dropdown 
                                pcHolder="Select Recipe Type"
                                v-model="selectedRecipe"
                                :recipeTypes="recipe_types"
                                label="Recipe Type"></app-input-dropdown>
                        </el-col>
                    </el-row>
                </div>
                
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="addTableModal=false">Cancel</el-button>
                <el-button type="primary" @click="addNewTable" v-loading="addingTableAjax">Add New</el-button>
            </span>
    </el-dialog>
</template>

<script>
import InputDropdown from './InputDropdown.vue'

export default {
    name: 'AddTable',
    components: {
        'app-input-dropdown': InputDropdown
    },
    data() {
        return {
            table_name: '',
            selectedRecipe: ''
        }
    },
    props: {
        addTableModal: {
            default: false
        },
        recipe_types: {
            default: []
        },
        addingTableAjax: {
            default: false
        }
    },
    methods: {
        addNewTable() {
            var newData = {
                tableName: this.table_name,
                selectedRecipe: this.selectedRecipe
            }
            this.$emit('addNewTable', newData)
        }
    }
}
</script>

<style>

</style>
