<?php

function write_hypertension($type, $mysqli) {
	
	//TODO: What date did the screening occur?
	
	$inversions1 = array(false, false, false, false, true, true, true, true, false, true, true, true, true, true, false, false, false, false);
	$ids1 = array("HT_Med_1", "HT_Med_2", "HT_Med_3", "HT_Diet_1", "HT_Diet_2", "HT_Diet_3", "HT_Diet_4", "HT_Diet_5", "HT_Diet_6", "HT_Diet_7", "HT_Diet_8", "HT_Diet_9", "HT_Diet_10", "HT_Diet_11", "HT_Diet_12", "HT_Phys_1", "HT_Phys_2", "HT_Smoke_1");
	$questions_bank1 = array(
		"How many of the past 7 days did you take your blood pressure pills?",
		"How many of the past 7 days did you take your blood pressure pills at the same time every day?",
		"How many of the past 7 days did you take the recommended number of blood pressure pills?",
		"How many of the past 7 days did you follow a healthy eating plan?",
		"How many of the past 7 days did you eat potato chips, salted nuts, or salted popcorn?",
		"How many of the past 7 days did you eat processed meats such as ham, bacon, bologna, or sausage?",
		"How many of the past 7 days did you eat smoked meats or smoked fish?",
		"How many of the past 7 days did you eat pickles, olives, or other vegetables in brine?",
		"How many of the past 7 days did you eat 5 or more servings of fruits and vegetables?",
		"How many of the past 7 days did you eat frozen prepared dinners or frozen pizza?",
		"How many of the past 7 days did you eat store bought or packaged bakery goods?",
		"How many of the past 7 days did you salt your food at the table?",
		"How many of the past 7 days did you add salt to food when you're cooking?",
		"How many of the past 7 days did you eat fried foods such as chicken, french fries, or fish?",
		"How many of the past 7 days did you avoid eating fatty foods?",
		"How many of the past 7 days did you do at least 30 minutes total of physical activity?",
		"How many of the past 7 days did you do a specific exercise activity (such as swimming, walking, or biking) other than what you do around the house or as part of your work?",
		"How many of the past 7 days did you smoke a cigarette or cigar, even just one puff?"
	);

	$ids2 = array("HT_Wt_1", "HT_Wt_2", "HT_Wt_3", "HT_Wt_4", "HT_Wt_5", "HT_Wt_6", "HT_Wt_7", "HT_Wt_8", "HT_Wt_9", "HT_Wt_10");
	$questions_bank2 = array(
		"In order to lose weight or maintain my weight, I am careful about what I eat.",
		"In order to lose weight or maintain my weight, I read food labels when I grocery shop.",
		"In order to lose weight or maintain my weight, I exercise.",
		"In order to lose weight or maintain my weight, I have cut out drinking sugary sodas and sweet tea.",
		"In order to lose weight or maintain my weight, I eat smaller portions or eat fewer portions.",
		"In order to lose weight or maintain my weight, I have stopped buying or bringing unhealthy foods into my home.",
		"In order to lose weight or maintain my weight, I have cut out or limited some foods that I like but that are not good for me.",
		"In order to lose weight or maintain my weight, I eat at restaurants or fast food places less often.",
		"In order to lose weight or maintain my weight, I substitute healthier foods for things that I used to eat.",
		"In order to lose weight or maintain my weight, I have modified my recipes when I cook."
	);
	
	$ids3 = array("HT_Alc_1");
	$questions_bank3 = array(
		"On average, how many days per week do you drink alcohol?"
	);
	
	$ids4 = array("HT_Alc_2", "HT_Alc_3");
	$questions_bank4 = array(
		"On a typical day that you drink alcohol, how many drinks do you have?",
		"What is the largest number of drinks that you've had on any given day within the last month?"
	);
	
	############################################################################
	############################################################################
	############################################################################
	
	$daysPerWeekStart = '
		<table id=\"hypertension_questions\" border=\"1\">
			<tr>
				<td class="hypertension_scale_pad"></td>
				<td class="hypertension_scale"><center>0</center></td>
				<td class="hypertension_scale"><center>1</center></td>
				<td class="hypertension_scale"><center>2</center></td>
				<td class="hypertension_scale"><center>3</center></td>
				<td class="hypertension_scale"><center>4</center></td>
				<td class="hypertension_scale"><center>5</center></td>
				<td class="hypertension_scale"><center>6</center></td>
				<td class="hypertension_scale"><center>7</center></td>
			</tr>
	';
	$daysPerWeekEnd = '
		</table>
	';
	
	$agreementScaleStart = '
		<table id=\"hypertension_questions\" border=\"1\">
			<tr>
				<td class="hypertension_scale_pad"></td>
				<td class="hypertension_scale"><center>Strongly Disagree</center></td>
				<td class="hypertension_scale"><center>Disagree</center></td>
				<td class="hypertension_scale"><center>Neutral</center></td>
				<td class="hypertension_scale"><center>Agree</center></td>
				<td class="hypertension_scale"><center>Strongly Agree</center></td>
			</tr>
	';
	$agreementScaleEnd = '
		</table>
	';
	
	$drinksPerWeekStart = '
		<table id=\"hypertension_questions\" border=\"1\">
			<tr>
				<td class="hypertension_scale_pad"></td>
				<td class="hypertension_scale"><center>0-1</center></td>
				<td class="hypertension_scale"><center>2-3</center></td>
				<td class="hypertension_scale"><center>4-5</center></td>
				<td class="hypertension_scale"><center>6-8</center></td>
				<td class="hypertension_scale"><center>8-9</center></td>
				<td class="hypertension_scale"><center>10+</center></td>
			</tr>
	';
	$drinksPerWeekEnd = '
		</table>
	';
	
	############################################################################
	############################################################################
	############################################################################
	
	// Begin Div
	echo '<br><hr><div id="hypertension_section"><center><h3>Hypertension Screening</h3></center>';
	
	// Section 1
	echo $daysPerWeekStart;
	foreach($questions_bank1 as $id=>$question) {
		if($inversions1[$id]) {
			$fieldValues = range(7, 0);
		} else {
			$fieldValues = range(0, 7);
		}
		
		echo strtr('
			<tr class="hypertension_row" style="background-color: #EFFBFB;">
				<td class="hypertension_question">{$id}: {$question}</td>
				<td class="hypertension_response" id="{$field}-0"><center><input type="radio" name="{$field}" value="{$value_0}" /></center></td>
				<td class="hypertension_response" id="{$field}-1"><center><input type="radio" name="{$field}" value="{$value_1}" /></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><input type="radio" name="{$field}" value="{$value_2}" /></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><input type="radio" name="{$field}" value="{$value_3}" /></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><input type="radio" name="{$field}" value="{$value_4}" /></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><input type="radio" name="{$field}" value="{$value_5}" /></center></td>
				<td class="hypertension_response" id="{$field}-6"><center><input type="radio" name="{$field}" value="{$value_6}" /></center></td>
				<td class="hypertension_response" id="{$field}-7"><center><input type="radio" name="{$field}" value="{$value_7}" /></center></td>
			</tr>
		', array(
			'{$id}' => $id + 2,
			'{$field}' => $ids1[$id],
			'{$question}' => $question,
			'{$value_0}' => $fieldValues[0],
			'{$value_1}' => $fieldValues[1],
			'{$value_2}' => $fieldValues[2],
			'{$value_3}' => $fieldValues[3],
			'{$value_4}' => $fieldValues[4],
			'{$value_5}' => $fieldValues[5],
			'{$value_6}' => $fieldValues[6],
			'{$value_7}' => $fieldValues[7],
		));
	}
	echo $daysPerWeekEnd;
	
	// Section 2
	echo $agreementScaleStart;
	foreach($questions_bank2 as $id=>$question) {
		echo strtr('
			<tr class="hypertension_row" style="background-color: #EFFBFB;">
				<td class="hypertension_question">{$id}: {$question}</td>
				<td class="hypertension_response" id="{$field}-1"><center><input type="radio" name="{$field}" value="1" /></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><input type="radio" name="{$field}" value="2" /></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><input type="radio" name="{$field}" value="3" /></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><input type="radio" name="{$field}" value="4" /></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><input type="radio" name="{$field}" value="5" /></center></td>
			</tr>
		', array(
			'{$id}' => $id + 20,
			'{$field}' => $ids2[$id],
			'{$question}' => $question
		));
	}
	echo $agreementScaleEnd;
	
	// Section 3
	echo $daysPerWeekStart;
	foreach($questions_bank3 as $id=>$question) {
		echo strtr('
			<tr class="hypertension_row" style="background-color: #EFFBFB;">
				<td class="hypertension_question">{$id}: {$question}</td>
				<td class="hypertension_response" id="{$field}-0"><center><input type="radio" name="{$field}" value="0" /></center></td>
				<td class="hypertension_response" id="{$field}-1"><center><input type="radio" name="{$field}" value="1" /></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><input type="radio" name="{$field}" value="2" /></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><input type="radio" name="{$field}" value="3" /></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><input type="radio" name="{$field}" value="4" /></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><input type="radio" name="{$field}" value="5" /></center></td>
				<td class="hypertension_response" id="{$field}-6"><center><input type="radio" name="{$field}" value="6" /></center></td>
				<td class="hypertension_response" id="{$field}-7"><center><input type="radio" name="{$field}" value="7" /></center></td>
			</tr>
		', array(
			'{$id}' => $id + 30,
			'{$field}' => $ids3[$id],
			'{$question}' => $question
		));
	}
	echo $daysPerWeekEnd;
	
	// Section 4
	echo $drinksPerWeekStart;
	foreach($questions_bank4 as $id=>$question) {
		echo strtr('
			<tr class="hypertension_row" style="background-color: #EFFBFB;">
				<td class="hypertension_question">{$id}: {$question}</td>
				<td class="hypertension_response" id="{$field}-0"><center><input type="radio" name="{$field}" value="0" /></center></td>
				<td class="hypertension_response" id="{$field}-1"><center><input type="radio" name="{$field}" value="2" /></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><input type="radio" name="{$field}" value="4" /></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><input type="radio" name="{$field}" value="6" /></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><input type="radio" name="{$field}" value="8" /></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><input type="radio" name="{$field}" value="10" /></center></td>
			</tr>
		', array(
			'{$id}' => $id + 31,
			'{$field}' => $ids4[$id],
			'{$question}' => $question
		));
	}
	echo $drinksPerWeekEnd;
	
	// End Div
	echo '</div>';
}

function hypertension_scoring($copy, $mysqli) {
	if ($mysqli->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}
	
	$inversions1 = array(false, false, false, false, true, true, true, true, false, true, true, true, true, true, false, false, false, false);
	$ids1 = array("HT_Med_1", "HT_Med_2", "HT_Med_3", "HT_Diet_1", "HT_Diet_2", "HT_Diet_3", "HT_Diet_4", "HT_Diet_5", "HT_Diet_6", "HT_Diet_7", "HT_Diet_8", "HT_Diet_9", "HT_Diet_10", "HT_Diet_11", "HT_Diet_12", "HT_Phys_1", "HT_Phys_2", "HT_Smoke_1");
	$questions_bank1 = array(
			"How many of the past 7 days did you take your blood pressure pills?",
			"How many of the past 7 days did you take your blood pressure pills at the same time every day?",
			"How many of the past 7 days did you take the recommended number of blood pressure pills?",
			"How many of the past 7 days did you follow a healthy eating plan?",
			"How many of the past 7 days did you eat potato chips, salted nuts, or salted popcorn?",
			"How many of the past 7 days did you eat processed meats such as ham, bacon, bologna, or sausage?",
			"How many of the past 7 days did you eat smoked meats or smoked fish?",
			"How many of the past 7 days did you eat pickles, olives, or other vegetables in brine?",
			"How many of the past 7 days did you eat 5 or more servings of fruits and vegetables?",
			"How many of the past 7 days did you eat frozen prepared dinners or frozen pizza?",
			"How many of the past 7 days did you eat store bought or packaged bakery goods?",
			"How many of the past 7 days did you salt your food at the table?",
			"How many of the past 7 days did you add salt to food when you're cooking?",
			"How many of the past 7 days did you eat fried foods such as chicken, french fries, or fish?",
			"How many of the past 7 days did you avoid eating fatty foods?",
			"How many of the past 7 days did you do at least 30 minutes total of physical activity?",
			"How many of the past 7 days did you do a specific exercise activity (such as swimming, walking, or biking) other than what you do around the house or as part of your work?",
			"How many of the past 7 days did you smoke a cigarette or cigar, even just one puff?"
	);
	
	$ids2 = array("HT_Wt_1", "HT_Wt_2", "HT_Wt_3", "HT_Wt_4", "HT_Wt_5", "HT_Wt_6", "HT_Wt_7", "HT_Wt_8", "HT_Wt_9", "HT_Wt_10");
	$questions_bank2 = array(
			"In order to lose weight or maintain my weight, I am careful about what I eat.",
			"In order to lose weight or maintain my weight, I read food labels when I grocery shop.",
			"In order to lose weight or maintain my weight, I exercise.",
			"In order to lose weight or maintain my weight, I have cut out drinking sugary sodas and sweet tea.",
			"In order to lose weight or maintain my weight, I eat smaller portions or eat fewer portions.",
			"In order to lose weight or maintain my weight, I have stopped buying or bringing unhealthy foods into my home.",
			"In order to lose weight or maintain my weight, I have cut out or limited some foods that I like but that are not good for me.",
			"In order to lose weight or maintain my weight, I eat at restaurants or fast food places less often.",
			"In order to lose weight or maintain my weight, I substitute healthier foods for things that I used to eat.",
			"In order to lose weight or maintain my weight, I have modified my recipes when I cook."
	);
	
	$ids3 = array("HT_Alc_1");
	$questions_bank3 = array(
			"On average, how many days per week do you drink alcohol?"
	);
	
	$ids4 = array("HT_Alc_2", "HT_Alc_3");
	$questions_bank4 = array(
			"On a typical day that you drink alcohol, how many drinks do you have?",
			"What is the largest number of drinks that you've had on any given day within the last month?"
	);
	
	echo '
		<br/>
		<center>
			<h3>Hypertension Assessment (H-SCALE)</h3>
		</center>
		<table border="1">
			<tr>
				<td>Question</td>
				<td>Result</tb>
			</tr>
	';
	
	// Bank 1
	// TODO: Inverted scoring?
	foreach($ids1 as $index=>$id) {
		if($inversions1[$index]) {
			$answer = 7-$copy[$id]; // This reverses the number on a 0-7 scale to return what was given 
		} else {
			$answer = $copy[$id];
		}
		
		echo strtr('
			<tr>
				<td>{$question}</td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank1[$index],
			'{$answer}' => $answer
		));
	}
	
	// Bank 2
	foreach($ids2 as $index=>$id) {
		echo strtr('
			<tr>
				<td>{$question}</td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank2[$index],
			'{$answer}' => $copy[$id]
		));
	}
	
	// Bank 3
	foreach($ids3 as $index=>$id) {
		echo strtr('
			<tr>
				<td>{$question}</td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank3[$index],
			'{$answer}' => $copy[$id]
		));
	}
	
	// Bank 4
	foreach($ids4 as $index=>$id) {
		echo strtr('
			<tr>
				<td>{$question}</td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank4[$index],
			'{$answer}' => $copy[$id]
		));
	}
	
	
	echo '</table>';
}

?>
