<template>
    <div class="wp-ninja-recipe">

        <div class="editor-header">
            <div class="section-header">
                <h1>All Recipe Tables</h1>
            </div>
            <div class="section-action">
                <el-button size="mini" type="primary" @click="addTableModal=true">Add Table</el-button>
            </div>
        </div>

        <hr>



        <!-- Dialog -->
        <el-dialog
            title="Add New Mortgage Table"
            :visible.sync="addTableModal"
            width="60%">
                <label for="new_table_name">Table Name</label>
                <el-input id="new_table_name" type="text" placeholder="Your Table Name" v-model="table_name"></el-input>
                <el-select v-model="selectedRecipe" placeholder="Select Recipe Type" style="margin-top: 10px">
                    <el-option v-for="(type, i) in recipe_types"
							:key="i"
							:label="type.label"
							:value="type.value" >
                    </el-option>
                </el-select>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="addTableModal=false">Cancel</el-button>
                    <el-button type="primary" @click="addNewTable">Add New</el-button>
                </span>
        </el-dialog>

    </div>
</template>

<script>
export default {
    name: 'AllTables',
    data() {
        return {
            table_name: '',
            recipe_types: [
                { value: 'normal', label: 'Normal' },
                { value: 'advance', label: 'Advance' }
            ],
            addTableModal: false,
            selectedRecipe: ''
        }
    },
    methods: {
        addNewTable() {
            jQuery.post(ajaxurl, {
                action: 'ninja_recipe_ajax_actions',
                route: 'add_table',
                post_title: this.table_name,
                recipe_type: this.selectedRecipe
            })
            .then(
                (response) => {
                    console.log(response)
                    this.$notify.success({
                        title: 'Success',
                        message: response.data.message
                    });
                }
            )
            .fail(
                (error) => {
                    this.$notify.error({
                        title: 'Error',
                        message: error.responseJSON.data.message
                    });
                }
            )
            .always(
                () => {
                    this.addTableModal = false;
                }
            )
        }
    }
}
</script>

<style>
    .section-action {
        float: right;
        margin-top: -32px;
    }

    .el-select .el-input__inner {
        background: #fff;
    }
</style>
