<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/gse/assessment.json';
$contents = file_get_contents($path);
$assessment = json_decode($contents, true);

?>

<h3><?php echo $assessment["metadata"]["title"]?></h3>


<?php

foreach($assessment["questions"] as $questionNumber=>$question) {
	// NOTE: This takes advantage of Short-Circuit evaluation and will break otherwise
	if($questionNumber == 0 || $question["type"] != $assessment["questions"][$questionNumber-1]["type"]) {
		echo "<table><tr><th>ID</th><th>Question</th>";

		$typeData = $assessment["types"][$question["type"]];
		switch($typeData["type"]) {
			case "scale":
				foreach($typeData["options"] as $optionText => $value) {
					echo "<th>" . $optionText . "</th>";
				}
				break;
		}

		echo "</tr>";
	}

	echo "<tr><td>" . ($questionNumber+1) . "</td><td>" . $question["text"] . "</td>";

	$typeData = $assessment["types"][$question["type"]];
	switch($typeData["type"]) {
		case "radioScale":
			foreach($typeData["options"] as $optionText => $value) {
				echo "<td><center><input type='checkbox' name='" . $question["id"] . "' value='" . $value . "' /></center></td>";
			}
			break;
	}
	echo "</tr>";
}
echo "</table>";


?>