<div class="">
	
	<h1> <?php echo $post->post_title; ?> </h1>

	<h3> <?php echo $post->post_content; ?> </h3>

	
	<p> <b>Introduction: </b> <br><?php  echo $recipeMetaData['introduction']; ?> </p> <br><br>


	<p> <b>Ingredient: </b> <br><?php  echo $recipeMetaData['ingredient']; ?> </p> <br><br>


	<p> <b>Description: </b> <br><?php  echo $recipeMetaData['description']; ?> </p> <br><br>


	<p> <b>FeaturedImage: </b> <br> <img src="<?php  echo $recipeMetaData['featuredImage']; ?>"> </p> <br><br>	




	<p> <b>MealType: </b> <br>
		<?php foreach($recipeMetaData['mealType'] as $mealTypeitem): ?>
			 <?php  echo $mealTypeitem;?> 
		<?php endforeach; ?>
	</p> <br><br>




	<p> <b>CusineType: </b> <br> <?php  echo $recipeMetaData['cusineType']; ?> </p> <br><br>

	<p> <b>PreferenceType: </b> <br> <?php  echo $recipeMetaData['preferenceType']; ?> </p> <br><br>


	<p> <b>TotalPeople: </b> <br> <?php  echo $recipeMetaData['totalPeople']; ?> </p> <br><br>

	<p> <b>MakingTime: </b> <br> <?php  echo $recipeMetaData['makingTime']; ?> </p> <br><br>



	<p> <b>Nutrition: </b> <br> <?php  echo $recipeMetaData['nutrition']['nutrition_text']; ?> </p> <br><br>



		<p> <b>Nutrition Fields: </b> <br> 



		<?php foreach ($nutrition_fields as $nutrition_field) : ?>
				<?php foreach($nutrition_field as $key => $nutrition ):?>
					<p> <?php echo $key .'=>'. $nutrition['label']; ?></p>

				<?php endforeach; ?>
		<?php endforeach; ?>
			
		





	</p> <br><br>

			



	


	

	<img src="<?php echo $recipeMetaData->tableConfig->featuredImage?>">


</div>