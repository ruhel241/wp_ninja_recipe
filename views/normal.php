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



		<div class="nutritions" style="border: 1px solid;">
			
			<h2>Nutrition Facts</h2>
			<p>Serving Size 2 cups</p>
			<p>Servings 6</p>

			<hr class="recipe-nutrition-hr" style="border: none; border-top: 1rem solid #333; margin: 1rem 0 0; padding: 0">

			<div>
				<p class="cooked-heading">Amount per serving</p>
				<hr>
				<div class="cooked-clearfix">
					<strong>Calories</strong>
					<strong class="cooked-nut-label" font-weight="400">100</strong>
				</div>
				<div class="ninja-recipe-spacer" style="border: none; height: 0.5rem; padding: 0; background: #333;"></div>
				<div class="ninja-recipe-nut">
					<div>
						<strong>Total Fat</strong>
						<strong class="cooked-nut-label" font-weight="400">5</strong>
						<strong style="float: right;">
							<span>8%</span>
						</strong>
					</div>
				</div>
			</div>

		</div>







	

		


</div>