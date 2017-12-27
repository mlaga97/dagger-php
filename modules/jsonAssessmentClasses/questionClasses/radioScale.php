<?php

// TODO: Consider whether the multicolumn support should be broken off into a separate 'radioScaleMulticolumn' for SIGNIFICANTLY easier maintenence.

global $questionClasses;
$questionClasses["radioScale"] = array();

$questionClasses["radioScale"]["header"] = function($type) {
	$options = $type['options'];

	echo "<table>";

	///////////////////////////////////
	// Pre-header
	///////////////////////////////////
	if(array_key_exists('span', $type)) {
		echo "<tr><th>" . $type['span'] . "</th>";
	}

	if(count($options) > 0) {
		if(array_key_exists(0, $options) && is_array($options[0])) {
			foreach($options as $subType) {
					echo "<th colspan='" . count($subType['options']) . "'>" . $subType['span'] . "</th>";
			}
		}
	} else {
		// We don't have any options!
	}

	// This SHOULD NOT always be displayed!
	// TODO: Make this conditional, rather than absolute
	echo "</tr>";


	///////////////////////////////////
	// Header
	///////////////////////////////////
	echo "<tr><th>";

	// Don't show unless we don't have a preheader
	if(!array_key_exists('span', $type)) {
		echo "Question";
	}

	echo "</th>";

	if(count($options) > 0) {
		if(array_key_exists(0, $options) && is_array($options[0])) {

			// Multiple columns
			foreach($options as $subType) {
				foreach($subType["options"] as $optionText => $value) {
					echo "<th>" . $optionText . "</th>";
				}
			}

		} else {

			// Single column
			foreach($type["options"] as $optionText => $value) {
				echo "<th>" . $optionText . "</th>";
			}

		}

	} else {
		// We don't have any options!
	}

	echo "</tr>";
};

// TODO: Refactor/document
$questionClasses["radioScale"]["render"] = function($question, $relativeQuestionNumber, $absoluteQuestionNumber, $type) {
	$options = $type['options'];

	if($relativeQuestionNumber == 0) {
		echo "<br/>";
	}
	echo "<tr><td><ol start='" . $absoluteQuestionNumber .  "'><li>" . $question["text"] . "</li></ol></td>";

	// Check to see if we actually have options
	if(count($options) > 0) {
		
		if(array_key_exists(0, $options) && is_array($options[0])) {

			// Multiple columns
			foreach($options as $subType) {
				foreach($subType['options'] as $optionText => $value) {

					// Check for 'hideLabel' option
					if(array_key_exists('hideLabel', $subType) && $subType['hideLabel']) {
						$optionText = '';
					}

					// Check for 'suffix' option
					if(array_key_exists('suffix', $subType) && is_string($subType['suffix'])) {
						$question['id'] = $question['id'] . $subType['suffix'];
					}

					echo "<td><center><label class='radio_caption'><br/><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /><br/>" . $optionText . "</label></center></td>";
				}
			}

		} else {

			// Single column
			foreach($options as $optionText => $value) {

				// Check for 'hideLabel' option
				if(array_key_exists('hideLabel', $type) && $type['hideLabel']) {
					$optionText = '';
				}

				echo "<td><center><label class='radio_caption'><br/><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /><br/>" . $optionText . "</label></center></td>";
	}
		}

	} else {
		// We don't have any options!
	}
};

$questionClasses["radioScale"]["parseResponse"] = function($rawAnswer, $type) {
	if($rawAnswer == $type["emptyValue"]) {
		return "No Response";
	}

	return array_search($rawAnswer, $type["options"]);
}

?>
