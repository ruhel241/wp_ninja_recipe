<?php

	

	foreach ($nutrition_fields as $key => $nutitions) {
			echo  $key ."<br/>";
		
			foreach ($nutitions as $key => $nutition) {

					if($nutition['value']){
						echo  "<pre>". $key ."=>". $nutition['label'] ."=>". $nutition['value'] ."</pre>";
					}
				

					if (array_key_exists('children', $nutition)) {
						foreach ($nutition['children'] as $key => $nutition_children) {
							if($nutition_children['value']){
								echo "Children:".  $nutition_children['label'] .'=>'. $nutition_children['value'].  "<br/>";
							}
							
						}
					}

			}
	}



