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
            
            <el-col class="fields">
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
                            <img :src=featImage alt="" style="width: 60%;"><br>
                            <div>
                                <el-button @click="upload_image" v-if="!featImage">Upload Image</el-button>
                                <el-button @click="upload_image" v-if="featImage">Change Image</el-button>
                                <el-button @click="featImage = '';" v-if="featImage">Remove</el-button>
                            </div>
                        </el-tab-pane>

                    </el-tabs>
                </div>

            </el-col>

            <el-col class="show_preview">
                <h2>Optional Fields</h2>
                
                <el-row>
                    <el-col :span="24">
                        <label>Select Meal Type</label>
                        <el-select
                            v-model="selectedMealType"
                            multiple
                            filterable
                            allow-create
                            default-first-option
                            placeholder="Choose Meal Type"
                            style="width: 100%;">
                            <el-option
                                v-for="(item, i) in meal_types"
                                :key="i"
                                :label="item.label"
                                :value="item.value"></el-option>
                        </el-select>
                    </el-col>
                    <el-col :span="12">
                        <app-input-dropdown
                            v-model="selectedCusineType"
                            label="Select Cusine Type"
                            pcHolder="Select Cusine Type"
                            :recipeTypes="cusine_types"
                            styleObj="padding-right: 2px; width: 100%;"></app-input-dropdown>
                    </el-col>
                    <el-col :span="12">
                        <app-input-dropdown
                            v-model="selectedPreferenceType"
                            label="Select Preference Type"
                            pcHolder="Select Preference Type"
                            :recipeTypes="preference_types"
                            styleObj="padding-left: 2px; width: 100%;"></app-input-dropdown>
                    </el-col>
                </el-row>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import wp_editor from './common/_wp_editor.vue'
import InputDropdown from './core/InputDropdown.vue'

export default {
    name: 'EditTable',
    components: {
        'app-wp-editor': wp_editor,
        'app-input-dropdown': InputDropdown
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
            meal_types: [
                { value: 'breakfast', label: 'Breakfast' },
                { value: 'lunch', label: 'Lunch' },
                { value: 'dinner', label: 'Dinner' }
            ],
            cusine_types: [
                { value: 'indian', label: 'Indian' },
                { value: 'thai', label: 'Thai' },
                { value: 'chinese', label: 'Chinese' }
            ],
            preference_types: [
                { value: 'veg', label: 'Vegetable' },
                { value: 'non-vegetable', label: 'Non-vegetable' }
            ],
            stretch: true,
            upload_img: '',
            post_ingredient: '',
            post_description: '',
            post_nutrition: '',
            selectedMealType: [],
            selectedCusineType: '',
            selectedPreferenceType: '',
            featImage: ''
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
                    if( response.data.tableConfig ) {
                        this.post_nutrition = response.data.tableConfig.ingredient;
                        this.post_description = response.data.tableConfig.description;
                        this.post_ingredient = response.data.tableConfig.ingredient;
                        this.selectedMealType = response.data.tableConfig.mealType;
                        this.selectedCusineType = response.data.tableConfig.cusineType;
                        this.selectedPreferenceType = response.data.tableConfig.preferenceType;
                        this.featImage = response.data.tableConfig.featuredImage;
                    }
                }
            )

        },
        updateTableConfig() {
            let tableConfig = {
                ingredient: this.post_ingredient,
                description: this.post_description,
                nutrition: this.post_nutrition,
                mealType: this.selectedMealType,
                cusineType: this.selectedCusineType,
                preferenceType: this.selectedPreferenceType,
                featuredImage: this.featImage
            };

            jQuery.post(ajaxurl, {
                action: 'ninja_recipe_ajax_actions',
                route: 'update_table',
                table_id: this.table_id,
                table_config: JSON.stringify(tableConfig),
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

        upload_image() {
            var button = $(this);
            var custom_uploader = wp.media({

                title: 'Insert Recipe Image',
                library : {
                    type : 'image'
                },
                button: {
                    text: 'Use this image' 
                },
                multiple: false

            }).on('select', () => { // using the arrow function cause there is a callback(.on) inside function 
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show();
                this.featImage = attachment.url;
                console.log('Featured Image is: ' + this.featImage)
            })
            .open();
        }
    },
    watch: {
        upload_img() {
            console.log(this.upload_img)
        }
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
        width: 68%;
		background: #fff;
		margin-top: 15px;
		margin-right: 20px;
		padding: 20px;
        h2 {
            margin-top: 0;
        }
	}

    .show_preview {
        width: 29.6%;
        background: #fff;
		margin-top: 15px;
		margin-right: 20px;
		padding: 20px;
        h2 {
            margin-top: 0;
        }
    }

    .change_type {
		float: right;
	  	margin-top: -36px;
	}

    .all_fields {
        margin-top: 30px;
        // .el-tabs {
        //     .is-top {
        //         background: #46A0FC;
        //         border-color: #fff;
        //         .el-tabs__nav {
        //             .is-top {
        //             }
        //         }
        //         .is-active {
        //             background: #fff;
        //             color: #909399;
        //         }
        //     }
        // }
    }

    .el-message--success {
        z-index: 999999!important;
        top: 5px;
    }
}
</style>
