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

        <!-- Body -->
        <el-row>
            
            <el-col :span="15" class="fields">
                <h2 v-if="recipe_type==='normal'">Normal Recipe</h2>
                <h2 v-if="recipe_type==='advance'">Advance Recipe</h2>

                <div class="change_type">
                    <el-select v-model="recipe_type" placeholder="Recipe Type">
                        <el-option
                            v-for="(type, i) in recipe_types"
                            :key="i"
                            :label="type.label"
                            :value="type.value"></el-option>
                    </el-select>
                </div>

                <div class="all_fields">
                    <el-tabs type="border-card" :stretch=stretch>

                        <el-tab-pane label="Ingredients">
                            <app-wp-editor v-model="post_ingredient"></app-wp-editor>
                        </el-tab-pane>
                        <el-tab-pane label="Description">
                            <app-wp-editor v-model="post_description"></app-wp-editor>
                        </el-tab-pane>
                        <el-tab-pane label="Nutrition">
                            <app-wp-editor v-model="post_nutrition"></app-wp-editor>
                        </el-tab-pane>
                        <el-tab-pane label="Image">
                            <el-upload
                                class="upload-demo"
                                drag
                                action="https://jsonplaceholder.typicode.com/posts/"
                                multiple
                                style="text-align: center">
                                <i class="el-icon-upload"></i>
                                <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                                <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
                            </el-upload>
                        </el-tab-pane>

                    </el-tabs>
                </div>

            </el-col>

            <el-col :span="8" class="show_preview">
                <!-- Tabs Component -->
            </el-col>
        </el-row>
    </div>
</template>

<script>
import wp_editor from './common/_wp_editor.vue'

export default {
    name: 'EditTable',
    components: {
        'app-wp-editor': wp_editor
    },
    data() {
        return {
            table_id: this.$route.params.table_id,
            post_title: '',
            recipe_type: '',
            recipe_types: [
                { value: 'normal', label: 'Normal' },
                { value: 'advance', label: 'Advance' }
            ],
            stretch: true,
            post_ingredient: '',
            post_description: '',
            post_nutrition: ''
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
                    this.recipe_type = response.data.table.recipe_type;
                }
            )

        },
        updateTableConfig() {

            let tableConfig = {
                ingredient: this.post_ingredient,
                description: this.post_description,
                nutrition: this.post_nutrition
            };

            jQuery.post(ajaxurl, {
                action: 'ninja_recipe_ajax_actions',
                route: 'update_table',
                table_id: this.table_id,
                table_config: tableConfig,
                recipe_type: this.recipe_type
            })
            .then(
                (response) => {
                    this.$notify.success({
                        title: 'Updated',
                        message: response.data.message
					});
                }
            )

        },
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

    .fields {
		background: #fff;
		margin-top: 15px;
		margin-right: 20px;
		padding: 20px;
	}

	.fields h2{
		margin-top: 0;
	}

    .change_type {
		float: right;
	  	margin-top: -36px;
	}

    .all_fields {
        margin-top: 30px;
    }

    .el-message--success {
        z-index: 999999!important;
        top: 5px;
    }
}
</style>
