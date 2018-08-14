<template>
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

        <el-table-column label="ShortCode" width="230">

            <template slot-scope="scope">
                <code class="copy" :data-clipboard-text='`[ninja_recipe id="${scope.row.ID}"]`' style="cursor: pointer;">
                    [ninja_recipe id="{{ scope.row.ID }}"]
                </code>
            </template>

        </el-table-column> 

        <el-table-column label="Actions" width="190">
            
            <template slot-scope="scope">
                <router-link title="Edit" :to="{ name: 'edit_table', params: { table_id: scope.row.ID} }" class="el-button el-button--primary el-button--mini">
                    <i class="el-icon-edit"></i>
                </router-link>
                <a :href="scope.row.demo_url"  target="_blank" class="el-button el-button--info el-button--mini">
                    <i class="el-icon-view"></i>
                </a>
                <app-delete-table @delete="deleteTable(scope.row.ID)"></app-delete-table>
            </template>

        </el-table-column>

    </el-table>
</template>

<script>
import DeleteTable from '../actions/DeleteTable.vue'
export default {
    name: 'ListAllTable',
    props: {
        tableData: {
            default: []
        },
        tableLoading: {
            default: false
        }
    },
    components: {
        'app-delete-table': DeleteTable,
    },
    methods: {
        deleteTable(id) {
            this.$emit('removeTable', id)
        }
    }
}
</script>

<style>

</style>
