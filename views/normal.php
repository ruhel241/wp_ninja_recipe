<div class="ninja_normal_recipe">
	

		<div class="recipe_feature_img">
			<img src="<?php  echo $recipeMetaData['featuredImage']; ?>">
		</div>

		<div class="title"> <h1> <?php echo $post->post_title; ?> </h1> </div>

		<div class="intro_description"> 	
			<p> <?php  echo $recipeMetaData['introduction']; ?> </p> 
		</div>



		<div class="time_serving"> 
			<span class="making_time"> Making Time: <?php  echo $recipeMetaData['makingTime']; ?> </span>
			<span class="serving_people"> Serving People:  <?php  echo $recipeMetaData['totalPeople']; ?> </span>
		</div>


		<div class="ingredient">
			<h3>Ingredient: </h3>
			<p> <?php  echo $recipeMetaData['ingredient']; ?> </p> 
		</div>


		<div class="Instruction">
			<h3>Instruction: </h3>
			<p> <?php  echo $recipeMetaData['description']; ?> </p> 
		</div>
		

		<div class="nutrition">
			<h3>Nutrition: </h3>
			<p> <?php  echo $recipeMetaData['nutrition']['nutrition_text']; ?> </p> 

		   		<p> <b> Nutrition Facts: </b> 
		    	<ul>
		    		 <?php //foreach ($nutrition_fields as $nutrition_field) : ?>
						<?php //foreach($nutrition_field as $nutrition ):?>
							<!-- <li> <?php //echo $nutrition['label'] .'=>'. $nutrition['value'];  ?></li> -->
						<?php //endforeach; ?>
					<?php //endforeach; ?>

		    	</ul>
		</div>




		<div class="nutritions_fact">
				
			<div class="cooked_nutrition">
				<h2 class="title">Nutrition Facts</h2>
				<p class="serving_size">Serving Size <span class="green">2</span> cups</p>
				<p class="serving_people">Servings <span class="green">6</span></p>
			</div>

			<hr class="hr_fat">
			
			<section class="fact_section_1">
				<p class="per_serving">Amount Per Serving</p>
				<strong class="cooked_label">Calories</strong> 
				<span class="cooked_value green">730</span>
				<span class="cooked_right">Calories from Fat <span class="green">30</span> </span>
			</section>

			<section class="fact_section_2">
				<p class="hr_thick" style="padding-bottom: 25px !important;">
				 	<span class="daily_value green"> % Daily Value * </span>
				</p>
			

				<p class="hr_thick">
					<strong class="cooked_label">Total Fat</strong> 
					<span class="cooked_value green">5g</span>
					<span class="green cooked_right">8%</span> 
				</p>
				
				<p class="hr_thick" style="margin-left:15px !important; ">
					<strong class="cooked_label">Saturated Fat</strong> 
					<span class="cooked_value green">2g</span>
					<span class="green cooked_right">10%</span> 
				</p>

				<p class="hr_thick" style="padding-left:15px; ">
					<strong class="cooked_label">Trans Fat</strong> 
					<span class="cooked_value green">3g</span>
					<span class="green cooked_right"></span> 
				</p>

				<p class="hr_thick">
					<strong class="cooked_label">Cholesterol</strong> 
					<span class="cooked_value green">135mg</span>
					<span class="green cooked_right">45%</span> 
				</p>

				<p class="hr_thick">
					<strong class="cooked_label">Sodium</strong> 
					<span class="cooked_value green">50mg</span>
					<span class="green cooked_right">2%</span> 
				</p>

				<p class="hr_thick">
					<strong class="cooked_label">Potassium</strong> 
					<span class="cooked_value green">12mg</span>
					<span class="green cooked_right">0%</span> 
				</p>

				<p class="hr_thick">
					<strong class="cooked_label">Total Carbohydrate</strong> 
					<span class="cooked_value green">10g</span>
					<span class="green cooked_right">3%</span> 
				</p>

				<p class="hr_thick" style="margin-left:15px !important;">
					<strong class="cooked_label">Dietary Fiber</strong> 
					<span class="cooked_value green">4g</span>
					<span class="green cooked_right">16%</span> 
				</p>

				<p class="hr_thick" style="padding-left:15px;">
					<strong class="cooked_label">Sugars</strong> 
					<span class="cooked_value green">1g</span>
					<span class="green cooked_right"></span> 
				</p>

				<p class="">
					<strong class="cooked_label">Potein</strong> 
					<span class="cooked_value green">10g</span>
					<span class="green cooked_right">20%</span> 
				</p>

			</section>

			<section class="fact_section_3">

				<p class="hr_thick">
					<span class="cooked_fact_fifty">
						<span class="cooked_label">Vitamin A </span> 
						<span class="cooked_value green">1%</span>
					</span>
					<span>
						<span class="cooked_label">Vitamin C </span> 
						<span class="cooked_value green">2%</span>
					</span>
				</p>

				<p class="hr_thick">
					<span class="cooked_fact_fifty">
						<span class="cooked_label">Calcium</span> 
						<span class="cooked_value green">3%</span>
					</span>

					<span>
						<span class="cooked_label">Iron</span> 
						<span class="cooked_value green">10%</span>
					</span>
				</p>

				<p class="hr_thick">
					<span class="cooked_fact_fifty">
						<span class="cooked_label">Vitamin D </span> 
						<span class="cooked_value green">1%</span>
					</span>
				</p>

			</section>

			<section class="fact_section_4">
				<p>Percent Daily Values are based on a 2,000 calorie diet. Your daily value may be higher or lower depending on your calorie needs.</p>
			</section>
		</div>




	

		


</div>