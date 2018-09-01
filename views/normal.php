<div class="ninja_normal_recipe">
	
	<div class="introduction-section ninjarecipe-row">
			<div class="ninjarecipe-col-6 ninjarecipe-padding">
				<div class="title">
					<h3><?php echo $post->post_title; ?></h3>
				</div>

				<div class="content">
					<?php  echo wp_kses_post($recipeMetaData['introduction']); ?>
				</div>
			</div>	

			<div class="ninjarecipe-col-6 ninjarecipe-padding">
				<div class="feature-image">
					<img src="<?php echo $recipeMetaData['featuredImage']; ?>">
				</div>

			</div>	
	</div>




	<div class="ingredients-section ninjarecipe-row">
		
		<div class="ingredients-header ninjarecipe_hr">
			<div class="ing">
				<h3 class="title"> Ingredients</h3>
			</div>
			
			<div class="service-section"> 
				<span> <?php echo $makingTime; ?> m <i class="nr-clock-o"></i> </span>
				<span> <?php echo $servingPeople; ?> services <i class="nr-pie-chart"> </i> </span>
				<span> 191 cals <i class="nr-graph"></i> </span>
			</div>
		</div>

		<div class="ingredient">		
			Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore obcaecati nostrum error nulla earum quos facere vitae beatae in itaque quo aliquid aspernatur, consectetur at eum. Facere excepturi debitis esse.				
		</div>

	</div>	
		



	<div class="instruction-section ninjarecipe-row">
		
		<div class="instruction-header ninjarecipe_hr">
			<h3 class="title"> Instruction </h3>
		</div>

		<div class="instruction">
			<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi, consectetur aperiam dolor sequi rem incidunt. Officiis aut repellendus assumenda minima, neque voluptatibus fugit consectetur maxime deserunt omnis aspernatur molestiae est!</p>
		</div>
		
	</div>

	

	<div class="nutritionFact-section ninjarecipe-row">
		<div class="nutritionFact-header ninjarecipe_hr">
			<h3 class="title"> Nutrition Facts </h3>
		</div>
		
		<div class="ninjarecipe-col-12">
			<div class="nutrition">
				<?php if(isset($nutrition_text)):?>
					<?php  echo wp_kses_post($nutrition_text); ?>
				<?php endif; ?>

				<?php if($showNutrition_Fields == true ):?>
					<a style="cursor: pointer" class="full-nutrition"> Full Nutrition</a>
				<?php endif; ?>
			</div>
		</div>	

		<?php include(NINJA_RECIPE_PLUGIN_DIR_PATH.'views/nutrition_facts.php');?>
	
	</div>



	


</div>