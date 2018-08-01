<template>
    <div class="ninja_recipe_table">
        
        <!-- Header -->
        <el-row class="header">
            <el-col :span="24">
                <el-col :span="20">
                    <h1>{{ post_title }}
                        <span>
                            <code class="copy_shortcode" :data-clipboard-text='`[ninja_mortgage_cal id="${table_id}"]`'>
                                [ninja_recipe id="{{table_id}}"]
                            </code>
                        </span>
                    </h1>
                </el-col>
                <el-col :span="4" class="table_action_btn">
                    <el-button class="common_btn" @click="updateTableConfig" type="success">
                        Update
                    </el-button>
                    <a style="color: #fff; text-decoration: none;">
                        <el-button class="common_btn" type="primary">Preview</el-button>
                    </a>
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
        },
        updateTableConfig() {}
    }
}
</script>

<style lang="scss">
.ninja_recipe_table {

    .header {
        font-size: 20px;
	    padding-bottom: 10px;
	    background: #fff;
	    margin-top: -20px;
	    padding-top: 22px;
	    margin-right: -20px;
	    margin-left: -20px;
	    padding-left: 24px;
    }

    .table_action_btn {
        padding-left: 93px;
    }
}
</style>
