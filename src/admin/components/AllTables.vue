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
        <el-table 
            :data="tableData"
            style="width: 100%; margin-top: 10px;"
            v-loading="tableLoading"
            border>

            <el-table-column label="Image" width="90">

                <template
                    slot-scope="scope">
                    <router-link
                        :to="{name: 'edit_table', params: { table_id: scope.row.ID } }">
                        <span><img v-if="scope.row.tableConfig && scope.row.tableConfig.featuredImage" :src=scope.row.tableConfig.featuredImage style="width: 100%;"></span>
                        <span><img v-if="!scope.row.tableConfig.featuredImage" :src=scope.row.defaultImage style="width: 100%;"></span>
                    </router-link>
                </template>

            </el-table-column>


            <el-table-column label="Name">

                <template
                    slot-scope="scope">
                    <router-link 
                        :to="{name: 'edit_table', params: { table_id: scope.row.ID } }">
                        <div>
                            <span>{{ scope.row.post_title }}</span>
                        </div>
                    </router-link>
                </template>

            </el-table-column>  

            <el-table-column label="Recipe Type">

                <template slot-scope="scope">
                    <span v-if="scope.row.recipe_type=='normal'">
                        Normal
                    </span>
                    <span v-if="scope.row.recipe_type=='advance'">
                        Advance
                    </span>
                </template> 

            </el-table-column> 

            <el-table-column label="Meal Type">
                
                <template slot-scope="scope" v-if="scope.row.tableConfig">
                    <span v-for="(mealType, mealType_index) in scope.row.tableConfig.mealType" :key="mealType_index">
                        {{mealType}}<span v-if="mealType_index < scope.row.tableConfig.mealType.length-1">, </span>
                    </span>    
                </template>

            </el-table-column>

            <el-table-column label="Cusine Type">
                
                <template slot-scope="scope" v-if="scope.row.tableConfig">
                    {{ scope.row.tableConfig.cusineType }}
                </template>

            </el-table-column>

            <el-table-column label="Preference">
                
                <template slot-scope="scope" v-if="scope.row.tableConfig">
                    {{ scope.row.tableConfig.preferenceType }}
                </template>

            </el-table-column>

            <el-table-column label="ShortCode">

                <template slot-scope="scope">
                    <code class="copy" :data-clipboard-text='`[ninja_recipe id="${scope.row.ID}"]`' style="cursor: pointer;">
                        [ninja_recipe id="{{ scope.row.ID }}"]
                    </code>
                </template>

            </el-table-column> 

            <el-table-column label="Actions" width="180">
                
                <template slot-scope="scope">
                    <router-link title="Edit" :to="{ name: 'edit_table', params: { table_id: scope.row.ID} }">
                        <span>Edit</span>
                    </router-link>
                    <a :href="scope.row.demo_url"  target="_blank" class="el-button el-button--info el-button--mini">
                        <i class="el-icon-view"></i>
                    </a>
                    <app-delete-table @delete="deleteTable(scope.row.ID)"></app-delete-table>
                </template>

            </el-table-column>

        </el-table>

        <!-- Pagination -->
        <div class="pull-right">
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="goToPage"
                    :current-page.sync="paginate.current_page"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="paginate.per_page"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="paginate.total">
            </el-pagination>
        </div>

         <!-- Dialog for Adding Table -->
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

    </div>
</template>

<script>
import Clipboard from 'clipboard'
import DeleteTable from './actions/DeleteTable.vue'
import InputDropdown from './core/InputDropdown.vue'

export default {
    name: 'AllTables',
    components: {
        'app-delete-table': DeleteTable,
        'app-input-dropdown': InputDropdown
    },
    data() {
        return {
            search: '',
            per_page: 10,
            tableData: [],
            table_name: '',
            page_number: 1,
            tableLoading: false,
            showFilterSection: false,
            recipe_types: [
                { value: 'normal', label: 'Normal' },
                { value: 'advance', label: 'Advance' }
            ],
            addTableModal: false,
            selectedRecipe: '',
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
                { value: 'Maxican', label: 'Maxican' }
            ],
            preference_types: [
                { value: 'Vegetable', label: 'Vegetable' },
                { value: 'Non-vegetable', label: 'Non-vegetable' }
            ],
            paginate: {
                total: 0, 
                current_page: 1,
                last_page: 1,
                per_page: 10
            },
            searchAction: 0
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
        addNewTable() {
            this.addingTableAjax = true

            let addTableAjaxData = {
                action: 'ninja_recipe_ajax_actions',
                route: 'add_table',
                post_title: this.table_name,
                recipe_type: this.selectedRecipe 
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
        goToPage(value) {
            this.paginate.current_page = value;
            this.fetchTables();
        },
        handleSizeChange(val) {
            this.paginate.per_page = val;
            this.fetchTables();
        },
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

@media (max-width: 640px) {
    .wp-ninja-recipe {
        .filtered_area {
            .el-col-4 {
                width: 30%;
            }
        }
    }
}
    
</style>
