<?php

	$serial = array();

	foreach ($nutrition_fields as $nutrition_field) {

		foreach ($nutrition_field as $nutrition) {

			 $serial = $nutrition['serial'];

			if($serial == 0){
				$calories = $nutrition['label'];
				$caloriesValue = $nutrition['value'];
			}

			if($serial == 1){
				$caloriesFat = $nutrition['label'];
				$caloriesFatValue = $nutrition['value'];
			}
			
			if($serial == 2){
				$totalFat = $nutrition['label'];
				$totalFatValue = $nutrition['value'];
			}

			if($serial == 3){
				$saturatedFat = $nutrition['label'];
				$saturatedFatValue = $nutrition['value'];
			}

			if($serial == 4){
				$transFat = $nutrition['label'];
				$transFatValue = $nutrition['value'];
			}

			if($serial == 5){
				$cholesterol = $nutrition['label'];
				$cholesterolValue = $nutrition['value'];
			}

			if($serial == 6){
				$sodium = $nutrition['label'];
				$sodiumValue = $nutrition['value'];
			}

			if($serial == 7){
				$potassium = $nutrition['label'];
				$potassiumValue = $nutrition['value'];
			}

			if($serial == 8){
				$totalCarbohydrate = $nutrition['label'];
				$totalCarbohydrateValue = $nutrition['value'];
			}
			
			if($serial == 9){
				$dietaryFiber = $nutrition['label'];
				$dietaryFiberValue = $nutrition['value'];
			}
			if($serial == 10){
				$sugars = $nutrition['label'];
				$sugarsValue = $nutrition['value'];
			}
			if($serial == 11){
				$potein = $nutrition['label'];
				$poteinValue = $nutrition['value'];
			}

			if($serial == 12){
				$vitaminA = $nutrition['label'];
				$vitaminAValue = $nutrition['value'];
			}
			if($serial == 13){
				$vitaminC = $nutrition['label'];
				$vitaminCValue = $nutrition['value'];
			}
			if($serial == 14){
				$vitaminD = $nutrition['label'];
				$vitaminDValue = $nutrition['value'];
			}

		    if($serial == 19){
				$calcium = $nutrition['label'];
				$calciumValue = $nutrition['value'];
			}
			if($serial == 20){
				$iron = $nutrition['label'];
				$ironValue = $nutrition['value'];
			}
			

		}
	}


	function recursivePrint($data)
	{
		foreach ($data as $key => $value) {
			if (array_key_exists('children', $value)) {
				resursivePrint($value);
			} else {
				echo ''
			}
		}
	}

	recursivePrint($nutrition_fields);




// function array_values_recursive($array) {
//   $flat = array();

//   foreach($array as $value) {
//     if (is_array($value)) {
//         $flat = array_merge($flat, array_values_recursive($value));
//     }
//     else {
//         $flat[] = $value;
//     }
//   }
//   return $flat;
// }









	



