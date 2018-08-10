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
			<span class="serving_people"> Serving People:  <?php  echo $servingPeople; ?> </span>
		</div>


		<div class="meal_type"> 
			<h2> Meal Type: </h2> 
			<?php echo implode(', ', $recipeMetaData['mealType']); ?>
			
		</div>

		<div class="cusine_type"> 
			<h2> Cusine Type: </h2> 
			<?php echo $recipeMetaData['cusineType']; ?>
		</div>

		<div class="preference_type"> 
			<h2> Preference Type: </h2> 
				<?php echo $recipeMetaData['preferenceType']; ?>
		</div>



		<div class="ingredient">
			<h3>Ingredient: </h3>
			<p> <?php  echo $recipeMetaData['ingredient']; ?> </p> 
		</div>


		<div class="Instruction">
			<h3>Instruction: </h3>
			<p> <?php  echo $recipeMetaData['description']; ?> </p> 
		</div>
		

		<!-- Nutrition Facts -->

		<?php include(NINJA_RECIPE_PLUGIN_DIR_PATH.'views/nutrition_facts.php');?>

</div>