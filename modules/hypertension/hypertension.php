<?php

function write_hypertension($type, $mysqli) {
	
	//TODO: What date did the screening occur?
	
	$ids1 = array("HT_Med_1", "HT_Med_2", "HT_Med_3", "HT_Diet_1", "HT_Diet_2", "HT_Diet_3", "HT_Diet_4", "HT_Diet_5", "HT_Diet_6", "HT_Diet_7", "HT_Diet_8", "HT_Diet_9", "HT_Diet_10", "HT_Diet_11", "HT_Diet_12", "HT_Phys_1", "HT_Phys_2", "HT_Smoke_1");
	$qb1_criteria_prefix = "How many of the past 7 days did you ";
	$questions_bank1 = array(
		"Take your blood pressure pills?",
		"Take your blood pressure pills at the same time every day?",
		"Take the recommended number of blood pressure pills?",
		"Follow a healthy eating plan?",
		"Eat potato chips, salted nuts, or salted popcorn?",
		"Eat processed meats such as ham, bacon, bologna, or sausage?",
		"Eat smoked meats or smoked fish?",
		"Eat pickles, olives, or other vegetables in brine?",
		"Eat 5 or more servings of fruits and vegetables?",
		"Eat frozen prepared dinners or frozen pizza?",
		"Eat store bought or packaged bakery goods?",
		"Salt your food at the table?",
		"Add salt to food when you're cooking?",
		"Eat fried foods such as chicken, french fries, or fish?",
		"Avoid eating fatty foods?",
		"Do at least 30 minutes total of physical activity?",
		"Do a specific exercise activity (such as swimming, walking, or biking) other than what you do around the house or as part of your work?",
		"Smoke a cigarette or cigar, even just one puff?"
	);

	$ids2 = array("HT_Wt_1", "HT_Wt_2", "HT_Wt_3", "HT_Wt_4", "HT_Wt_5", "HT_Wt_6", "HT_Wt_7", "HT_Wt_8", "HT_Wt_9", "HT_Wt_10");
	$qb2_criteria_prefix = "In order to lose weight or maintain my weight, ";
	$questions_bank2 = array(
		"I am careful about what I eat.",
		"I read food labels when I grocery shop.",
		"I exercise.",
		"I have cut out drinking sugary sodas and sweet tea.",
		"I eat smaller portions or eat fewer portions.",
		"I have stopped buying or bringing unhealthy foods into my home.",
		"I have cut out or limited some foods that I like but that are not good for me.",
		"I eat at restaurants or fast food places less often.",
		"I substitute healthier foods for things that I used to eat.",
		"I have modified my recipes when I cook."
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
		<table id="hypertension_questions1" border="1" width="100%">
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
		<table id="hypertension_questions2" border="1" width="100%">
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
		<table id="hypertension_questions3" border="1" width="100%">
			<tr>
				<td class="hypertension_scale_pad"></td>
				<td class="hypertension_scale"><center>0 - 1</center></td>
				<td class="hypertension_scale"><center>2 - 3</center></td>
				<td class="hypertension_scale"><center>4 - 5</center></td>
				<td class="hypertension_scale"><center>6 - 8</center></td>
				<td class="hypertension_scale"><center>8 - 9</center></td>
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
	echo '<br><hr><div id="hypertension_section"><h3>Hypertension - Self-care Activity Level Effects (H-SCALE)</h3>';
	// Section 1
	echo "<center><strong>Medications Usage, Low-salt Diet, Physical Activity and Smoking</strong><br /><br />
	Questions 1 - 18 should be prefaced with<br /><div class='question_criteria'>". $qb1_criteria_prefix . "...</div></center><br />";
	echo $daysPerWeekStart;
	foreach($questions_bank1 as $id=>$question) {		
		echo strtr('
			<tr class="hypertension_row">
				<td class="hypertension_question"><ol start="{$id}"><li>{$question}</li></ol></td>
				<td class="hypertension_response" id="{$field}-0"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="0" /><br />0</label></center></td>
				<td class="hypertension_response" id="{$field}-1"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="1" /><br />1</label></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="2" /><br />2</label></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="3" /><br />3</label></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="4" /><br />4</label></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="5" /><br />5</label></center></td>
				<td class="hypertension_response" id="{$field}-6"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="6" /><br />6</label></center></td>
				<td class="hypertension_response" id="{$field}-7"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="7" /><br />7</label></center></td>
			</tr>
		', array(
			'{$id}' => $id + 1,
			'{$field}' => $ids1[$id],
			'{$question}' => $question
		));
		$_SESSION[$ids1[$id]] = 99;
	}
	echo $daysPerWeekEnd;
	
	// Section 2
	echo "<br /><br /><center><strong>Weight Management</strong><br /><br />
	Questions 19 - 28 should be prefaced with<br /><div class='question_criteria'>". $qb2_criteria_prefix . "</div></center><br />";
	echo $agreementScaleStart;
	foreach($questions_bank2 as $id=>$question) {
		echo strtr('
			<tr class="hypertension_row">
				<td class="hypertension_question"><ol start="{$id}"><li>{$question}</li></ol></td>
				<td class="hypertension_response" id="{$field}-1"><center><label class="radio_caption">Strongly<br /><input type="radio" name="{$field}" value="1" /><br />Disagree</label></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="2" /><br />Disagree</label></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="3" /><br />Neutral</label></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="4" /><br />Agree</label></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><label class="radio_caption">Strongly<br /><input type="radio" name="{$field}" value="5" /><br /><span>Agree</label></center></td>
			</tr>
		', array(
			'{$id}' => $id + 19,
			'{$field}' => $ids2[$id],
			'{$question}' => $question
		));
		$_SESSION[$ids2[$id]] = 99;
	}
	echo $agreementScaleEnd;
	
	// Section 3
	echo "<br /><br />";
	echo "<center><strong>Alcohol</strong></center><br /><br />";
	echo $daysPerWeekStart;
	foreach($questions_bank3 as $id=>$question) {
		echo strtr('
			<tr class="hypertension_row">
				<td class="hypertension_question"><ol start="{$id}"><li>{$question}</li></ol></td>
				<td class="hypertension_response" id="{$field}-0"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="0" /><br />0</label></center></td>
				<td class="hypertension_response" id="{$field}-1"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="1" /><br />1</label></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="2" /><br />2</label></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="3" /><br />3</label></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="4" /><br />4</label></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="5" /><br />5</label></center></td>
				<td class="hypertension_response" id="{$field}-6"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="6" /><br />6</label></center></td>
				<td class="hypertension_response" id="{$field}-7"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="7" /><br />7</label></center></td>
			</tr>
		', array(
			'{$id}' => $id + 29,
			'{$field}' => $ids3[$id],
			'{$question}' => $question
		));
		$_SESSION[$ids3[$id]] = 99;
	}
	echo $daysPerWeekEnd;
	
	// Section 4
	echo "<br /><br />";
	echo "A <em>drink</em> is defined as one 12-oz can or bottle of beer, one 4-oz glass of wine, one 12-oz can or bottle of wine cooler, 1 mixed drink or cocktail, or 1 shot of hard liquor.<br /><br />";
	echo $drinksPerWeekStart;
	foreach($questions_bank4 as $id=>$question) {
		echo strtr('
			<tr class="hypertension_row">
				<td class="hypertension_question"><ol start="{$id}"><li>{$question}</li></ol></td>
				<td class="hypertension_response" id="{$field}-0"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="0" /><br />0 - 1</label></center></td>
				<td class="hypertension_response" id="{$field}-1"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="2" /><br />2 - 3</label></center></td>
				<td class="hypertension_response" id="{$field}-2"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="4" /><br />4 - 5</label></center></td>
				<td class="hypertension_response" id="{$field}-3"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="6" /><br />6 - 7</label></center></td>
				<td class="hypertension_response" id="{$field}-4"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="8" /><br />8 - 9</label></center></td>
				<td class="hypertension_response" id="{$field}-5"><center><label class="radio_caption">&nbsp;&nbsp;&nbsp;<br /><input type="radio" name="{$field}" value="10" /><br />10+</label></center></td>
			</tr>
		', array(
			'{$id}' => $id + 30,
			'{$field}' => $ids4[$id],
			'{$question}' => $question
		));
		$_SESSION[$ids4[$id]] = 99;
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
	$qb1_criteria_prefix = "How many of the past 7 days did you ";
	$questions_bank1 = array(
		"Take your blood pressure pills?",
		"Take your blood pressure pills at the same time every day?",
		"Take the recommended number of blood pressure pills?",
		"Follow a healthy eating plan?",
		"Eat potato chips, salted nuts, or salted popcorn?",
		"Eat processed meats such as ham, bacon, bologna, or sausage?",
		"Eat smoked meats or smoked fish?",
		"Eat pickles, olives, or other vegetables in brine?",
		"Eat 5 or more servings of fruits and vegetables?",
		"Eat frozen prepared dinners or frozen pizza?",
		"Eat store bought or packaged bakery goods?",
		"Salt your food at the table?",
		"Add salt to food when you're cooking?",
		"Eat fried foods such as chicken, french fries, or fish?",
		"Avoid eating fatty foods?",
		"Do at least 30 minutes total of physical activity?",
		"Do a specific exercise activity (such as swimming, walking, or biking) other than what you do around the house or as part of your work?",
		"Smoke a cigarette or cigar, even just one puff?"
	);
	
	$ids2 = array("HT_Wt_1", "HT_Wt_2", "HT_Wt_3", "HT_Wt_4", "HT_Wt_5", "HT_Wt_6", "HT_Wt_7", "HT_Wt_8", "HT_Wt_9", "HT_Wt_10");
	$qb2_criteria_prefix = "In order to lose weight or maintain my weight, ";
	$questions_bank2 = array(
			"I am careful about what I eat.",
			"I read food labels when I grocery shop.",
			"I exercise.",
			"I have cut out drinking sugary sodas and sweet tea.",
			"I eat smaller portions or eat fewer portions.",
			"I have stopped buying or bringing unhealthy foods into my home.",
			"I have cut out or limited some foods that I like but that are not good for me.",
			"I eat at restaurants or fast food places less often.",
			"I substitute healthier foods for things that I used to eat.",
			"I have modified my recipes when I cook."
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
		<br /><hr><div id="hypertension_results">
		<center>
			<h3>Hypertension - Self-care Activity Level Effects (H-SCALE)</h3>
		</center>
		<table>
	';
	
	// Bank 1
	// TODO: Inverted scoring? Since scoring is not requested at this time, other things. - MG 10/13/2016
	echo '
		<tr>
			<td colspan="2"><h4>Medication Usage, Low-salt Diet, Physical Activity and Smoking</h4></td>

		</tr>
	';
	echo '
		<tr>
			<td colspan="2"><h3>How many of the past 7 days did you...</strong></h3>		
		</tr>
	';
	foreach($ids1 as $index=>$id) {		
		switch($copy[$id]){
			case 99:
				$human_answer = "No response";
				break;
			case 1:
				$human_answer = "1 Day";
				break;
			case 0:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
				$human_answer = $copy[$id] . " Days";
				break;
			default:
				$human_answer = "error";
				break;
		}
		
		
		echo strtr('
			<tr>
				<td><ol start="{$q_num}"><li>{$question}</li></ol></td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank1[$index],
			'{$answer}' => $human_answer,
			'{$q_num}' => $index + 1
		));
	}
	
	// Bank 2
	echo '
		<tr>
			<td colspan="2"><h4>Weight Management</strong></h4></td>
		</tr>
	';
	echo '
		<tr>
			<td colspan="2"><h3>In order to lose weight or maintain my weight, </h3></td>
		</tr>
	';
	foreach($ids2 as $index=>$id) {
		switch($copy[$id]){
			case 99:
				$human_answer = "No response";
				break;
			case 1:
				$human_answer = "Strongly Disagree";
				break;
			case 2:
				$human_answer = "Disagree";
				break;
			case 3:
				$human_answer = "Neutral";
				break;
			case 4:
				$human_answer = "Agree";
				break;
			case 5:
				$human_answer = "Strongly Agree";
				break;
			default:
				$human_answer = "error";
		}
		echo strtr('
			<tr>
				<td><ol start="{$q_num}"><li>{$question}</li></ol></td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank2[$index],
			'{$answer}' => $human_answer,
			'{$q_num}' => $index + 19
		));
	}
	
	// Bank 3
	echo '
		<tr>
			<td colspan="2"><h4>Alcohol</h4></td>

		</tr>
	';
	foreach($ids3 as $index=>$id) {
		switch($copy[$id]){
			case 99:
				$human_answer = "No response";
				break;
			case 1:
				$human_answer = "1 Day";
				break;
			case 0:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
				$human_answer = $copy[$id] . " Days";
				break;
			default:
				$human_answer = "error";
		}
		echo strtr('
			<tr>
				<td><ol start="{$q_num}"><li>{$question}</li></ol></td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank3[$index],
			'{$answer}' => $human_answer,
			'{$q_num}' => $index + 29
		));
	}
	
	// Bank 4
	foreach($ids4 as $index=>$id) {
		switch($copy[$id]){
			case 99:
				$human_answer = "No response";
				break;
			case 0:
				$human_answer = "0 - 1 Drinks";
				break;
			case 2:
				$human_answer = "2 - 3 Drinks";
				break;
			case 4:
				$human_answer = "4 - 5 Drinks";
				break;
			case 6:
				$human_answer = "6 - 7 Drinks";
				break;
			case 8:
				$human_answer = "8 - 9 Drinks";
				break;
			case 10:
				$human_answer = "10+ Drinks";
				break;
			default:
				$human_answer = "error";
		}
		echo strtr('
			<tr>
				<td><ol start="{$q_num}"><li>{$question}</li></ol></td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
			'{$question}' => $questions_bank4[$index],
			'{$answer}' => $human_answer,
			'{$q_num}' => $index + 30
		));
	}
	
	
	echo '</table></div>';
}

?>
