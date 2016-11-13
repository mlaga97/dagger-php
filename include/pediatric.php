<?php
// Ensure that Mike has the correct copy of pediatric.php

function write_pediatric($type, $mysqli) {
	$questions1 = array(
		array("HLS_FH_Diab", "with Diabetes or Gestational Diabetes?"),
		array("HLS_FH_HBP", "with High Blood Pressure?"),
		array("HLS_FH_HD", "with Heart Disease (heart attack, stroke, high cholesterol)?"),
		array("HLS_FH_Overwt", "as Overweight?"),
	);
	$familyMembers = array("Mother", "Father", "Sibling", "Grandparent", "Aunt/Uncle", "Other");

	$questions2 = array(
		array("HLS_Servings",	array("0"=>"<span class='nowrap'>0 - 1</span> servings", "2"=>"<span class='nowrap'>2 - 3</span> servings", "4"=>"<span class='nowrap'>4 - 5</span> servings", "6"=>"More than 5 servings"),	"How many servings per day (1 serving = 1/2 cup) of fruits and vegetables does your child eat?"),
		array("HLS_Screentime",	array("1"=>"More than 4 hours", "2"=>"<span class='nowrap'>3 - 4</span> hours", "3"=>"<span class='nowrap'>1 - 2</span> hours", "4"=>"1 hour or less"),			"In total, how many hours per day does your child watch TV or movies, play video or computer games?"),
		array("HLS_PhysAct",	array("0"=>"<span class='nowrap'>0 - 1</span> day", "2"=>"<span class='nowrap'>2 - 3</span> days", "4"=>"<span class='nowrap'>4 - 5</span> days", "6"=>"<span class='nowrap'>6 - 7</span> days"),							"How many days per week is your child physically active, outside of school time, for at least 60 minutes? (walking, running, biking, swimming, playing outside, dancing, etc.)"),
		array("HLS_FamAct",		array("0"=>"<span class='nowrap'>0 - 1</span> day", "2"=>"<span class='nowrap'>2 - 3</span> days", "4"=>"<span class='nowrap'>4 - 5</span> days", "6"=>"<span class='nowrap'>6 - 7</span> days"),							"How many times per week does your family do something active together?"),
		array("HLS_Drink",		array("1"=>"4 or more times", "2"=>"3 times", "3"=>"<span class='nowrap'>1 - 2</span> times", "4"=>"0 times"),					"How many times per day does your child drink any of the following: juice, soda, sports drinks, energy drinks, flavored milk, lemonade, sweetened tea, or coffee drinks?"),
		array("HLS_Brkfst",		array("0"=>"<span class='nowrap'>0 - 1</span> time", "2"=>"<span class='nowrap'>2 - 3</span> times", "4"=>"<span class='nowrap'>4 - 5</span> times", "6"=>"<span class='nowrap'>6 - 7</span> times"),						"How many times per week does your child eat breakfast?"),
		array("HLS_Table",		array("0"=>"<span class='nowrap'>0 - 1</span> time", "2"=>"<span class='nowrap'>2 - 3</span> times", "4"=>"<span class='nowrap'>4 - 5</span> times", "6"=>"<span class='nowrap'>6 - 7</span> times"),						"How many days per week does your family eat dinner together at the table?"),
		array("HLS_EatOut",		array("1"=>"<span class='nowrap'>6 - 7</span> times", "2"=>"<span class='nowrap'>4 - 5</span> times", "3"=>"<span class='nowrap'>2 - 3</span> times", "4"=>"<span class='nowrap'>0 - 1</span> time"),						"How many times per week does your child eat food outside the home/school?"),
		array("HLS_Money",		array("1"=>"Often", "2"=>"Sometimes", "3"=>"Rarely", "4"=>"Never"),									"Are you ever worried that food will run out before you get more money to buy more?"),
		array("HLS_Sleep",		array("1"=>"Often", "2"=>"Sometimes", "3"=>"Rarely", "4"=>"Never"),									"Is your child having difficulty with sleeping or snoring?"),
		array("HLS_Health",		array("1"=>"<span class='nowrap'>8 - 10</span> (Very)", "2"=>"<span class='nowrap'>5 - 7</span>", "3"=>"<span class='nowrap'>2 - 4</span>", "4"=>"<span class='nowrap'>0 - 1</span> (Low)"),								"How worried are you about your child's health?"),
		array("HLS_Weight",		array("1"=>"<span class='nowrap'>8 - 10</span> (Very)", "2"=>"<span class='nowrap'>5 - 7</span>", "3"=>"<span class='nowrap'>2 - 4</span>", "4"=>"<span class='nowrap'>0 - 1</span> (Low)"),								"How worried are you about your child's weight?"),
		array("HLS_Now",		array("1"=>"<span class='nowrap'>8 - 10</span> (Definitely)", "2"=>"<span class='nowrap'>5 - 7</span> (Yes)", "3"=>"<span class='nowrap'>2 - 4</span> (Maybe)", "4"=>"<span class='nowrap'>0 - 1</span> (No)"),				"Is now a good time to work on family eating and activity habits?"),
	);

	// Begin Div
	echo '<br><hr><div id="pediatric_section"><center><h3>Pediatric Healthy Lifestyle Screening</h3></center>';
	echo "<center><strong>Family History</strong><br /><br />
	Questions 1 - 4 should be prefaced with<br /><div class='question_criteria'>Has anyone in your family ever been diagnosed...</div></center><br />";
	
	// Print Question Bank 1
	echo '
		<table border="1" width="100%">
			<tr>
				<td></td>
				<td class="pediatric_scale"><center> Mother </center></td>
				<td class="pediatric_scale"><center> Father </center></td>
				<td class="pediatric_scale"><center> Sibling </center></td>
				<td class="pediatric_scale"><center> Grandparent </center></td>
				<td class="pediatric_scale"><center> Aunt/Uncle </center></td>
				<td class="pediatric_scale"><center> Other </center></td>
			</tr>
	';
	foreach($questions1 as $index=>$question_data) {
		echo strtr('
			<tr class="pediatric_row">
				<td class="pediatric_question"><ol start="{$index}"><li>{$question}</li></ol></td>
				<td class="pediatric_response" id="{$field}-1">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="checkbox" name="{$field}-1" value="1" />
						<br />Mother</label>
					</center>
				</td>
				<td class="pediatric_response" id="{$field}-2">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="checkbox" name="{$field}-2" value="2" />
						<br />Father</label>
					</center>
				</td>
				<td class="pediatric_response" id="{$field}-3">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="checkbox" name="{$field}-3" value="4" />
						<br />Sibling</label>
					</center>
				</td>
				<td class="pediatric_response" id="{$field}-4">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="checkbox" name="{$field}-4" value="8" />
						<br />Grandparent</label>
					</center>
				</td>
				<td class="pediatric_response" id="{$field}-5">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="checkbox" name="{$field}-5" value="16" />
						<br />Aunt/Uncle</label>
					</center>
				</td>
				<td class="pediatric_response" id="{$field}-6">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="checkbox" name="{$field}-6" value="32" />
						<br />Other</label>
					</center>
				</td>
			</tr>
		', array(
			'{$field}' => $question_data[0],
			'{$question}' => $question_data[1],
			'{$index}' => $index+1
		));
	}
	
	// Print Question Bank 2
	global $last_options_line;
	foreach($questions2 as $index=>$question_data) {
		$id = $question_data[0];
		$options = $question_data[1];
		$question = $question_data[2];
		
		$options_line = '';
		foreach($options as $value=>$answer)
			$options_line = $options_line . strtr('<td class="pediatric_scale"><center>{$answer}</center></td>', array('{$answer}' => $answer));
		
		if($options_line != $last_options_line) {
			echo strtr('
				</table><br /><br />
				<table border="1"  width="100%">
					<tr>
						<td></td>
						{$options_line}
					</tr>
			', array(
				'{$options_line}' => $options_line,
			));
		}
		$last_options_line = $options_line;
		
		$buttons = '';
		$field_index = 0;
		foreach($options as $value=>$answer) {
			$buttons = $buttons . strtr(
				'<td class="pediatric_response" id="{$field}-{$index}">
					<center>
						<label class="radio_caption">&nbsp;&nbsp;&nbsp;<br />
						<input type="radio" name="{$field}" value="{$value}" />
						<br />' . $answer . '</label>
					</center>
				</td>',
				array(
					'{$field}' => $id,
					'{$index}' => $field_index,
					'{$value}' => $value
			));
			
			$field_index++;
		}
		
		echo strtr('
					<tr class="pediatric_row">
						<td class="pediatric_question"><ol start="{$index}"><li>{$question}</li></ol></td>
						{$buttons}
					</tr>
		', array(
			'{$question}' => $question,
			'{$buttons}' => $buttons,
			'{$index}' => $index+5
		));
		
	}
	echo '</table><br /><br /></div>';
}

function pediatric_scoring($copy, $mysqli) {
	
	$questions1 = array(
			array("HLS_FH_Diab", "Has anyone in your family ever been diagnosed with diabetes/gestational diabetes?"),
			array("HLS_FH_HBP", "Has anyone in your family ever been diagnosed with high blood pressure?"),
			array("HLS_FH_HD", "Has anyone in your family ever been diagnosed with heart disease (heart attack, stroke, high cholesterol)?"),
			array("HLS_FH_Overwt", "Has anyone in your family every been diagnosed as overweight?"),
	);
	$familyMembers = array("Mother", "Father", "Sibling", "Grandparent", "Aunt/Uncle", "Other");
	
	$questions2 = array(
			array("HLS_Servings",	array("0"=>"0 - 1 servings", "2"=>"2 - 3 servings", "4"=>"4 - 5 servings", "6"=>"More than 5 servings"),	"How many servings per day (1 serving = 1/2 cup) of fruits and vegetables does your child eat?"),
			array("HLS_Screentime",	array("1"=>"More than 4 hours", "2"=>"3 - 4 hours", "3"=>"1 - 2 hours", "4"=>"1 hour or less"),			"In total, how many hours per day does your child watch TV or movies, play video or computer games?"),
			array("HLS_PhysAct",	array("0"=>"0 - 1 day", "2"=>"2 - 3 days", "4"=>"4 - 5 days", "6"=>"6 - 7 days"),							"How many days per week is your child physically active, outside of school time, for at least 60 minutes? (walking, running, biking, swimming, playing outside, dancing, etc.)"),
			array("HLS_FamAct",		array("0"=>"0 - 1 day", "2"=>"2 - 3 days", "4"=>"4 - 5 days", "6"=>"6 - 7 days"),							"How many times per week does your family do something active together?"),
			array("HLS_Drink",		array("1"=>"4 or more times", "2"=>"3 times", "3"=>"1 - 2 times", "4"=>"0 times"),					"How many times per day does your child drink any of the following: juice, soda, sports drinks, energy drinks, flavored milk, lemonade, sweetened tea, or coffee drinks?"),
			array("HLS_Brkfst",		array("0"=>"0 - 1 time", "2"=>"2 - 3 times", "4"=>"4 - 5 times", "6"=>"6 - 7 times"),						"How many times per week does your child eat breakfast?"),
			array("HLS_Table",		array("0"=>"0 - 1 time", "2"=>"2 - 3 times", "4"=>"4 - 5 times", "6"=>"6 - 7 times"),						"How many days per week does your family eat dinner together at the table?"),
			array("HLS_EatOut",		array("1"=>"6 - 7 times", "2"=>"4 - 5 times", "3"=>"2 - 3 times", "4"=>"0 - 1 time"),						"How many times per week does your child eat food outside the home/school?"),
			array("HLS_Money",		array("1"=>"Often", "2"=>"Sometimes", "3"=>"Rarely", "4"=>"Never"),									"Are you ever worried that food will run out before you get more money to buy more?"),
			array("HLS_Sleep",		array("1"=>"Often", "2"=>"Sometimes", "3"=>"Rarely", "4"=>"Never"),									"Is your child having difficulty with sleeping or snoring?"),
			array("HLS_Health",		array("1"=>"8 - 10 (Very)", "2"=>"5 - 7", "3"=>"2 - 4", "4"=>"0 - 1 (Low)"),								"How worried are you about your child's health?"),
			array("HLS_Weight",		array("1"=>"8 - 10 (Very)", "2"=>"5 - 7", "3"=>"2 - 4", "4"=>"0 - 1 (Low)"),								"How worried are you about your child's weight?"),
			array("HLS_Now",		array("1"=>"8 - 10 (Definitely)", "2"=>"5 - 7 (Yes)", "3"=>"2 - 4 (Maybe)", "4"=>"0 - 1 (No)"),				"Is now a good time to work on family eating and activity habits?"),
	);
	
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	echo '
		<br/>
		<div id="pediatric_results">
		<center>
			<h3>Pediatric Healthy Lifestyle Screening</h3>
		</center>
		<table border="1">
			<tr>
				<td><center>Question</center></td>
				<td><center>Response</center></tb>
			</tr>
	';
	
	// Bank 1
	include 'bitwise.php';
	$idx = 1;
	foreach($questions1 as $question) {
		echo strtr('
			<tr>
				<td><ol start="' . $idx . '"><li>{$question}</li></ol></td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
					'{$question}' => $question[1],
					'{$answer}' => unmaskValuesToString($copy[$question[0]], $familyMembers)
			));
			$idx++;
	}
	
	// Bank 2
	foreach($questions2 as $question) {
		echo strtr('
			<tr>
				<td><ol start="' . $idx . '"><li>{$question}</li></ol></td>
				<td><center>{$answer}</center></td>
			</tr>
		', array(
					'{$question}' => $question[2],
					'{$answer}' => $question[1][$copy[$question[0]]] // TODO: Make not stupid.
			));
			$idx++;
	}
	
	
	echo '</table></div><br /><br />';
}

?>
