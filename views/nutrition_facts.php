<div class="nutrition">
	
	<?php if(isset($nutrition_text)):?>
		<h3>Nutrition: </h3>
		<p> <?php  echo $nutrition_text; ?> </p> 
	<?php endif; ?>
   		
</div>

<p> <b> Nutrition Facts: </b> 

<div class="nutritions_fact">
	<div class="cooked_nutrition">
		<h2 class="title">Nutrition Facts</h2>
		<p class="serving_size">Serving Size <span class="green">2</span> cups</p>
		
		<?php if($servingPeople): ?>
			<p class="serving_people">Servings <span class="green"> <?php echo $servingPeople;?></span></p>
		<?php endif; ?>

	</div>

	<hr class="hr_fat">
	
	<section class="fact_section_1">
		<p class="per_serving">Amount Per Serving</p>
		<strong class="cooked_label">Calories</strong> 
		<span class="cooked_value green">20</span>
		<p class="cooked_right">
			<span class="caloriesFat"> Calories from Fat </span>
			<span class="green">20</span> 
		</p>
	</section>

	<section class="fact_section_2">
		<p class="hr_thick" style="padding-bottom: 25px !important;">
		 	<span class="daily_value green"> % Daily Value * </span>
		</p>
	

		<?php  foreach ($nutrition_fields as $key => $nutitions) :?>
					
					<?php if($key == 0): ?>
						
						<?php foreach ($nutitions as $key => $nutition): ?>
								
								<?php  if($nutition['value']): ?>
									<p class="hr_thick">
										<strong class="cooked_label"><?php echo $nutition['label']; ?></strong> 
										<span class="cooked_value green"><?php echo $nutition['value']."g"; ?> </span>
										<span class="green cooked_right">8%</span> 
									</p>
								<?php endif; ?>

								<?php if (array_key_exists('children', $nutition)): ?>
									<?php foreach ($nutition['children'] as $key => $nutition_children): ?>
										<?php if($nutition_children['value']): ?>

										<p class="hr_thick" style="margin-left:15px !important; ">
											<strong class="cooked_label"><?php echo $nutition_children['label']; ?></strong> 
											<span class="cooked_value green"><?php echo $nutition_children['value']."g"?></span>
											<span class="green cooked_right">10%</span> 
										</p>

										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>

						<?php endforeach; ?> 

						 <hr style="border-bottom:solid 1em; margin: 0">

				    <?php else : ?>

				  		<?php foreach ($nutitions as $key => $nutition): ?>
				  			<?php if($nutition['value']): ?>
							  		<span class="cooked_fact_fifty" style="width: 50%; float: left; border-bottom: solid 1px;">
										<span class="cooked_label"> <?php echo $nutition['label'];?></span> 
										<span class="cooked_value green"><?php echo $nutition['value'];?>%</span>
									</span>
							<?php endif; ?>
						<?php endforeach; ?> 
						 <hr style="border-bottom:solid 1em;">

				  <?php endif; ?>

		<?php endforeach; ?>


</section>


	<section class="fact_section_4">
		<p>Percent Daily Values are based on a 2,000 calorie diet. Your daily value may be higher or lower depending on your calorie needs.</p>
	</section>
</div>
