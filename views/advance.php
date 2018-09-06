<div class="ninja_advance_recipe_<?php echo $layout; ?>">
	
	<div class="introduction-section ninjarecipe-row">
			
			<div class="ninjarecipe-col-6 ninjarecipe-padding">
				<div class="title">
					<h2><?php echo $post->post_title; ?></h2>
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
				<span class="making-time"> <?php echo $makingTime; ?> <i class="nr-clock-o"></i> </span>
				<span class="serving-people"> <?php echo $servingPeople; ?> services <i class="nr-pie-chart"> </i> </span>
				<span class="cals"> 191 cals <i class="nr-graph"></i> </span>
			</div>
		</div>


		
		
			<div class="ingredient">

				<?php $totalIngredints =  count($recipeMetaData['ingredient']) / 10; ?>


				<?php  if($totalIngredints <= 1 ): ?>
					
					<ol>
						<?php foreach($recipeMetaData['ingredient'] as $ingredient):?>
							<li> <span class="nr-check"></span><?php  echo $ingredient['ingredient']; ?>  <?php  echo $ingredient['amount']; ?> <?php  echo $ingredient['unit']; ?></li> 
						<?php endforeach; ?>
					</ol>

				<?php elseif($totalIngredints > 1): ?>

					<ol class="ninjarecipe-col-12">
						<?php foreach(array_chunk($recipeMetaData['ingredient'], 6) as $ingredients):?>
							<div class="ninjarecipe-col-3">
								<?php foreach($ingredients as $ingredient): ?>
									<li><span class="nr-check"></span> <?php  echo $ingredient['ingredient']; ?>  <?php  echo $ingredient['amount']; ?> <?php  echo $ingredient['unit']; ?></li> 
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?> 
					</ol>

				<?php endif; ?>
				
			</div>

	</div>	
		



	<div class="instruction-section ninjarecipe-row">
		
		<div class="instruction-header ninjarecipe_hr">
			<h3 class="title"> Instruction </h3>
		</div>

		<div class="ninjarecipe-col-12">
			<div class="instruction">
				<ol>
					<?php foreach($recipeMetaData['description'] as $description):?>
						<li> 
							<div class="instruction-des">
								<?php  echo wp_kses_post($description['desc_text']); ?> 
							</div>
							<?php if($description['desc_img']):?>
								   <div class="instruction-img">
								   		<img src="<?php echo $description['desc_img'];?>"> 
								   </div>
							<?php endif; ?> 
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		
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