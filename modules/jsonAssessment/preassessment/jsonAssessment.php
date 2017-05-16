<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/gse/assessment.json';
$contents = file_get_contents($path);
$assessment = json_decode($contents, true);

$_SESSION[$assessment["metadata"]["id"]] = 0;
?>

<div class="<?php echo $assessment["metadata"]["class"]?>" title="<?php echo $assessment["metadata"]["title"]?>" >
	<label><input id="<?php echo $assessment["metadata"]["id"]?>" type="checkbox" name="<?php echo $assessment["metadata"]["id"]?>" value="1" /><?php echo $assessment["metadata"]["text"]?></label>
</div>