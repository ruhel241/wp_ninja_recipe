<template>
    <div class="ninja_recipe_table">
        
        <!-- Header -->
        <div class="header">
            <div style="display: flex; justify-content: space-between;">
                <div style="flex: 1">
                    <h1>{{ post_title }}
                        <span>
                            <code class="copy" :data-clipboard-text='`[ninja_recipe id="${table_id}"]`' style="cursor: pointer;">
                                [ninja_recipe id="{{table_id}}"]
                            </code>
                        </span>
                    </h1>
                </div>
                <div class="table_action_btn">
                    <el-button class="common_btn" @click="updateTableConfig" type="success" size="mini">
                        Update
                    </el-button>
                    <a :href="demo_url" target="_blank" style="color: #fff; text-decoration: none;">
                        <el-button class="common_btn" type="primary" size="mini">Preview</el-button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Body -->
        <el-row>
            
            <el-col class="field" :span="17">
                <h2>Recipe Title:</h2>
                <el-input placeholder="Title" v-model="post_title" class="recipe_title"></el-input>
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

                        <el-tab-pane label="Introduction">
                            <app-wp-editor v-model="post_introduction"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Ingredients">
                            <app-wp-editor v-model="post_ingredient"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Instruction">
                            <app-wp-editor v-model="post_description"></app-wp-editor>
                        </el-tab-pane>

                        <el-tab-pane label="Nutrition">

                            <div class="nutrition_text_label">
                                <span>Nutrition(as text):</span><el-switch v-model="showNutritionText" inactive-color="#9098B8" active-color="green"></el-switch><br />
                            </div>
                            <div class="nutrition_text_editor">
                            <app-wp-editor
                                v-model="nutrition_text"
                                v-if="showNutritionText"></app-wp-editor>
                            </div>
                            <div class="nutrition_fields_label">
                                <span>Nutrition(as fields):</span><el-switch v-model="showNutritionFields" inactive-color="#9098B8" active-color="green"></el-switch>
                            </div>
                            <div class="nutritions_fields">
                                <app-nutrition
                                    v-for="(field, i) of nutritions" 
                                    :key="i" 
                                    :field="field"
                                    :childIndex="i"
                                    v-if="showNutritionFields"></app-nutrition>
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
                                <el-col :span="8" style="padding-left: 54px;">
                                    <label>Ingredient</label>
                                </el-col>
                                <el-col :span="8">
                                    <label>Amount</label>
                                </el-col>
                                <el-col :span="8">
                                    <label>Unit</label>
                                </el-col>
                            </el-row>
                            <draggable v-model="ingredients_data" :options="{handle:'.handle', animation: 150}">
            
                                <el-row :gutter="10" v-for="(ingredient_data, i) in ingredients_data" :key="i">

                                    <el-col :span="1">
                                        <el-button size="small" class="ing_drag_btn handle">
                                            <i class="el-icon-rank"></i>
                                        </el-button>
                                    </el-col>
                                    <el-col :span="7">
                                        <div>
                                            <input type="text" placeholder="Ingredients" v-model="ingredient_data.ingredient" style="width: 100%; padding: 4px;">
                                            <!-- <el-input type="text" placeholder="Ingredients" v-model="ingredient_data.ingredient"></el-input> -->
                                        </div>
                                    </el-col>

                                    <el-col :span="8">
                                        <div>
                                            <app-input-number
                                                v-model="ingredient_data.amount"
                                                pcHolder="Amount"></app-input-number>
                                        </div>
                                    </el-col>
                                    
                                    <el-col :span="7">
                                        <div>
                                            <select v-model="ingredient_data.unit" placeholder="Unit" style="width: 100%;">
                                                <option 
                                                    v-for="(unit, i) in ingredients_unit"
                                                    :key="i"
                                                    :label="unit.label"
                                                    :value="unit.value"></option>
                                            </select>
                                            <!-- <el-select v-model="ingredient_data.unit" placeholder="Unit" style="width: 100%;">
                                                <el-option 
                                                    v-for="(unit, i) in ingredients_unit"
                                                    :key="i"
                                                    :label="unit.label"
                                                    :value="unit.value"></el-option>
                                            </el-select> -->
                                        </div>
                                    </el-col>

                                    <el-col :span="1">
                                        <el-button size="small" class="ing_delete_btn" @click="deleteIngField(i)">
                                            <i class="el-icon-delete"></i>
                                        </el-button>
                                    </el-col>

                                </el-row>
                            </draggable>
                            <el-button type="success" round size="medium" style="text-align: center" @click="addMoreIngField">+</el-button>
                        </el-tab-pane>

                        <el-tab-pane label="Instruction">
                            <draggable v-model="descriptions_adv" :options="{handle:'.handle', animation: 150}">
                                <el-row :gutter="15" v-for="(description_adv, i) in descriptions_adv" :key="i">
                                    <el-col :span="1">
                                        <el-button size="small" class="desc_drag_btn handle">
                                            <i class="el-icon-rank"></i>
                                        </el-button>
                                    </el-col>
                                    <el-col :span="15">
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
                                    <el-col :span="1" class="desc_dtn_btn_area">
                                        <el-button size="small" class="desc_delete_btn" @click="removeDescAdv(i)">
                                            <i class="el-icon-delete"></i>
                                        </el-button>
                                    </el-col>
                                </el-row>
                            </draggable>
                            <el-row>
                                <el-col>
                                    <el-button type="success" @click="addDescField" round>+</el-button>
                                </el-col>
                            </el-row>
                        </el-tab-pane>

                        <el-tab-pane label="Nutrition">

                            <div class="nutrition_text_label">
                                <span>Nutrition(as text):</span><el-switch v-model="showNutritionText" inactive-color="#9098B8" active-color="green"></el-switch><br />
                            </div>

                            <div class="nutrition_text_editor">

                                <app-wp-editor
                                    v-model="nutrition_text"
                                    v-if="showNutritionText"></app-wp-editor>

                            </div>
                            <div class="nutrition_fields_label">

                                <span>Nutritions(as field):</span><el-switch v-model="showNutritionFields" inactive-color="#9098B8" active-color="green"></el-switch>
                            
                            </div>
                            <div class="nutritions_fields">

                                <app-nutrition
                                    v-for="(field, i) of nutritions"
                                    :key="i" 
                                    :field="field"
                                    :childIndex="i"
                                    v-if="showNutritionFields"></app-nutrition>

                            </div>

                        </el-tab-pane>

                    </el-tabs>
                </div>

            </el-col>

            <el-col class="show_preview" :span="7">

                <el-collapse v-model="active_optional_field">
                    <el-collapse-item title="Optional Fields" name="optional_fields">
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
                                    style="width: 99%;">
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
                                    styleObj="padding-right: 2px; width: 97%;"></app-input-dropdown>
                            </el-col>
                            <el-col :span="12">
                                <app-input-dropdown
                                    v-model="selectedPreferenceType"
                                    label="Select Preference Type"
                                    pcHolder="Select Preference Type"
                                    :recipeTypes="preference_types"
                                    styleObj="padding-left: 2px; width: 97%;"></app-input-dropdown>
                            </el-col>
                            <el-col :span="24">
                                <app-input-number
                                    v-model="totalPeople"
                                    pcHolder="How many people serve?"
                                    label="How many people serve?"></app-input-number>
                                <!-- <label>How many people serve?</label>
                                <input type="number" placeholder="How many people serve?" v-model="totalPeople"> -->
                            </el-col>
                            <el-col :span="24">
                                <app-input-text
                                    v-model="makingTime"
                                    pcHolder="Total making time"
                                    label="Total making time"></app-input-text>
                            </el-col>
                        </el-row>
                    </el-collapse-item>
                </el-collapse>

            </el-col>
            <el-col class="show_featured_image" :span="7">

                <el-collapse v-model="active_featured_image">
                    <el-collapse-item title="Featured Image" name="featured_image">
                        <hr>
                        <el-row>
                            <el-col :span="24">
                                <div class="featured_image_section">
                                    <img :src=featImage alt="" class="feat_img"><br>
                                    <div class="feat_img_btn">
                                        <span class="upld_btn">
                                            <el-button @click="upload_image" v-if="!featImage">Upload Image</el-button>
                                        </span>
                                        <span class="img_custom_btn">
                                            <el-button @click="upload_image" v-if="featImage">Change Image</el-button>
                                            <el-button @click="featImage = '';" v-if="featImage">Remove</el-button>
                                        </span>
                                    </div>
                                </div>
                            </el-col>
                        </el-row>
                    </el-collapse-item>
                </el-collapse>

            </el-col>
        </el-row>
    </div>
</template>

<script>
import wp_editor from '../common/_wp_editor.vue'
import InputDropdown from '../core/InputDropdown.vue'
import InputText from '../core/InputText.vue'
import InputNumber from '../core/InputNumber.vue'
import NutritionFields from '../common/NutritionFields.vue'
import draggable from 'vuedraggable'
import Clipboard from 'clipboard'

export default {
    name: 'EditTable',
    components: {
        'app-wp-editor': wp_editor,
        'app-input-dropdown': InputDropdown,
        'app-input-text': InputText,
        'app-input-number': InputNumber,
        'app-nutrition': NutritionFields,
        draggable
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
            nutritions: [
                [
                    { 
                        serial: 0, label: 'Total Fat', value: '', children: [
                            { 
                                serial: 1, label: 'Saturated Fat', value: '' 
                            },
                            { 
                                serial: 2, label: 'Trans Fat', value: ''
                            }  
                        ]
                    },
                    { serial: 1, label: 'Calories', value: '' },
                    { serial: 2, label: 'Calories from Fat', value: '' },
                    { serial: 3, label: 'Cholesterol', value: '' },
                    { serial: 4, label: 'Sodium', value: '' },
                    { serial: 5, label: 'Potassium', value: '' },
                    { 
                        serial: 6, label: 'Total Carbohydrate', value: '', children: [
                            {
                                serial: 1, label: 'Dietary Fibre', value: ''
                            },
                            {
                                serial: 2, label: 'Sugars', value: ''
                            }
                        ]
                    },
                    { serial: 7, label: 'Protein', value: '' },
                    { serial: 8, label: '', value: '' },
                    { serial: 9, label: '', value: '' },
                    { serial: 10, label: '', value: '' },
                    { serial: 11, label: '', value: '' },
                    { serial: 12, label: '', value: '' },
                    { serial: 13, label: '', value: '' }
                ],
                [
                    { serial: 8, label: 'Vitamin A', value: '' },
                    { serial: 9, label: 'Vitamin C', value: '' },
                    { serial: 10, label: 'Calcium', value: '' },
                    { serial: 11, label: 'Iron', value: '' },
                    { serial: 12, label: 'Vitamin D', value: '' },
                    { serial: 13, label: 'Chloride', value: '' },
                    { serial: 14, label: 'Vitamin E', value: '' },
                    { serial: 15, label: 'Vitamin K', value: '' },
                    { serial: 16, label: 'Vitamin B6', value: '' },
                    { serial: 17, label: 'Vitamin B12', value: '' },
                    { serial: 18, label: 'Thiamin', value: '' },
                    { serial: 19, label: 'Riboflavin', value: '' },
                    { serial: 20, label: 'Niacin', value: '' },
                    { serial: 21, label: 'Folate', value: '' },
                ],
                [
                    { serial: 22, label: 'Biotin', value: '' },
                    { serial: 23, label: 'Pantothenic Acid', value: '' },
                    { serial: 24, label: 'Phosphorus', value: '' },
                    { serial: 25, label: 'Iodine', value: '' },
                    { serial: 26, label: 'Magnesium', value: '' },
                    { serial: 26, label: 'Zinc', value: '' },
                    { serial: 27, label: 'Selenium', value: '' },
                    { serial: 28, label: 'Copper', value: '' },
                    { serial: 29, label: 'Manganese', value: '' },
                    { serial: 30, label: 'Chromium', value: '' },
                    { serial: 31, label: 'Molybdenum', value: '' },
                    { serial: 32, label: '', value: '' },
                    { serial: 33, label: '', value: '' },
                    { serial: 34, label: '', value: '' }
                ]
            ],
            stretch: true,
            upload_img: '',
            nutrition_text: '',
            post_ingredient: '',
            post_description: '',
            post_introduction: '',
            post_nutrition: '',
            post_nutrition_adv: '',
            selectedMealType: [],
            selectedCusineType: '',
            selectedPreferenceType: '',
            featImage: '',
            totalPeople: '',
            makingTime: '',
            demo_url: '',
            active_featured_image: ['featured_image'],
            active_optional_field: ['optional_fields'],
            showNutritionFields: false,
            showNutritionText: true
        }
    },
    created() {
        this.fetchTable();
        this.clipboardRender();
    },
    methods: {
        fetchTable() {

            let fetchTableAjaxData = {
                action: 'ninja_recipe_ajax_actions',
                route: 'get_table',
                table_id: this.table_id
            };

            jQuery.get(ajaxurl, fetchTableAjaxData)
            .then(
                (response) => {
                    console.log(response)
                    this.post_title = response.data.table.post_title;
                    this.recipe_type = response.data.table.recipe_type;
                    this.demo_url = response.data.demo_url;
                    if( response.data.tableConfig ) {

                        if( this.recipe_type == 'normal' ) {

                            this.post_introduction = response.data.tableConfig.introduction;
                            this.post_description = response.data.tableConfig.description;
                            this.nutritions = response.data.tableConfig.nutrition;
                            this.post_ingredient = response.data.tableConfig.ingredient;

                        }

                        else if( this.recipe_type == 'advance' ) {

                            this.post_introduction = response.data.tableConfig.introduction;
                            this.descriptions_adv = response.data.tableConfig.description;
                            this.nutritions = response.data.tableConfig.nutrition;
                            this.ingredients_data = response.data.tableConfig.ingredient;

                        }
                    
                        this.selectedMealType = response.data.tableConfig.mealType;
                        this.selectedCusineType = response.data.tableConfig.cusineType;
                        this.selectedPreferenceType = response.data.tableConfig.preferenceType;
                        this.totalPeople = response.data.tableConfig.totalPeople;
                        this.featImage = response.data.tableConfig.featuredImage;
                        this.nutrition_text = response.data.tableConfig.nutrition.nutrition_text;
                        this.nutritions = response.data.tableConfig.nutrition.nutrition_fields;
                        this.showNutritionFields = response.data.tableConfig.nutrition.showNutritionFields;
                        this.makingTime = response.data.tableConfig.makingTime;

                    }
                }
            )

        },
        updateTableConfig() {

            if( this.recipe_type === 'normal' ) {
                var introduction = this.post_introduction;
                var ingredient = this.post_ingredient;
                var description = this.post_description;
            }

            else if( this.recipe_type === 'advance' ) {
                var introduction = this.post_introduction;
                var ingredient = this.ingredients_data;
                var description = this.descriptions_adv;
            }

            var featImage = this.featImage;

            let nutrition = {
                nutrition_text: this.nutrition_text,
                nutrition_fields: this.nutritions,
                showNutritionFields: this.showNutritionFields
            };
            let tableConfig = {
                introduction: introduction,
                ingredient: ingredient,
                description: description,
                nutrition: nutrition,
                mealType: this.selectedMealType,
                cusineType: this.selectedCusineType,
                preferenceType: this.selectedPreferenceType,
                totalPeople: this.totalPeople,
                featuredImage: featImage,
                makingTime: this.makingTime
            };

            console.log(tableConfig)

            let updateTableAjaxData = {
                action: 'ninja_recipe_ajax_actions',
                route: 'update_table',
                table_id: this.table_id,
                table_config: JSON.stringify(tableConfig),
                post_title: this.post_title,
                recipe_type: this.recipe_type
            };

            jQuery.post(ajaxurl, updateTableAjaxData)
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

        clipboardRender() {
            var clipboard = new Clipboard('.copy');
            clipboard.on('success', (e) => {
                this.$message({
                    message: 'Copied to Clipboard!',
                    type: 'success'
                });
            });
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

        .table_action_btn {
            padding-left: 93px;
            padding-top: 13px;
            .el-button--mini, .el-button--mini.is-round {
                padding: 7px 15px; 
            }
        }
    }

    .table_action_btn {
        padding-left: 93px;
    }

    .field {
        margin-top: 18px;
		padding-right: 15px; 
        h2 {
            margin-top: 0;
        }
        .recipe_title {
            margin-bottom: 13px;
        }
        .all_fields {
            margin-top: 30px;
            .nutrition_text_label {
                margin-bottom: 7px;
            }
            .nutrition_fields_label {
                margin-bottom: 7px;
                margin-top: 10px;
            }
            .ing_drag_btn {
                // padding: 13px;
                span {
                    .el-icon-rank {
                        color: black;
                    }
                }
            }
            .ing_delete_btn {
                //padding: 13px;
                span {
                    .el-icon-rank {
                        color: black;
                    }
                }
            }
            .desc_drag_btn {
                //
                span {
                    .el-icon-rank {
                        color: black;
                    }
                }
            }
            .desc_dtn_btn_area {
                padding-left: 0;
                padding-right: 0;
                width: auto;
                .desc_delete_btn {
                    padding: 13px;
                    span {
                        .el-icon-rank {
                            color: black;
                        }
                    }
                }
            }
            .featured_image_section {
                .feat_img {
                    width: 50%;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
                .feat_img_btn {
                    .upld_btn {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                        width: 12%;
                    }
                    .img_custom_btn {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                        width: 30%;
                    }
                }
            }
        }
	}

    .show_preview {
        background: #fff;
		padding: 20px;
        margin-top: 19px;
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);
        h2 {
            margin-top: 0;
        }
        .el-collapse-item__header {
            font-size: 17px;
        }
        .el-collapse-item__wrap {
            border-bottom: 0;
        }
        .el-collapse-item__header {
            border-bottom: 1px solid #ebeef5 !important;
        }
        .el-collapse {
            border-top: 0px;
        }
        .el-select__input {
            border: none;
            box-shadow: none;
        }
        .el-select__input {
            background-color: transparent;
        }

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #C2C4CC;
            opacity: 1;
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #C2C4CC;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #C2C4CC;
        }
    }

    .show_featured_image {
        background: #fff;
		padding: 20px;
        margin-top: 19px;
        float: right;
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);
        h2 {
            margin-top: 0;
        }
        .featured_image_section {
            .feat_img {
                width: 50%;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            .feat_img_btn {
                .upld_btn {
                    display: block;
                    text-align: center;
                }
                .img_custom_btn {
                    display: block;
                    text-align: center;
                }
            }
        }
        .el-collapse-item__header {
            font-size: 17px;
        }
        .el-collapse-item__wrap {
            border-bottom: 0;
        }
        .el-collapse {
            border-top: 0px;
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

    .el-input__inner {
        background: #fff;
    }
}

.el-message {
    z-index: 99999 !important;
}

@media (max-width: 600px) {

        .ninja_recipe_table {
            .field {
                width: 100%;
                .all_fields {
                    width: 100%;
                }
            }
            .show_preview {
                width: 96%;
            }
            .show_featured_image {
                width: 96%;
                float: left;
            }
        }

    }

@media (min-width: 768px) and (max-width: 1024px) {
  
  .ninja_recipe_table {
        .field {
            width: 100%;
            .all_fields {
                width: 100%;
            }
        }
        .show_preview {
            width: 98%;
        }
        .show_featured_image {
            width: 98%;
            float: left;
        }
    }
  
}

@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
  
  .ninja_recipe_table {
    .field {
        width: 100%;
        .all_fields {
            width: 100%;
        }
    }
    .show_preview {
        width: 98%;
    }
    .show_featured_image {
        width: 98%;
        float: left;
    }
}
  
}
</style>
