<div class="nutrition">
	
	<?php if(isset($nutrition_text)):?>
		<h3>Nutrition: </h3>
		<p> <?php  echo $nutrition_text; ?> </p> 
	<?php endif; ?>
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
		<?php if(isset($servingProple)):?>
			<p class="serving_people">Servings <span class="green"><?php echo $servingProple; ?></span></p>
		<?php endif;?>
	</div>

	<hr class="hr_fat">
	
	<section class="fact_section_1">
		<p class="per_serving">Amount Per Serving</p>
		<?php if( isset($caloriesValue) ): ?>
			<strong class="cooked_label"><?php echo $calories;?></strong> 
			<span class="cooked_value green"><?php echo $caloriesValue;?></span>
		<?php endif; ?>
		
		<?php if( isset($caloriesFatValue) ): ?>
			<p class="cooked_right">
				<span class="caloriesFat"><?php echo $caloriesFat; ?></span>
				<span class="green"> <?php echo $caloriesFatValue; ?></span> 
			</p>
		<?php endif; ?>
	</section>

	<section class="fact_section_2">
		<p class="hr_thick" style="padding-bottom: 25px !important;">
		 	<span class="daily_value green"> % Daily Value * </span>
		</p>
	

		<?php if( isset($totalFatValue) ): ?>
			<p class="hr_thick">
				<strong class="cooked_label"><?php echo $totalFat; ?></strong> 
				<span class="cooked_value green"><?php echo $totalFatValue;?>g</span>
				<span class="green cooked_right">8%</span> 
			</p>
		<?php endif; ?>
		
		<?php if( isset($saturatedFatValue) ): ?>
			<p class="hr_thick" style="margin-left:15px !important; ">
				<strong class="cooked_label"><?php echo $saturatedFat; ?></strong> 
				<span class="cooked_value green"><?php echo $saturatedFatValue;?>g</span>
				<span class="green cooked_right">10%</span> 
			</p>
		<?php endif; ?>

		<?php if(isset($transFatValue)): ?>
		<p class="hr_thick" style="padding-left:15px; ">
			<strong class="cooked_label"><?php echo $transFat; ?></strong> 
			<span class="cooked_value green"><?php echo $transFatValue?>g</span>
			<span class="green cooked_right"></span> 
		</p>
	    <?php endif; ?>

	    <?php if(isset($cholesterolValue)): ?>
		<p class="hr_thick">
			<strong class="cooked_label"><?php echo $cholesterol?></strong> 
			<span class="cooked_value green"><?php echo $cholesterolValue?>mg</span>
			<span class="green cooked_right">45%</span> 
		</p>
		<?php endif; ?>

		<?php if(isset($sodiumValue)): ?>
			<p class="hr_thick">
				<strong class="cooked_label"><?php echo $sodium; ?></strong> 
				<span class="cooked_value green"><?php echo $sodiumValue;?>mg</span>
				<span class="green cooked_right">2%</span> 
			</p>
		<?php endif; ?>

		<?php if(isset($potassiumValue)):?>
			<p class="hr_thick">
				<strong class="cooked_label"><?php echo $potassium;?></strong> 
				<span class="cooked_value green"><?php echo $potassiumValue;?>mg</span>
				<span class="green cooked_right">0%</span> 
			</p>
		<?php endif; ?>

		<?php if(isset($totalCarbohydrateValue)):?>
			<p class="hr_thick">
				<strong class="cooked_label"><?php echo $totalCarbohydrate; ?></strong> 
				<span class="cooked_value green"><?php echo $totalCarbohydrateValue;?>g</span>
				<span class="green cooked_right">3%</span> 
			</p>
	    <?php endif; ?>

	    <?php if(isset($dietaryFiberValue)): ?>
			<p class="hr_thick" style="margin-left:15px !important;">
				<strong class="cooked_label"><?php echo $dietaryFiber; ?></strong> 
				<span class="cooked_value green"><?php echo $dietaryFiberValue;?>g</span>
				<span class="green cooked_right">16%</span> 
			</p>
		<?php endif; ?>
		
		<?php if(isset($sugarsValue)): ?>
			<p class="hr_thick" style="padding-left:15px;">
				<strong class="cooked_label"><?php echo $sugars; ?></strong> 
				<span class="cooked_value green"><?php echo $sugarsValue;?>g</span>
				<span class="green cooked_right"></span> 
			</p>
		<?php endif; ?>
		
		<?php if(isset($poteinValue)): ?>
			<p class="">
				<strong class="cooked_label"><?php echo $potein;?></strong> 
				<span class="cooked_value green"><?php echo $poteinValue;?>g</span>
				<span class="green cooked_right">20%</span> 
			</p>
		<?php endif; ?>

	</section>

	<section class="fact_section_3">

		<?php if( isset($vitaminAValue) ) :?>
			<p class="hr_thick">
			<?php  if(isset($vitaminAValue)): ?>
				<span class="cooked_fact_fifty">
					<span class="cooked_label"> <?php echo $vitaminA; ?></span> 
					<span class="cooked_value green"><?php echo $vitaminAValue?>%</span>
				</span>
			<?php endif; ?>

			<?php if(isset($vitaminCValue)):  ?>
				<span>
					<span class="cooked_label"> <?php echo $vitaminC; ?> </span> 
					<span class="cooked_value green"><?php echo $vitaminCValue?>%</span>
				</span>
			<?php endif; ?>
			</p>
	    <?php endif;?>

		
			<p class="hr_thick">
				<?php  if(isset($calciumValue)): ?>
					<span class="cooked_fact_fifty">
						<span class="cooked_label"><?php echo $calcium; ?></span> 
						<span class="cooked_value green"><?php echo $calciumValue; ?>%</span>
					</span>
				<?php endif; ?>
				<?php  if(isset($ironValue)): ?>
					<span>
						<span class="cooked_label"><?php echo $iron?></span> 
						<span class="cooked_value green"><?php echo $ironValue; ?>%</span>
					</span>
				 <?php endif; ?>
			</p>
		

	
			<p class="hr_thick">
				<span class="cooked_fact_fifty">
					<span class="cooked_label"> <?php echo $vitaminD; ?></span> 
					<span class="cooked_value green"><?php echo $vitaminDValue; ?>%</span>
				</span>
			</p>
		

	</section>

	<section class="fact_section_4">
		<p>Percent Daily Values are based on a 2,000 calorie diet. Your daily value may be higher or lower depending on your calorie needs.</p>
	</section>
</div>
