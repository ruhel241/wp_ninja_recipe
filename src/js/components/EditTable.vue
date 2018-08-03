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

                <div class="all_fields" v-if="recipe_type === 'normal'">
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
                        <el-tab-pane label="Featured Image">
                            <img :src=featImage alt="" style="width: 60%;"><br>
                            <div>
                                <el-button @click="upload_image" v-if="!featImage">Upload Image</el-button>
                                <el-button @click="upload_image" v-if="featImage">Change Image</el-button>
                                <el-button @click="featImage = '';" v-if="featImage">Remove</el-button>
                            </div>
                        </el-tab-pane>

                    </el-tabs>
                </div>

                <div class="all_fields" v-if="recipe_type === 'advance'">
                    <el-tabs type="border-card" :stretch=stretch>

                        <el-tab-pane label="Introduction">
                            <app-wp-editor v-model="post_introduction"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Ingredients">
                            <el-row :gutter="10">
                                <el-col :span="8">
                                    <label>Ingredient</label>
                                </el-col>
                                <el-col :span="8">
                                    <label>Amount</label>
                                </el-col>
                                <el-col :span="8">
                                    <label>Unit</label>
                                </el-col>
                            </el-row>
                            <el-row :gutter="10" v-for="(ingredient_data, i) of ingredients_data" :key="i">
                                <el-col :span="8">
                                    <div>
                                        <el-input type="text" placeholder="Ingredients" v-model="ingredient_data.ingredient"></el-input>
                                    </div>
                                </el-col>
                                <el-col :span="8">
                                    <div>
                                        <input type="number" placeholder="Amount" v-model="ingredient_data.amount" class="ing_amnt_field">
                                    </div>
                                </el-col>
                                <el-col :span="7">
                                    <div>
                                        <el-select v-model="ingredient_data.unit" placeholder="Unit" style="width: 100%;">
                                            <el-option 
                                                v-for="(unit, i) in ingredients_unit"
                                                :key="i"
                                                :label="unit.label"
                                                :value="unit.value"></el-option>
                                        </el-select>
                                    </div>
                                </el-col>
                                <el-col :span="1">
                                    <span style="cursor: pointer" @click="deleteIngField(i)">X</span>
                                </el-col>
                            </el-row>
                            <el-button type="success" round size="medium" style="text-align: center" @click="addMoreIngField">+</el-button>
                        </el-tab-pane>
                        <el-tab-pane label="Description">
                            <el-row :gutter="15" v-for="(description_adv, i) of descriptions_adv" :key="i">
                                <el-col :span="16">
                                    <app-wp-editor v-model="description_adv.desc_text"></app-wp-editor>
                                </el-col>
                                <el-col :span="6">
                                    <img :src=description_adv.desc_img alt="" style="width: 50%;"><br>
                                    <div>
                                        <el-button @click="upload_img_adv_desc(i)" v-if="!description_adv.desc_img">Upload Image</el-button>
                                        <el-button @click="upload_img_adv_desc(i)" v-if="description_adv.desc_img">Change Image</el-button>
                                        <el-button @click="description_adv.desc_img = '';" v-if="description_adv.desc_img">Remove</el-button>
                                    </div>
                                </el-col>
                                <el-col :span="1">
                                    <span style="cursor: pointer; color: red;" @click="removeDescAdv(i)">X</span>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col>
                                    <el-button type="success" @click="addDescField">+</el-button>
                                </el-col>
                            </el-row>
                        </el-tab-pane>
                        <el-tab-pane label="Nutrition">
                            <app-nutrition-adv
                                v-for="(field, i) of nutrition_adv" :key="i" :field="field"></app-nutrition-adv>
                        </el-tab-pane>
                        <el-tab-pane label="Featured Image">
                            <img :src=featImageAdv alt="" style="width: 60%;"><br>
                            <div>
                                <el-button @click="upload_image_adv_feat" v-if="!featImageAdv" type="success">Upload Image</el-button>
                                <el-button @click="upload_image_adv_feat" v-if="featImageAdv" type="primary">Change Image</el-button>
                                <el-button @click="featImageAdv = '';" v-if="featImageAdv" type="danger">Remove</el-button>
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
import NutritionAdv from './NutritionAdv.vue'

export default {
    name: 'EditTable',
    components: {
        'app-wp-editor': wp_editor,
        'app-input-dropdown': InputDropdown,
        'app-nutrition-adv': NutritionAdv
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
                { value: 'Breakfast', label: 'Breakfast' },
                { value: 'Lunch', label: 'Lunch' },
                { value: 'Dinner', label: 'Dinner' }
            ],
            cusine_types: [
                { value: 'Indian', label: 'Indian' },
                { value: 'Thai', label: 'Thai' },
                { value: 'Chinese', label: 'Chinese' }
            ],
            preference_types: [
                { value: 'Vegetable', label: 'Vegetable' },
                { value: 'Non-vegetable', label: 'Non-vegetable' }
            ],
            ingredients_data: [
                { ingredient: '', amount: '', unit: '' }
            ],
            ingredients_unit: [
                { value: 'TSP', label: 'TSP' },
                { value: 'Tbs', label: 'Tbs' },
                { value: 'Cup', label: 'Cup' },
                { value: 'Kg', label: 'Kg' },
                { value: 'Liter', label: 'Liter' }
            ],
            descriptions_adv: [
                { desc_text: '', desc_img: '' }
            ],
            nutrition_adv: [
                { label: 'Calories', disabled: false, value: 0 },
                { label: 'Calories From Fat', disabled: false, value: 0 },
                { label: 'Total Fat', disabled: false, value: 0 },
                { label: 'Saturated Fat', disabled: false, value: 0 },
                { label: 'Trans Fat', disabled: false, value: 0 },
                { label: 'Cholesterol', disabled: false, value: 0 },
                { label: 'Sodium', disabled: false, value: 0 },
                { label: 'Potassium', disabled: false, value: 0 },
                { label: 'TotalCarbohydrate', disabled: false, value: 0 },
                { label: 'DietaryFiber', disabled: false, value: 0 },
                { label: 'Sugars', disabled: false, value: 0 },
                { label: 'Protein', disabled: false, value: 0 },
                { label: 'VitaminA', disabled: false, value: 0 },
                { label: 'VitaminC', disabled: false, value: 0 },
                { label: 'VitaminD', disabled: false, value: 0 },
                { label: 'VitaminE', disabled: false, value: 0 },
                { label: 'VitaminK', disabled: false, value: 0 },
                { label: 'VitaminB6', disabled: false, value: 0 },
                { label: 'VitaminB12', disabled: false, value: 0 },
                { label: 'Calcium', disabled: false, value: 0 },
                { label: 'Iron', disabled: false, value: 0 },
                { label: 'Thiamin', disabled: false, value: 0 },
                { label: 'Riboflavin', disabled: false, value: 0 },
                { label: 'niacin', disabled: false, value: 0 },
                { label: 'Folate', disabled: false, value: 0 },
                { label: 'Biotin', disabled: false, value: 0 },
                { label: 'Pantothenic Acid', disabled: false, value: 0 },
                { label: 'Phosphorus', disabled: false, value: 0 },
                { label: 'Iodine', disabled: false, value: 0 },
                { label: 'Magnesium', disabled: false, value: 0 },
                { label: 'Zinc', disabled: false, value: 0 },
                { label: 'Selenium', disabled: false, value: 0 },
                { label: 'Copper', disabled: false, value: 0 },
                { label: 'Manganese', disabled: false, value: 0 },
                { label: 'Chromium', disabled: false, value: 0 },
                { label: 'Molybdenum', disabled: false, value: 0 },
                { label: 'Chloride', disabled: false, value: 0 }
            ],
            stretch: true,
            upload_img: '',
            post_ingredient: '',
            post_description: '',
            post_introduction: '',
            post_nutrition: '',
            post_description_adv: '',
            post_nutrition_adv: '',
            selectedMealType: [],
            selectedCusineType: '',
            selectedPreferenceType: '',
            featImage: '',
            featImageAdv: ''
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
                        this.post_introduction = response.data.tableConfig.introduction;
                        this.ingredients_data = response.data.tableConfig.ingredient;
                        this.descriptions_adv = response.data.tableConfig.description;
                        this.nutrition_adv = response.data.tableConfig.nutrition;
                        this.featImageAdv = response.data.tableConfig.featuredImage;
                        
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

            if( this.recipe_type === 'advance' ) {
                var introduction = this.post_introduction;
                var ingredient = this.ingredients_data;
                var description = this.descriptions_adv;
                var nutrition = this.nutrition_adv;
                var featImage = this.featImageAdv;
            }

            let tableConfig = {
                introduction: introduction,
                ingredient: ingredient,
                description: description,
                nutrition: nutrition,
                mealType: this.selectedMealType,
                cusineType: this.selectedCusineType,
                preferenceType: this.selectedPreferenceType,
                featuredImage: featImage
            };

            console.log(tableConfig)

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
        },

        upload_img_adv_desc(i) {
            var button = $(this);
            var custom_uploader = wp.media({

                title: 'Insert Description Image',
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
                this.descriptions_adv[i].desc_img = attachment.url;
            })
            .open();
        },

        addMoreIngField() {
            this.ingredients_data.push({
                ingredient: '',
                amount: '',
                unit: ''
            })
        },

        deleteIngField(index) {
            this.ingredients_data.splice(index, 1);
        },

        addDescField() {
            this.descriptions_adv.push({
                desc_text: '',
                desc_img: ''
            })
        },

        removeDescAdv(index) {
            this.descriptions_adv.splice(index, 1);
        },

        upload_image_adv_feat() {
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
                this.featImageAdv = attachment.url;
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
        .all_fields {
            margin-top: 30px;
            .ing_amnt_field {
                width: 100%;
                padding: 19px;
                border-radius: 4px;
            }
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

    .el-message--success {
        z-index: 999999!important;
        top: 5px;
    }
}
</style>
