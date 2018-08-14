<template>
    <div class="wp-ninja-recipe">

        <!-- Header -->
        <div class="editor-header">
            <div class="section-header">
                <h1>All Recipe Tables</h1>
            </div>
            <div class="section-action">

                <label class="form_group">
                    <input type="text" class="form_control search_action" placeholder="Search" v-model="search">
                    <i class="el-icon-search"></i>
                </label>
                <el-button size="mini" type="success" @click="showFilterSection = !showFilterSection">Filter</el-button>
                <el-button size="mini" type="primary" @click="addTableModal=true" class="addTable">Add Table</el-button>
                 
            </div>
        </div>

        <hr>

        <div class="filtered_area" v-if="showFilterSection">

            <el-row>
                <el-col :span="4" style="margin-right: 10px;">
                    <app-input-dropdown 
                        label="Meal Type"
                        pcHolder="Select Meal Type"
                        v-model="findMealType"
                        :recipeTypes="meal_types"
                        :clearable=true>
                    </app-input-dropdown>
                </el-col>
                <el-col :span="4" style="margin-right: 10px;">
                    <app-input-dropdown 
                        label="Cusine Type"
                        pcHolder="Select Cusine Type"
                        v-model="findCusineType"
                        :recipeTypes="cusine_types"
                        :clearable=true>
                    </app-input-dropdown>
                </el-col>
                <el-col :span="4">
                    <app-input-dropdown 
                        label="Preference Type"
                        pcHolder="Select Preference Type"
                        v-model="findPreferenceType"
                        :recipeTypes="preference_types"
                        :clearable=true>
                    </app-input-dropdown>
                </el-col>
                <el-col class="closeFilter">
                    <span @click="showFilterSection=false">X</span>
                </el-col>
            </el-row>

        </div>

        <!-- Table -->
        <app-table
            :tableData="tableData"
            :tableLoading="tableLoading"
            @removeTable="deleteTable($event)"></app-table>

        <!-- Pagination -->
        <div class="pull-right">
            <app-pagination
                :paginate="paginate"
                @paginateData="paginateFunc($event)"></app-pagination>
        </div>

        <!-- Dialog for Adding Table -->
        <app-add-table
            :addTableModal="addTableModal"
            :recipe_types="recipe_types"
            :addingTableAjax="addingTableAjax"
            @addNewTable="addNewTable($event)"></app-add-table>

    </div>
</template>

<script>
import Clipboard from 'clipboard'
import InputDropdown from '../core/InputDropdown.vue'
import Pagination from '../core/Pagination.vue'
import ListAllTable from '../core/_ListAllTable.vue'
import AddTable from '../core/_AddTable.vue'

export default {
    name: 'AllTables',
    components: {
        'app-input-dropdown': InputDropdown,
        'app-pagination': Pagination,
        'app-table': ListAllTable,
        'app-add-table': AddTable
    },
    data() {
        return {
            search: '',
            per_page: 10,
            tableData: [],
            page_number: 1,
            tableLoading: false,
            showFilterSection: false,
            recipe_types: [
                { value: 'normal', label: 'Normal' },
                { value: 'advance', label: 'Advance' }
            ],
            addTableModal: false,
            addingTableAjax: false,
            mealType: '',
            cusineType: '',
            preferenceType: '',
            findMealType: '',
            findCusineType: '',
            findPreferenceType: '',
            meal_types: [
                { value: 'Breakfast', label: 'Breakfast' },
                { value: 'Lunch', label: 'Lunch' }, 
                { value: 'Dinner', label: 'Dinner' }
            ],
            cusine_types: [
                { value: 'Indian', label: 'Indian' },
                { value: 'Chinese', label: 'Chinese' }, 
                { value: 'Thai', label: 'Thai' }
            ],
            preference_types: [
                { value: 'Vegetable', label: 'Vegetable' },
                { value: 'Non-vegetable', label: 'Non-vegetable' }
            ],
            searchAction: 0,
            paginate: {
                total: 0, 
                current_page: 1,
                last_page: 1,
                per_page: 10
            }
        }
    },
    created() {
        this.fetchTables(); // fetching the table data when application loads
        this.clipboardRender();
    },
    methods: {
        fetchTables() {
            this.tableLoading = true

            let fetchTablesAjaxData = {
                action: 'ninja_recipe_ajax_actions',
                route: 'get_tables',
                per_page: this.paginate.per_page,
                page_number: this.paginate.current_page,
                search: this.search,
                meal_type: this.findMealType,
                cusine_type: this.findCusineType,
                preference_type: this.findPreferenceType
            };

            jQuery.get(ajaxurl, fetchTablesAjaxData)
                .then(
                    (response) => {
                        console.log(response)
                        this.tableData = response.data.tables;
                        this.paginate.total = response.data.total;
                    }
                )
                .fail(
                    (error) => {
                        this.$notify.error({
                            title: 'Error',
                            message: 'This is an error message'
                        });
                    }
                )
                .always(
                    () => {
                        this.tableLoading = false
                    }
                )
        },
        addNewTable(val) {
            this.addingTableAjax = true

            let addTableAjaxData = {
                action: 'ninja_recipe_ajax_actions',
                route: 'add_table',
                post_title: val.tableName,
                recipe_type: val.selectedRecipe 
            }

            jQuery.post(ajaxurl, addTableAjaxData)
            .then(
                (response) => {
                    console.log(response)
                    this.$notify.success({
                        title: 'Success',
                        message: response.data.message
                    });
                    this.$router.push({
                        name: 'edit_table',
                        params: {
                            table_id: response.data.table_id
                        }
                    })
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
                    this.addingTableAjax = false;
                }
            )
        },
        deleteTable(tableId) {
            let deleteAjaxData = {
                action: 'ninja_recipe_ajax_actions',
                route: 'delete_table',
                table_id: tableId
            }

            jQuery.post(ajaxurl, deleteAjaxData)
            .then(
                (response) => {
                    this.$notify.success({
                        title: 'Deleted',
                        message: response.data.message
                    })
                    this.total = this.total - 1;
                    if(this.total == this.per_page) {
                        this.page_number = 1;
                    } 
                    else  if( (this.total % 2 != 0) && (this.total % this.per_page) == 0 ) {
                        var res = parseInt(this.total / 2);
                        if( this.total - ((res * 2) + 1) == 0 && this.total != this.per_page) {
                            this.page_number = this.page_number - 1;
                        }    
                    }
                    else if(this.total % 2 == 0 && (this.total % this.per_page) == 0) {
                        var res = parseInt(this.total / 2);
                        if( this.total - ((res * 2)) == 0 && this.total != this.per_page ) {
                            this.page_number = this.page_number - 1;
                        } 
                    }                 
                    this.fetchTables();
                }
            )
        },
        clipboardRender() {
            var clipboard = new Clipboard('.copy');
            clipboard.on('success', (e) => {
                this.$message({
                    message: 'Copied to Clipboard!',
                    type: 'success'
                });
            });
        },
        paginateFunc(val) {
            this.paginate = val;
            this.fetchTables();
        }
    },
    watch: {
        search() {
            this.paginate.current_page = 1;
            this.fetchTables();
        },
        findMealType() {
            this.fetchTables();
        },
        findCusineType() {
            this.fetchTables();
        },
        findPreferenceType() {
            this.fetchTables();
        }

    }
}
</script>

<style lang="scss">
.wp-ninja-recipe {
    .editor-header {
        display: flex;
        justify-content: space-between;
        .section-action {
            position: relative;
            padding-top: 6px;
            .addTable {
                margin-left: 0px;
            }
            .form_group {
                padding-top: 0;
                margin-bottom: 0;
                input {
                    padding: 5px;
                }
            }
            .el-icon-search {
                position: absolute;
                top: 14px;
                right: 161px;
                font-size: 16px;
            }
        }
    }

    .pull-right {
        float: right;
    }

    .table_form_fields {
        .select_recipe_type {
            float: right;
            margin-top: -22px;
            margin-bottom: 5px;
        }
    }

    .filtered_area {
        background: #fff;
        height: 70px;
        padding: 10px;
        .preference_type {
            margin-left: 12px;
        }
        .closeFilter {
            width: 1.333%;
            float: right;
            margin-top: 15px;
            span {
                color: rgb(185, 19, 19); 
                display: inline-block;
                width: 25px;
                height: 25px;
                cursor: pointer;
            }
        }
    }

    .el-select .el-input__inner {
        background: #fff;
    }
}

.el-message {
    z-index: 99999 !important;
}

@media (max-width: 640px) {
    .wp-ninja-recipe {
        .filtered_area {
            .el-col-4 {
                width: 30%;
            }
        }
        .editor-header {
            .section-action {
                .el-icon-search {
                    position: absolute;
                    top: 70px;
                    right: 177px;
                    font-size: 16px;
                }
            }
        }
    }
}   
</style>
