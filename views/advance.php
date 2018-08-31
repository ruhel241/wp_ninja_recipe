<div class="ninja_advance_recipe">
	
	


	<div class="introduction-section ninjarecipe-row">
			
			<div class="ninjarecipe-col-6 ninjarecipe-padding">
				<div class="title">
					<h3>Lorem ipsum dolor sit amet.</h3>
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
				<span>20 m, 6 services, 191 cals</span>
			</div>
		</div>


		
		
			<div class="ingredient">

				<?php $totalIngredints =  count($recipeMetaData['ingredient']) / 10; ?>


				<?php  if($totalIngredints <= 1 ): ?>
					
					<ul>
						<?php foreach($recipeMetaData['ingredient'] as $ingredient):?>
							<li> <?php  echo $ingredient['ingredient']; ?>  <?php  echo $ingredient['amount']; ?> <?php  echo $ingredient['unit']; ?></li> 
						<?php endforeach; ?>
					</ul>

				<?php elseif($totalIngredints > 1): ?>

					<ul>
						<?php foreach(array_chunk($recipeMetaData['ingredient'], 6) as $ingredients):?>
							<div class="ninjarecipe-col-6">
								<?php foreach($ingredients as $ingredient): ?>
									<li> <?php  echo $ingredient['ingredient']; ?>  <?php  echo $ingredient['amount']; ?> <?php  echo $ingredient['unit']; ?></li> 
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</ul>

				<?php endif; ?>
				
			</div>

	</div>	
		



	<div class="instruction-section ninjarecipe-row">
		
		<div class="instruction-header ninjarecipe_hr">
			<h3 class="title"> Instruction </h3>
		</div>

		<div class="ninjarecipe-col-8">
			<div class="instruction">
				<ol>
					<?php foreach($recipeMetaData['description'] as $description):?>
						<li> 
							<?php  echo wp_kses_post($description['desc_text']); ?> <br/><br/>
							<!-- <?php //if($description['desc_img']):?>
									<img src="<?php //echo $description['desc_img'];?>"> <br/><br/><br/><br/>
							<?php //endif; ?> -->
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

		<div class="ninjarecipe-col-6">
			<?php include(NINJA_RECIPE_PLUGIN_DIR_PATH.'views/nutrition_facts.php');?>
		</div>	
	
	</div>



	


</div>