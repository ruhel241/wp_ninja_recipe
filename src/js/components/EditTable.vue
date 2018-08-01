<template>
    <div class="ninja_recipe_table">
        
        <!-- Header -->
        <el-row class="header">
            <el-col :span="24">
                <el-col :span="20">
                    <h1>{{ post_title }}</h1>
                </el-col>
            </el-col>
        </el-row>

    </div>
</template>

<script>
export default {
    name: 'EditTable',
    data() {
        return {
            table_id: this.$route.params.table_id,
            post_title: ''
        }
    },
    created() {
        this.fetchTable();
    },
    methods: {
        fetchTable() {
            jQuery.get(ajaxurl, {
                action: 'ninja_recipe_ajax_actions',
                route: 'get_table',
                table_id: this.table_id
            })
            .then(
                (response) => {
                    console.log(response)
                    this.post_title = response.data.table.post_title;
                }
            )
        }
    }
}
</script>

<style>

</style>
